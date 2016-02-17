<?php
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	//Variables album
	$nombre = $_POST["nombre"];
	$ID = $_POST["ID"];

	//Se hace la conexion:
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

	if (!$con->set_charset("utf8")) {
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
	}
		
	//Se actualizan los datos en la BD
	$resultado = $con->query("UPDATE creatuplatoacompanamiento set nombre='$nombre' WHERE ID='$ID'");
	
	//redireccionar a programas
	header("location:/admin/creatuplato");
?>
