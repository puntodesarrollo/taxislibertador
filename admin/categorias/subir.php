<?php
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	//Variables album
	$nombre = $_POST["nombre"];

	//agregar los datos a la BD
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";	
	
	//Se agregan los datos			
	$resultado = $con->query("INSERT INTO categorias(nombre) VALUES('$nombre')");

	//redireccionar a programas
	header("location:/admin/categorias");
?>
