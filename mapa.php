<?
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include "DAO/estadoDAO.php";
include "DAO/moduloDAO.php";
include "DAO/ambienteDAO.php";
include "DAO/andarDAO.php";
include "DAO/edificioDAO.php";
include "DAO/DAO.php";
session_start();
$mapa = Mapa::createPersistent( '1' );

$mapa->dao = new DAO('localhost','root','1234','rede_sensores');
/*
 * 	This is my persistent php object base class
 *  -------------------------------------------
 * 
 *  how to use it: 
 *  1. derive a class via "extends" (see example)
 *  2. call $obj = MyObject::createPersistent( 'abcd' );
 *  3. use the $obj as you want it is now stored automatically!
 *  4. don't belive it? try it! 
 * 
 */ 
 class SessionObject{

 	var $storageName;
 	var $className;

	function __construct(){
	}

	
	// save this or derived objects on destruction
 	function __destruct(){
 		$this->store();
 	}
 	
 	/*
 	 * 	a call to this static function searches in the session
 	 *  for the desired object or alternatively creates a new object
 	 *  of this kind
 	 */ 
	static function createPersistent( $objectID ){
		$class = get_called_class();
		$storageName = $class.'_ID_'.$objectID;
		
		
		if (array_key_exists($storageName, $_SESSION)){
			//echo 'Restored '.$storageName.''; 
			return $_SESSION[$storageName];
		} else {
			//echo 'create '.$class.' with ID '.$objectID.'';
			$temp = new $class();
			$temp->storageName=$storageName;
			$temp->className=$class;
			return $temp; 
		}
	 }
	
	// internal store function  	
 	function store(){
		$_SESSION[$this->storageName] = $this;
		//echo "Stored ".$this->storageName.'';
 	}
}
	
 	


class Mapa extends SessionObject{
	public $listaEdificios;
	public $edificioSelecionado;
	private $andarSelecionado;
	private $listaAmbientes;

	public $dao;
	private $estadoDAO;
	private $moduloDAO;
	private $ambienteDAO;
	private $andarDAO;
	private $edificioDAO;

	private $db_host = 'localhost';
	private $db_usuario = 'root';
	private $db_senha = '1234';
	private $db_database = 'rede_sensores';

	public function Mapa(){
		$public->dao = new DAO('localhost','root','1234','rede_sensores');
		$this->estadoDAO = new EstadoDAO();
		$this->moduloDAO = new ModuloDAO($this->estadoDAO);
		$this->ambienteDAO = new AmbienteDAO($this->moduloDAO);
		$this->andarDAO = new AndarDAO($this->ambienteDAO);
		$this->edificioDAO = new EdificioDAO($this->andarDAO);
	}

	public function getListaEdificios(){
		$this->listaEdificios = $this->edificioDAO->getEdificios($this->dao->getConexao());
		//echo json_encode($this->listaEdificios); 
	}

	public function sel_Edificio($ed_id){
		
		$this->edificioSelecionado = $this->listaEdificios[$ed_id];
		$this->edificioSelecionado = $this->edificioDAO->loadListaAndares($this->edificioSelecionado, $this->dao->getConexao());
		echo "(".json_encode($this->edificioSelecionado->getListaAndares()).")";

	}
	public function sel_Andar($an_id){
		$this->andarSelecionado = $this->edificioSelecionado->getListaAndares().$an_id;
	}
}
if (!$mapa){
	//$mapa = Mapa::createPersistent( 'abcd' );
	//$_SESSION['mapa'] = serialize($mapa);
}
if($_REQUEST['ed_id']){
	$mapa->sel_Edificio($_REQUEST['ed_id']);
}
if($_REQUEST["atualizarAmb"]){
	$mapa->atualizarAmb($_REQUEST["atualizarAmb"]);
}
//echo "ok";

//$mapa->$listaEdificios;
// include 'DAO/edificioDAO.php';
// include 'DAO/andarDAO.php';

// $db_host = 'localhost';
// $db_usuario = 'root';
// $db_senha = '1234';
// $db_database = 'rede_sensores'

// if(!isset($_SESSION['edificios'])){
// 	$ed_DAO = new EdificioDAO($db_host, $db_usuario, $db_senha, $db_database, 1);
//  	$_SESSION['edificios'] = $ed_DAO->getEdificios();
// }

// $ed_id = $_REQUEST['ed_id'];
// $an_id = $_REQUEST['an_id'];
// if($_SESSION)
// $db_host = 'localhost';
// $db_usuario = 'root';
// $db_senha = '1234';
// $db_database = 'rede_sensores';
// $anDao = new AndarDAO($db_host, $db_usuario, $db_senha, $db_database, 1);
// $edDao = new EdificioDAO($db_host, $db_usuario, $db_senha, $db_database, $anDao);
// if($ed_id){
// 	$edDao->loadListaAndares($ed_id);
// }
// if ($an_id){
// 	echo "plantas/planta$an_id.jpg";
// }
?>
