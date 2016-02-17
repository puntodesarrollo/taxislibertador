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
	

	//Variables album
	$nombre = $_POST["nombre"];

	$texto = $_POST['txtEditorContent'];

	//agregar los datos a la BD
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	
	//Se agregan los datos

	
	$resultado = $con->query("INSERT INTO servicios (titulo,descripcion) VALUES('$nombre','$texto')");

	}

	mysqli_close($con);

	//redireccionar a programas
	header("location:/admin/servicios");
?>
