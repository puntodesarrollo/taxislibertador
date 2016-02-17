<?php
	
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	$id = $_POST["id"];
	$nombre = $_POST["nombre"];
	$cantidad = $_POST["cantidad"];
	$descripcion = $_POST["descripcion"];
	$precio = $_POST["precio"];
	$categoria = $_POST["categoria"];
	$mostrar = $_POST["mostrar"];

		    
	$resultado = $con->query("UPDATE productos set nombre='$nombre', descripcion='$descripcion', cantidad='$cantidad', precio='$precio', mostrar='$mostrar', Idcategoria='$categoria' WHERE id='$id'");
	

	$delete = $con->query("DELETE FROM dias_productos WHERE id_producto='$id'");  

	$dias = $_POST["dias"];	
    foreach ($dias as $dia) {  
    	$insert = $con->query("INSERT INTO dias_productos (id_producto,dia) VALUES('$id','$dia')");    	   
    	
    }
	mysqli_close($con);
	header("location:/admin/productos");
?>
