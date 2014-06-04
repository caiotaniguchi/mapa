<?php
include 'edificio.php';

class EdificioDAO {
    private $conexao;
    private $db;
    private $andarDAO;
    
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
				$edificios[$i] = new Edificio();
                
                $edificios[$i]->setId($linha['id']);
                $edificios[$i]->setNome($linha['nome']);
				$edificios[$i]->setAndarInicial($linha['andar_inicial']);
                $edificios[$i]->setAndarFinal($linha['andar_final']);
				//$edificios[$i]->setListaAndares($this->andarDAO->getPorIdEdificio($edificios[$i]->getId()));
            }
        }
        return $edificios;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'andares' no banco de dados
    public function getEdificios() {
        $sql = "SELECT * FROM edificio";
        return $this->executar($sql);
    }
    
    public function loadListaAndares($edificio) {
		$edificio->setListaAndares($this->andarDAO->getPorIdEdificio($edificio->getId()));
		return $edificio;
    }
    
}
?>
