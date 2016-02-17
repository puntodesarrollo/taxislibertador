<?php

	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	define ('SITE_ROOT', realpath(dirname(__FILE__)));
	$path="/imagenes/";    

	$id_producto=$_POST["id_producto"];

	foreach($_FILES['imagen']['tmp_name'] as $key => $tmpName) {
	    $nombreArchivo =str_replace(" ","_",$_FILES['imagen']['name'][$key]);  		
  		$file_tmp  = $_FILES['imagen']['tmp_name'][$key];
  		move_uploaded_file($file_tmp, SITE_ROOT. $path .$nombre.$nombreArchivo);
		$ruta="imagenes/" .$nombre.$nombreArchivo;
		$resultado = $con->query("INSERT INTO fotos_productos (id_producto,ruta_foto) VALUES('$id_producto','$ruta')");   
	}



	mysqli_close($con);
    header("location:/admin/productos/editarImagenes.php?p=$id_producto");
	
?>