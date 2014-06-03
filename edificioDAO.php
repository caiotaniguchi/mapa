<?php
class EdificioDAO {
    private var $conexao;
    private var $db;
    private var $andarDAO;
    
    // Attempts to initialize the database connection using the supplied info.
    public function EdificioDAO($host, $usuario, $senha, $database, $andarDAO) {
        $this->conexao = mysql_connect($host, $usuario, $senha);
        $this->db = mysql_select_db($database);
        $this->andarDAO = $andarDAO;
    }
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql) {
        $resultados = mysql_query($sql, $this->conexao) or die(mysql_error());
        
        if(mysql_num_rows($resultados) > 0) {
            for($i = 0; $i < mysql_num_rows($resultados); $i++) {
                $linha = mysql_fetch_assoc($resultados);
				$edificio[$i] = new ambiente();
                
                $edificio[$i]->setId($linha['id']);
                $edificio[$i]->setNumAndar($linha['numAndar']);
				$edificio[$i]->setPlanta($linha['planta']);
                $edificio[$i]->setIdEdificio($linha['idAmbiente']);
				$andares[$i]->setListaAndares($ambienteDAO->getPorIdAndar($andares[$i]->getId()));
            }
        }
        return $andares;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'andares' no banco de dados
    public function getEdificios($nomeEdificio, $ambienteDAO) {
        $sql = "SELECT * FROM edificio";
        return $this->executar($sql);
    }
    
}
?>
