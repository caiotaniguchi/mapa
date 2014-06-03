<?php
	include 'estado.php';
	include 'modulo.php';
	
	include 'estadoDAO.php';
	include 'moduloDAO.php';
	
	$host = 'localhost';
	$usuario = 'root';
	$senha = '1234';
	$database = 'mapa';
	
	$estadoDAO = new EstadoDAO($host, $usuario, $senha, $database);
	$moduloDAO = new ModuloDAO($host, $usuario, $senha, $database, $estadoDAO);
	
	$modulo = new Modulo();
	//$modulo->setId(1);
	 $moduloDAO->getPorIdAmbiente(1);
	echo $modulo->getId();
?>
