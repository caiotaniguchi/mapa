<?php
class EstadoDAO {
    private $conexao;
    private $db;
    
    // Attempts to initialize the database connection using the supplied info.
    public function EstadoDAO($host, $usuario, $senha, $database) {
        $this->conexao = mysql_connect($host, $usuario, $senha);
        $this->db = mysql_select_db($database);
    }
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql) {
        $resultados = mysql_query($sql, $this->conexao) or die(mysql_error());

            
        if(mysql_num_rows($resultados) > 0) {
for($i = 0; $i < mysql_num_rows($resultados); $i++) {
$linha = mysql_fetch_assoc($resultados);
$estadoModulo[$i] = new EstadoModulo();
                
$estadoModulo[$i]->setId($linha['id']);
$estadoModulo[$i]->setIdModulo($linha['modulo_id']);
$estadoModulo[$i]->setEstado($linha['nome']);
$estadoModulo[$i]->setDataEntrada($linha['criado']);	
}
        }
        return $estadoModulo[count($estadoModulo)-1];
    }
    
    // Retorna o ultimo estado de um modulo
    public function getPorIdModulo($idModulo) {
        //$sql = "SELECT * FROM estado ORDER BY id DESC LIMIT 1 WHERE id=".$idModulo;
        $sql = "SELECT * FROM estado WHERE modulo_id=".$idModulo;
        return $this->executar($sql);
    }
    
    public function gravar($modulo) {
        $affectedRows = 0;
        
        if($modulo->getId() != "") {
            $moduloAntigo = $this->getPorIdModulo($userVO->getId());
        }
        
        // If the query returned a row then update,
        // otherwise insert a new user.
        if(sizeof($currUserVO) > 0) {
            $sql = "UPDATE users SET ".
                "username='".$userVO->getUsername()."', ".
                "password='".$userVO->getPassword()."' ".
                "WHERE id=".$userVO->getId();
            
            mysql_query($sql, $this->connect) or die(mysql_error());
            $affectedRows = mysql_affected_rows();
        }
        else {
            $sql = "INSERT INTO users (username, password) VALUES('".
                $userVO->getUsername()."', ".
                $userVO->getPassword()."')".
            
            mysql_query($sql, $this->connect) or die(mysql_error());
            $affectedRows = mysql_affected_rows();
        }
        
        return $affectedRows;
    }
}
?>
