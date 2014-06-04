<?php
include 'andar.php';

class AndarDAO {
    private $conexao;
    private $db;
    private $ambienteDAO;
    
    // Attempts to initialize the database connection using the supplied info.
    public function AndarDAO($host, $usuario, $senha, $database, $ambienteDAO) {
        $this->conexao = mysql_connect($host, $usuario, $senha);
        $this->db = mysql_select_db($database);
        $this->ambienteDAO = $ambienteDAO;
    }
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql) {
        $resultados = mysql_query($sql, $this->conexao) or die(mysql_error());
        
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
    public function getPorIdEdificio($idEdificio) {
        $sql = "SELECT * FROM andar WHERE id=".$idEdificio;
        return $this->executar($sql);
    }
    
    public function loadListaAmbientes($andar) {
		$andar->setListaAmbientes($this->ambienteDAO->getPorIdAndar($andar->getId()));
		return $andar;
    }
    
}
?>
