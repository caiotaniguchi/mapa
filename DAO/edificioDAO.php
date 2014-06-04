<?php
include 'edificio.php';
include 'andarDAO.php';

class EdificioDAO {
    
    /*
    // Attempts to initialize the database connection using the supplied info.
    public function EdificioDAO($host, $usuario, $senha, $database) {
        $this->conexao = mysql_connect($host, $usuario, $senha);
        $this->db = mysql_select_db($database);
        $this->andarDAO = $andarDAO;
    }*/
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql, $conexao) {
        $resultados = mysql_query($sql, $conexao) or die(mysql_error());
        
        if(mysql_num_rows($resultados) > 0) {
            for($i = 0; $i < mysql_num_rows($resultados); $i++) {
                $linha = mysql_fetch_assoc($resultados);
				$edificios[$linha['id']] = new Edificio();
                
                $edificios[$linha['id']]->setId($linha['id']);
                $edificios[$linha['id']]->setNome($linha['nome']);
				$edificios[$linha['id']]->setAndarInicial($linha['andar_inicial']);
                $edificios[$linha['id']]->setAndarFinal($linha['andar_final']);
				//$edificios[$i]->setListaAndares($this->andarDAO->getPorIdEdificio($edificios[$i]->getId()));
            }
        }
        return $edificios;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'andares' no banco de dados
    public function getEdificios($conexao) {
        $sql = "SELECT * FROM edificio";
        return $this->executar($sql, $conexao);
    }
    
    public function loadListaAndares($edificio, $conexao) {
		$andarDAO = new AndarDAO();
		
		$edificio->setListaAndares($andarDAO->getPorIdEdificio($edificio->getId(), $conexao));
		return $edificio;
    }
    
    public function gravar($edificio, $conexao) {
        $edificiosAtuais = null;
        
        if($edificio->getId() != "") {
            $edificiosAtuais = $this->getEdificios($conexao);
        }
        
        $update = false;
        
        for ($i = 0; $i < count($edificiosAtuais); $i++) {
			if ($edificiosAtuais[$i]->getId() == $edificio->getId()) {
				$update = true;
			}
		}
		
		// If the query returned a row then update,
        // otherwise insert a new user.
        if($update) {
            $sql = 	"UPDATE edificio SET ".
					"nome=".$edificio->getNome().", ".
					"andar_inicial=".$edificio->getAndarInicial().", ".
					"andar_final=".$edificio->getAndarFinal().", ".
					"WHERE id=".$edificio->getId();
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        else {
            $sql = 	"INSERT INTO edificio (nome, andar_inicial, andar_final) VALUES('".
					$edificio->getNome()."', ".
					$edificio->getAndarInicial().", ".
					$edificio->getAndarFinal().")";
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        return true;
    }
    
}
?>
