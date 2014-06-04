<?php
include 'andar.php';
include 'ambienteDAO.php';

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
					"numAndar=".$andar->getNumAndar().", ".
					"planta=".$andar->getPlanta().", ".
					"edificio_id=".$andar->getIdEdificio().", ".
					"WHERE id=".$andar->getId();
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        else {
            $sql = 	"INSERT INTO andar (numAndar, planta, edificio_id) VALUES(".
					$andar->getNumAndar().", '".
					$andar->getPlanta()."', ".
					$andar->getIdEdificio().")";
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        return true;
    }
    
    
}
?>
