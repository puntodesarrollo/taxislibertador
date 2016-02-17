<?php
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}
	
	$retorno="false";	
	$nombre=$_GET["nombre"];
	
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";					
	
	$sql="SELECT titulo FROM servicios WHERE titulo='$nombre'";
	
	$result = mysqli_query($con,$sql);
		
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		if($fila["titulo"]==$nombre && $nombre!="")
		{
			$retorno="true";
		}
	}
	mysqli_close($con);
	
	echo $retorno;
?>