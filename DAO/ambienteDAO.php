<?php
include 'ambiente.php';

class AmbienteDAO {
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql, $conexao) {
        $resultados = mysql_query($sql, $conexao) or die(mysql_error());
        $moduloDAO = new ModuloDAO();
        
        if(mysql_num_rows($resultados) > 0) {
            for($i = 0; $i < mysql_num_rows($resultados); $i++) {
                $linha = mysql_fetch_assoc($resultados);
                $ambientes[$i] = new Ambiente();
                
                $ambientes[$i]->setId($linha['id']);
                $ambientes[$i]->setNome($linha['nome']);
				$ambientes[$i]->setPosicaoX($linha['posicao_x']);
                $ambientes[$i]->setPosicaoY($linha['posicao_y']);
                $ambientes[$i]->setContorno($linha['contorno']);
                $ambientes[$i]->setIdAndar($linha['andar_id']);
                $ambientes[$i]->setlistaModulos($moduloDAO->getPorIdAmbiente($ambientes[$i]->getId(), $conexao));
            }
        }
        return $ambientes;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'ambientes' no banco de dados
    public function getPorIdAndar($idAndar, $conexao) {
        $sql = "SELECT * FROM sala WHERE id=".$idAndar;
        return $this->executar($sql, $conexao);
    }
    
    
    public function gravar($ambiente, $conexao) {
        $ambientesAtuais = null;
        
        if($ambiente->getId() != "") {
            $ambientesAtuais = $this->getPorIdAndar($ambiente->getIdAndar(), $conexao);
        }
        
        $update = false;
        
        for ($i = 0; $i < count($ambientesAtuais); $i++) {
			if ($ambientesAtuais[$i]->getId() == $ambiente->getId()) {
				$update = true;
			}
		}
		
		// If the query returned a row then update,
        // otherwise insert a new user.
        if($update) {
            $sql = 	"UPDATE sala SET ".
					"nome=".$ambiente->getNome().", ".
					"posicao_x=".$ambiente->getPosicaoX().", ".
					"posicao_y=".$ambiente->getPosicaoY().", ".
					"contorno=".$ambiente->getContorno().", ".
					"andar_id=".$ambiente->getIdAndar().", ".
					"WHERE id=".$ambiente->getId();
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        else {
            $sql = 	"INSERT INTO sala (nome, posicao_x, posicao_y, contorno, andar_id) VALUES('".
					$ambiente->getNome()."', ".
					$ambiente->getPosicaoX().", ".
					$ambiente->getPosicaoY().", '".
					$ambiente->getContorno()."', ".
					$ambiente->getIdAndar().")";
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        return true;
    }
    
}
?>
