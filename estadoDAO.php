<?php
class EstadoDAO {
    private $conexao;
    private $db;
    
    // Attempts to initialize the database connection using the supplied info.
    public function EstadoDAO($host, $usuario, $senha, $database) {
        $this->conexao = mysql_connect($host, $usuario, $senha);
        $this->db = mysql_select_db($database);
        echo "conectei\n";
    }
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql) {
        $resultados = mysql_query($sql, $this->conexao) or die(mysql_error());
        
        if(mysql_num_rows($resultados) > 0) {
			$linha = mysql_fetch_assoc($resultados);
            $estadoModulo = new EstadoModulo();
                
            $estadoModulo->setId($linha['id']);
            $estadoModulo->setIdModulo($linha['modulo_id']);
			$estadoModulo->setEstado($linha['nome']);
			$estadoModulo->setDataEntrada($linha['criado']);			
        }
        
        return $estadoModulo;
    }
    
    // Retorna o ultimo estado de um modulo
    public function getPorIdModulo($idModulo) {
        //$sql = "SELECT * FROM estado ORDER BY id DESC LIMIT 1 WHERE id=".$idModulo;
        $sql = "SELECT * FROM estado WHERE id=".$idModulo;
        return $this->executar($sql);
    }
    
}
?>
