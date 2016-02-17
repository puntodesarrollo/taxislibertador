<?php
	
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	$precio = $_POST["precio"];	
		    
	$resultado = $con->query("UPDATE precioarmapedido set precio='$precio'");

	mysqli_close($con);
	header("location:/admin/creatuplato");
?>
