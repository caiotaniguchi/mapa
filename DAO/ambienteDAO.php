<?php
include 'ambiente.php';

class AmbienteDAO {
    private $conexao;
    private $db;
    private $moduloDAO;
    
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
                $ambientes[$i] = new Ambiente();
                
                $ambientes[$i]->setId($linha['id']);
                $ambientes[$i]->setNome($linha['nome']);
				$ambientes[$i]->setPosicaoX($linha['posicao_x']);
                $ambientes[$i]->setPosicaoY($linha['posicao_y']);
                $ambientes[$i]->setContorno($linha['contorno']);
                $ambientes[$i]->setIdAndar($linha['andar_id']);
                $ambientes[$i]->setlistaModulos($this->moduloDAO->getPorIdAmbiente($ambientes[$i]->getId()));
            }
        }
        return $ambientes;
    }
    
    // Retrieves the corresponding row for the specified user ID.
    // conferir nome da tabela 'ambientes' no banco de dados
    public function getPorIdAndar($idAndar) {
        $sql = "SELECT * FROM sala WHERE id=".$idAndar;
        return $this->executar($sql);
    }
    
}
?>
