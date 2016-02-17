<?php
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	//Variables
	$nombre = $_POST["nombre"];
	$nombreAnterior = $_POST["nombreAnterior"];

	//agregar los datos a la BD
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
		
	//Se actualizan los datos en la BD
	$resultado = $con->query("UPDATE categorias set nombre='$nombre' WHERE nombre='$nombreAnterior'");
	
	//redireccionar a programas
	header("location:/admin/categorias");
?>
