<?php

	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	define ('SITE_ROOT', realpath(dirname(__FILE__)));
	$path="/imagenes/";    

	$nombre = $_POST["nombre"];
	$descripcion = $_POST["descripcion"];
	$cantidad = $_POST["cantidad"];
	$precio = $_POST["precio"];
	$dias = $_POST["dias"];		 
    $categoria = $_POST["categoria"];

	//$resultado = $con->query("INSERT INTO productos (nombre,descripcion,precio,cantidad) VALUES('$nombre','$descripcion','$precio', '$cantidad')");
	$query="INSERT INTO productos (nombre,descripcion,precio,cantidad,mostrar,Idcategoria) VALUES('$nombre','$descripcion','$precio', '$cantidad',1,'$categoria')";	
	$con->query($query);
	$id_producto =$con->insert_id;	
	

    foreach ($dias as $dia) {  
    	$resultado = $con->query("INSERT INTO dias_productos (id_producto,dia) VALUES('$id_producto','$dia')");    	   
    	
    }

	foreach($_FILES['imagen']['tmp_name'] as $key => $tmpName) {
	    $nombreArchivo =str_replace(" ","_",$_FILES['imagen']['name'][$key]);  		
  		$file_tmp  = $_FILES['imagen']['tmp_name'][$key];
  		move_uploaded_file($file_tmp, SITE_ROOT. $path .$nombre.$nombreArchivo);
		$ruta="imagenes/" .$nombre.$nombreArchivo;
		$resultado = $con->query("INSERT INTO fotos_productos (id_producto,ruta_foto) VALUES('$id_producto','$ruta')");   
	}



	mysqli_close($con);
    header("location:/admin/productos");
	
?>
