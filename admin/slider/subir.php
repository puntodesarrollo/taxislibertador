<?php
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	$ruta1="";
	define ('SITE_ROOT', realpath(dirname(__FILE__)));

	$path="imgSlider/";

	//agregar las imágenes que corresponden
	if($_FILES["imagen"]["name"]!="")
	{
		$nombreArchivo=str_replace(" ","_",$_FILES["imagen"]["name"]);
		$nombreArchivo=str_replace(" ","_",$nombreArchivo);
		move_uploaded_file($_FILES["imagen"]["tmp_name"], SITE_ROOT."/". $path . $nombreArchivo);
		$ruta1=$path . $nombreArchivo;
	}

	//agregar los datos a la BD

	//Se hace la conexion:
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	
	//Se agregan los datos			
	$resultado = $con->query("INSERT INTO slider VALUES('$ruta1')");

	//redireccionar a programas
	header("location:/admin/slider");
?>
