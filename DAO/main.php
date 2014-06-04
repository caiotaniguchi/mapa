<?php
	include "estadoDAO.php";
	include "moduloDAO.php";
	include "ambienteDAO.php";
	include "andarDAO.php";
	include "edificioDAO.php";
	
	
	$host = 'localhost';
	$usuario = 'root';
	$senha = '1234';
	$database = 'mapa';
	
	$estadoDAO = new EstadoDAO($host,$usuario,$senha,$database);
	$moduloDAO = new ModuloDAO($host,$usuario,$senha,$database,$estadoDAO);
	$ambienteDAO = new AmbienteDAO($host,$usuario,$senha,$database,$moduloDAO);
	$andarDAO = new AndarDAO($host,$usuario,$senha,$database,$ambienteDAO);
	$edificioDAO = new EdificioDAO($host,$usuario,$senha,$database,$andarDAO);
	
	$edificios = $edificioDAO->getEdificios();
	echo $edificios[0]->getId()."\n";
	echo $edificios[0]->getListaAndares()."\n";
	$edificios[0] = $edificioDAO->loadListaAndares($edificios[0]);
	$andares = $edificios[0]->getListaAndares();
	echo $andares[0]->getId()."\n";
	$andares[0] = $andarDAO->loadListaAmbientes($andares[0]);
	
	/*
	$moduloNovo = new Modulo();
	$moduloNovo->setId(5);
	$moduloNovo->setIdAmbiente(5);
	
	$moduloDAO->gravar($moduloNovo);
	*/
	
?>
