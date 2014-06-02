<?php
class ModuloDAO {
    private var $conexao;
    private var $db;
    
    // Attempts to initialize the database connection using the supplied info.
    public function ModuloDAO($host, $usuario, $senha, $database) {
        $this->conexao = mysql_connect($host, $usuario, $senha);
        $this->db = mysql_select_db($database);
    }
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql) {
        $resultados = mysql_query($sql, $this->conexao) or die(mysql_error());
        
        if(mysql_num_rows($resultados) > 0) {
            for($i = 0; $i < mysql_num_rows($resultados); $i++) {
                $linha = mysql_fetch_assoc($resultados);
                $modulos[$i] = new modulo();
                
                $modulos[$i]->setId($linha['id']);
                $modulos[$i]->setNome($linha['nome']);

           		// conferir estado no banco de dados
                $modulos[$i]->setEstado($linha['estado']);
                $modulos[$i]->setIdAmbiente($linha['idAmbiente']);
            }
        }
        return $modulos;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'modulos' no banco de dados
    public function getPorIdAmbiente($idAmbiente) {
        $sql = "SELECT * FROM modulos WHERE id=".$idAmbiente;
        return $this->executar($sql);
    }
    
}
?>
