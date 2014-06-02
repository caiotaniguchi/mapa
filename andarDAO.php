<?php
class AndarDAO {
    private var $conexao;
    private var $db;
    private var $ambienteDAO;
    
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
                $andares[$i] = new ambiente();
                
                $andares[$i]->setId($linha['id']);
                $andares[$i]->setNumAndar($linha['numAndar']);
				$andares[$i]->setPlanta($linha['planta']);
                $andares[$i]->setIdEdificio($linha['idAmbiente']);
            }
        }
        return $andares;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'andares' no banco de dados
    public function getPorIdEdificio($idEdificio, $ambienteDAO) {
        $sql = "SELECT * FROM andares WHERE id=".$idEdificio;
        $listaAndares = $this->executar($sql);
        for($i = 0; $i < count($listaAndares); $i++) {
			$listaAndares[$i]->setListaAndares(
				$ambienteDAO->getPorIdAndar($listaAndares[$i]->getId())
				);
		}
		return $listaAmbientes;
    }
    
}
?>
