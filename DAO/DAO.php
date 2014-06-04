<?php
class DAO {
    protected $conexao;
    protected $db;
    
    // Attempts to initialize the database connection using the supplied info.
    public function DAO($host, $usuario, $senha, $database) {
        $this->conexao = mysql_connect($host, $usuario, $senha);
        $this->db = mysql_select_db($database);
    }
    
    public function getConexao() {
		return $this->conexao;
	}
    
}
?>
