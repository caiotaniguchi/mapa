<?php
class AmbienteDAO {
    private var $conexao;
    private var $db;
    private var $moduloDAO;
    
    // Attempts to initialize the database connection using the supplied info.
    public function AmbienteDAO($host, $usuario, $senha, $database, $moduloDAO) {
        $this->conexao = mysql_connect($host, $usuario, $senha);
        $this->db = mysql_select_db($database);
        $this->moduloDAO = $moduloDAO;
    }
    
    // Executes the specified query and returns an associative array of reseults.
    protected function executar($sql) {
        $resultados = mysql_query($sql, $this->conexao) or die(mysql_error());
        
        if(mysql_num_rows($resultados) > 0) {
            for($i = 0; $i < mysql_num_rows($resultados); $i++) {
                $linha = mysql_fetch_assoc($resultados);
                $ambientes[$i] = new ambiente();
                
                $ambientes[$i]->setId($linha['id']);
                $ambientes[$i]->setNome($linha['nome']);
				$ambientes[$i]->setPosicaoX($linha['posicaoX']);
                $ambientes[$i]->setPosicaoY($linha['posicaoY']);                
                $ambientes[$i]->setIdAmbiente($linha['idAmbiente']);
            }
        }
        return $ambientes;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'ambientes' no banco de dados
    public function getPorIdAndar($idAndar) {
        $sql = "SELECT * FROM ambientes WHERE id=".$idAndar;
        $listaAmbientes = $this->executar($sql);
        for($i = 0; $i < count($listaAmbientes); $i++) {
			$listaAmbientes[$i]->setListaModulos(
				$moduloDAO->getPorIdAmbiente($listaAmbientes[$i]->getId())
				);
		}
		return $listaAmbientes;
    }
    
}
?>
