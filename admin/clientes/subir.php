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
	$categoria = $_POST["categoria"];

	//agregar los datos a la BD
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	
	//Se agregan los datos
	
	$nombreArchivo =str_replace(" ","_", $_FILES['imagen']['name']);

	$nombreArchivo =str_replace("/","_", $nombreArchivo);

	$subida = $nombre.$nombreArchivo;

	$subida =str_replace(" ","_", $subida);

	$subida =str_replace("/","_", $subida);

	move_uploaded_file($_FILES["imagen"]["tmp_name"], SITE_ROOT. $path . $subida);

	$ruta="imagenes/" .$subida;

	$sql = "INSERT INTO clientes (nombre ,imagen, categoria) VALUES('$nombre','$ruta','$categoria')";

	$resultado = $con->query($sql); 

	mysqli_close($con);

	//redireccionar a programas
	header("location:/admin/clientes");
?>
