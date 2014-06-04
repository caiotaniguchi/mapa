<?php
include 'modulo.php';

class ModuloDAO {
	private $estadoDAO;
	
	public function ModuloDAO ($estadoDAO) {
		$this->estadoDAO = $estadoDAO;
	}
    
    // Executa uma query e retorna um array de modulos
    protected function executar($sql, $conexao) {
        $resultados = mysql_query($sql, $conexao) or die(mysql_error());
        $modulos = null;
        
        if(mysql_num_rows($resultados) > 0) {
            for($i = 0; $i < mysql_num_rows($resultados); $i++) {
                $linha = mysql_fetch_assoc($resultados);
                $modulos[$i] = new modulo();
                      
                $modulos[$i]->setId($linha['id']);
                $modulos[$i]->setIdAmbiente($linha['sala_id']);
				$modulos[$i]->setEstado($this->estadoDAO->getPorIdModulo($modulos[$i]->getId(), $conexao));
            }
        }
        return $modulos;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'modulos' no banco de dados
    public function getPorIdAmbiente($idAmbiente, $conexao) {
        $sql = "SELECT * FROM modulo WHERE id = ".$idAmbiente;
        return $this->executar($sql, $conexao);
    }
    
     
    public function gravar($modulo, $conexao) {
        
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
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        else {
            $sql = "INSERT INTO modulo (sala_id) VALUES(".
					$modulo->getIdAmbiente().")";
            
            mysql_query($sql, $conexao) or die(mysql_error());
        }
        return true;
    }
    
}
?>
