<?php
include 'andar.php';

class AndarDAO {
    private $ambienteDAO;
    
    public function AndarDAO ($ambienteDAO) {
		$this->ambienteDAO = $ambienteDAO;
	}
    
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
				//$andares[$i]->setListaAmbientes($this->ambienteDAO->getPorIdAndar($andares[$i]->getId()));
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
		$andar->setListaAmbientes($this->ambienteDAO->getPorIdAndar($andar->getId(), $conexao));
		return $andar;
    }
    
    
}
?>
