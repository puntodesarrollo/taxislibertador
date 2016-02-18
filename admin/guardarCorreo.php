<?php
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	define ('SITE_ROOT', realpath(dirname(__FILE__)));

	//Variables album
	$correo = $_POST['correo'];

	//Se hace la conexion:
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

		$resultado = $con->query("UPDATE correo SET correo='$correo'");
	
	//redireccionar a programas
	header("location:/admin/about.php");
?>
