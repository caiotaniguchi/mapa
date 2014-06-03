<?php
class ModuloDAO {
    private $conexao;
    private $db;
    private $estadoDAO;
    
    // Attempts to initialize the database connection using the supplied info.
    public function ModuloDAO($host, $usuario, $senha, $database, $estadoDAO) {
        $this->conexao = mysql_connect($host, $usuario, $senha);
        $this->db = mysql_select_db($database);
        $this->estadoDAO = $estadoDAO;
        echo "conectei\n";
    }
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql) {
        $resultados = mysql_query($sql, $this->conexao) or die(mysql_error());
        
        if(mysql_num_rows($resultados) > 0) {
            for($i = 0; $i < mysql_num_rows($resultados); $i++) {
                $linha = mysql_fetch_assoc($resultados);
                $modulos[$i] = new modulo();
                      
                $modulos[$i]->setId($linha['id']);
                $modulos[$i]->setIdAmbiente($linha['sala_id']);                
				$modulos[$i]->setEstado($this->estadoDAO->getPorIdModulo($modulos[$i]->getId()));
            }
        }
        echo $modulos[0]->getId();
        return $modulos;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'modulos' no banco de dados
    public function getPorIdAmbiente($idAmbiente) {
        $sql = "SELECT * FROM modulo WHERE id = ".$idAmbiente;
        return $this->executar($sql);
    }
    
}
?>
