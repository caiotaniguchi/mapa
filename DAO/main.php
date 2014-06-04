<?php
	include "edificioDAO.php";
	include "DAO.php";
	
	
	
	$host = 'localhost';
	$usuario = 'root';
	$senha = '1234';
	$database = 'mapa';
	
	//$estadoDAO = new EstadoDAO($host,$usuario,$senha,$database);
	$dao = new DAO ($host,$usuario,$senha,$database);
	$estadoDAO = new EstadoDAO();
	$moduloDAO = new ModuloDAO();
	$ambienteDAO = new AmbienteDAO();
	$andarDAO = new AndarDAO();
	$edificioDAO = new EdificioDAO();
	/*
	$edificios = $edificioDAO->getEdificios();
	echo $edificios[0]->getId()."\n";
	echo $edificios[0]->getListaAndares()."\n";
	$edificios[0] = $edificioDAO->loadListaAndares($edificios[0]);
	$andares = $edificios[0]->getListaAndares();
	echo $andares[0]->getId()."\n";
	$andares[0] = $andarDAO->loadListaAmbientes($andares[0]);
	*/
	/*
	$edificio = $edificioDAO->getEdificios($dao->getConexao());
	
	$andar = $andarDAO->getPorIdEdificio(1,$dao->getConexao());
	$ambiente = $ambienteDAO->getPorIdAndar(1,$dao->getConexao());
	$modulo = $moduloDAO->getPorIdAmbiente(1,$dao->getConexao());
	$estado = $estadoDAO->getPorIdModulo(1,$dao->getConexao());
	echo $estado->getId()."\n";
	echo $modulo[0]->getId()."\n";
	echo $ambiente[0]->getId()."\n";
	echo $andar[0]->getId()."\n";
	echo $edificio[0]->getNome()."\n";
	*/
	/*
	$moduloNovo = new Modulo();
	$moduloNovo->setId(5);
	$moduloNovo->setIdAmbiente(5);
	
	$moduloDAO->gravar($moduloNovo);
	*/
	/*
	$ambienteNovo = new Ambiente();
	$ambienteNovo->setNome("H215");
	$ambienteNovo->setPosicaoX(1);
	$ambienteNovo->setPosicaoY(2);
	$ambienteNovo->setContorno("1234");
	$ambienteNovo->setIdAndar(1);
	
	$ambienteDAO->gravar($ambienteNovo);
	*/
	/*
	
	$andarNovo = new Andar();
	$andarNovo->setNumAndar(3);
	$andarNovo->setPlanta("planta");
	$andarNovo->setIdEdificio(1);
	
	$andarDAO->gravar($andarNovo, $dao->getConexao());
	*/
	
	$edificioNovo = new Edificio();
	$edificioNovo->setNome("ct2");
	$edificioNovo->setAndarInicial(-1);
	$edificioNovo->setAndarFinal(2);
	
	$edificioDAO->gravar($edificioNovo, $dao->getConexao());
	
?>
