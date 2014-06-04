<?php
include 'condicaoRange.php';

class CondicaoRangeDAO {
	
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql, $conexao) {
        $resultados = mysql_query($sql, $conexao) or die(mysql_error());
        
        if(mysql_num_rows($resultados) > 0) {
            for($i = 0; $i < mysql_num_rows($resultados); $i++) {
                $linha = mysql_fetch_assoc($resultados);
				$condicoesRange[$i] = new CondicaoRange();
                
                $condicoesRange[$i]->setId($linha['id']);
                $condicoesRange[$i]->setInteresse($linha['interesse']);
				$condicoesRange[$i]->setMin($linha['min']);
				$condicoesRange[$i]->setMax($linha['max']);
                $condicoesRange[$i]->setIdAmbiente($linha['sala_id']);
            }
        }
        return $condicoesRange;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'condicoes' no banco de dados
    public function getPorIdAmbiente($idAmbiente, $conexao) {
        $sql = "SELECT * FROM condicaorange WHERE sala_id=".$idAmbiente;
        return $this->executar($sql, $conexao);
    }
        
    public function gravar($condicaoRange, $conexao) {
        $condicoesAtuais = null;
        
        if($andar->getId() != "") {
            $condicoesAtuais = $this->getPorIdAmbiente($condicaoRange->getIdAmbiente(), $conexao);
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
            $sql = 	"UPDATE condicaorange SET ".
					"sala_id=".$condicaoRange->getIdAmbiente().", ".
					"interesse=".$condicaoRange->getInteresse().", ".
					"min".$condicaoRange->getMin().", ".
					"max".$condicaoRange->getMax().", ".
					"WHERE id=".$condicaoRange->getId();
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        else {
            $sql = 	"INSERT INTO condicaorange (sala_id, interesse, valor_critico) VALUES(".
					$condicaoRange->getIdAmbiente().", '".
					$condicaoRange->getInteresse()."', ".
					$condicaoRange->getMin().", ".
					$condicaoRange->getMax()")";
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        return true;
    }
    
    
}
?>
