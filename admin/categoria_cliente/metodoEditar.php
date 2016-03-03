<?php
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	define ('SITE_ROOT', realpath(dirname(__FILE__)));
	$path="/imagenes/";

	//Variables album
	$ID = $_POST["ID"];
	$nombre = $_POST["nombre"];

	//Se hace la conexion:
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	
	$resultado = $con->query("UPDATE categoria_cliente SET nombre='$nombre'WHERE ID='$ID'");
	
	//redireccionar a programas
	header("location:/admin/categoria_cliente");
?>
