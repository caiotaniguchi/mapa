<?php
include 'andar.php';

class AndarDAO {
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql, $conexao) {
        $resultados = mysql_query($sql, $conexao) or die(mysql_error());
        
        if(mysql_num_rows($resultados) > 0) {
            for($i = 0; $i < mysql_num_rows($resultados); $i++) {
                $linha = mysql_fetch_assoc($resultados);
				$andares[$i] = new Andar();
                
                $andares[$i]->setId($linha['id']);
                $andares[$i]->setNumAndar($linha['numAndar']);
				$andares[$i]->setPlanta($linha['planta']);
                $andares[$i]->setIdEdificio($linha['edificio_id']);
            }
        }
        return $andares;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'andares' no banco de dados
    public function getPorIdEdificio($idEdificio, $conexao) {
        $sql = "SELECT * FROM andar WHERE id=".$idEdificio;
        return $this->executar($sql, $conexao);
    }
    
    public function loadListaAmbientes($andar, $conexao) {
		$ambienteDAO = new AmbienteDAO();
		$andar->setListaAmbientes($ambienteDAO->getPorIdAndar($andar->getId(), $conexao));
		return $andar;
    }
    
    public function gravar($andar, $conexao) {
        $andaresAtuais = null;
        
        if($andar->getId() != "") {
            $andaresAtuais = $this->getPorIdEdificio($andar->getIdEdificio(), $conexao);
        }
        
        $update = false;
        
        for ($i = 0; $i < count($andaresAtuais); $i++) {
			if ($andaresAtuais[$i]->getId() == $andar->getId()) {
				$update = true;
			}
		}
		
		// If the query returned a row then update,
        // otherwise insert a new user.
        if($update) {
            $sql = 	"UPDATE sala SET ".
					"nome=".$andar->getNome().", ".
					"andar_inicial=".$andar->getAndar().", ".
					"andar_final=".$andar->getPosicaoY().", ".
					"WHERE id=".$andar->getId();
            
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
