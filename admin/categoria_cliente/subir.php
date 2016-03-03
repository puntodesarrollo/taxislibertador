<?php	
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

	define ('SITE_ROOT', realpath(dirname(__FILE__)));
	
	$path="/imagenes/";

	//Variables album
	$nombre = $_POST["nombre"];

	//agregar los datos a la BD
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

	$resultado = $con->query("INSERT INTO categoria_cliente (nombre) VALUES('$nombre')"); 


	mysqli_close($con);

	//redireccionar a programas
	header("location:/admin/categoria_cliente");
?>
