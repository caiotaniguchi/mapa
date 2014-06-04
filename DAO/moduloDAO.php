<?php
include 'modulo.php';

class ModuloDAO {
    private $conexao;
    private $db;
    private $estadoDAO;
    
    // Attempts to initialize the database connection using the supplied info.
    public function ModuloDAO($host, $usuario, $senha, $database, $estadoDAO) {
        $this->conexao = mysql_connect($host, $usuario, $senha);
        $this->db = mysql_select_db($database);
        $this->estadoDAO = $estadoDAO;
    }
    
    // Executa uma query e retorna um array de modulos
    protected function executar($sql) {
        $resultados = mysql_query($sql, $this->conexao) or die(mysql_error());
        $modulos = null;
        
        if(mysql_num_rows($resultados) > 0) {
            for($i = 0; $i < mysql_num_rows($resultados); $i++) {
                $linha = mysql_fetch_assoc($resultados);
                $modulos[$i] = new modulo();
                      
                $modulos[$i]->setId($linha['id']);
                $modulos[$i]->setIdAmbiente($linha['sala_id']);
				$modulos[$i]->setEstado($this->estadoDAO->getPorIdModulo($modulos[$i]->getId()));
            }
        }
        return $modulos;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'modulos' no banco de dados
    public function getPorIdAmbiente($idAmbiente) {
        $sql = "SELECT * FROM modulo WHERE id = ".$idAmbiente;
        return $this->executar($sql);
    }
    
     
    public function gravar($modulo) {
        
        if($modulo->getId() != "") {
            $modulosAtuais = $this->getPorIdAmbiente($modulo->getIdAmbiente());
        }
        
        $update = false;
        
        for ($i = 0; $i < count($modulosAtuais); $i++) {
			if ($modulosAtuais[$i]->getId() == $modulo->getId()) {
				$update = true;
			}
		}
		
		// If the query returned a row then update,
        // otherwise insert a new user.
        if($update) {
            $sql = 	"UPDATE modulo SET ".
					"sala_id=".$modulo->getIdAmbiente().", ".
					"WHERE id=".$modulo->getId();
            
            mysql_query($sql, $this->conexao) or die(mysql_error());
        }
        else {
            $sql = "INSERT INTO modulo (sala_id) VALUES(".
					$modulo->getIdAmbiente().")";
            
            mysql_query($sql, $this->conexao) or die(mysql_error());
        }
        return true;
    }
    
}
?>
