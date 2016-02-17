<?php

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	define ('SITE_ROOT', realpath(dirname(__FILE__)));

	$path="/imagenes/";
		
	if($_GET["t"]!=null){
	
		$nombre = $_GET["t"];
		
		$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

		if($sesion===false){
			header("location:/admin/login");
			exit;
		}

		//Variables
		$nombre = $_GET["t"];

		//agregar los datos a la BD
		include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
		
		$sql="DELETE FROM categorias WHERE nombre='".$nombre."'";
		$result = mysqli_query($con,$sql);
		
		$sql="UPDATE productos set categoria='Sin Categoria' WHERE categoria='".$nombre."'";
		$result = mysqli_query($con,$sql);
		
		mysqli_close($con);
		//redireccionar a productos
		header("location:/admin/categorias");
	}
?>
