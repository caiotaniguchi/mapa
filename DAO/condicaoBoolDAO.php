<?php
include 'condicaoBool.php';

class CondicaoBoolDAO {
	
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql, $conexao) {
        $resultados = mysql_query($sql, $conexao) or die(mysql_error());
        
        if(mysql_num_rows($resultados) > 0) {
            for($i = 0; $i < mysql_num_rows($resultados); $i++) {
                $linha = mysql_fetch_assoc($resultados);
				$condicoesBool[$i] = new CondicaoBool();
                
                $condicoesBool[$i]->setId($linha['id']);
                $condicoesBool[$i]->setInteresse($linha['interesse']);
				$condicoesBool[$i]->setValorCritico($linha['valor_critico']);
                $condicoesBool[$i]->setIdAmbiente($linha['sala_id']);
            }
        }
        return $condicoesBool;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'condicoes' no banco de dados
    public function getPorIdAmbiente($idAmbiente, $conexao) {
        $sql = "SELECT * FROM condicaobool WHERE sala_id=".$idAmbiente;
        return $this->executar($sql, $conexao);
    }
        
    public function gravar($condicaoBool, $conexao) {
        $condicoesAtuais = null;
        
        if($andar->getId() != "") {
            $condicoesAtuais = $this->getPorIdAmbiente($condicaoBool->getIdAmbiente(), $conexao);
        }
        
        $update = false;
        
        for ($i = 0; $i < count($condicoesAtuais); $i++) {
			if ($condicoesAtuais[$i]->getId() == $condicao->getId()) {
				$update = true;
			}
		}
		
		// If the query returned a row then update,
        // otherwise insert a new user.
        if($update) {
            $sql = 	"UPDATE condicaobool SET ".
					"sala_id=".$condicaoBool->getIdAmbiente().", ".
					"interesse=".$condicaoBool->getInteresse().", ".
					"valor_critico=".$condicaoBool->getValorCritico().", ".
					"WHERE id=".$condicaoBool->getId();
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        else {
            $sql = 	"INSERT INTO condicaobool (sala_id, interesse, valor_critico) VALUES(".
					$condicaoBool->getIdAmbiente().", '".
					$condicaoBool->getInteresse()."', ".
					$condicaoBool->getValorCritico().")";
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        return true;
    }
    
    
}
?>
