<?php
	include 'estado.php';
	include 'modulo.php';
	include 'ambiente.php';
	include 'andar.php';
	include 'edificio.php';
	
	
	include 'estadoDAO.php';
	include 'moduloDAO.php';
	include 'ambienteDAO.php';
	include 'andarDAO.php';
	include 'edificioDAO.php';
	
	
	$host = 'localhost';
	$usuario = 'root';
	$senha = '1234';
	$database = 'mapa';
	
	$estadoDAO = new EstadoDAO($host, $usuario, $senha, $database);
	$moduloDAO = new ModuloDAO($host, $usuario, $senha, $database, $estadoDAO);
	$ambienteDAO = new AmbienteDAO($host, $usuario, $senha, $database, $moduloDAO);
	$andarDAO = new AndarDAO($host, $usuario, $senha, $database, $ambienteDAO);
	$edificioDAO = new EdificioDAO($host, $usuario, $senha, $database, $andarDAO);
	
	
	$edificios = $edificioDAO->getEdificios();
	$andares = $andarDAO->getPorIdEdificio($edificios[0]->getId());
	$ambientes = $andares[0]->getListaAmbientes($andares[0]->getId());
	$modulos = $ambientes[0]->getListaModulos($ambientes[0]->getId());
	$estado = $modulos[0]->getEstado($modulos[0]->getId());
	echo $estado->getDataEntrada()."\n";
	
	/*
	$modulos = $moduloDAO->getPorIdAmbiente(1);
	echo $modulos[0]->getId()."\n";
	$estado = $modulos[0]->getEstado();
	echo $estado->getDataEntrada();
	*/
?>
