<?php
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	define ('SITE_ROOT', realpath(dirname(__FILE__)));

	//Variables album
	$ID = $_POST["ID"];
	$texto1 = $_POST['txtEditorContent'];
	$texto2 = $_POST['txtEditorContent2'];

	//Se hace la conexion:
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";


		$resultado = $con->query("UPDATE about SET quienes='$texto1', history='$texto2' WHERE ID='$ID'");
	
	//redireccionar a programas
	header("location:/admin/about.php");
?>
