<?php
include 'estado.php';

class EstadoDAO {
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql, $conexao) {
        //$resultados = mysql_query($sql, $this->conexao) or die(mysql_error());
		$resultados = mysql_query($sql, $conexao) or die(mysql_error());

            
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
    public function getPorIdModulo($idModulo, $conexao) {
        //$sql = "SELECT * FROM estado ORDER BY id DESC LIMIT 1 WHERE id=".$idModulo;
        $sql = "SELECT * FROM estado WHERE modulo_id=".$idModulo;
        return $this->executar($sql, $conexao);
    }
   
}
?>
