<?php
	
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}
		
	if($_GET["t"]!=null){
		
		$ID = $_GET["t"];
		
		include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

		$sql="DELETE FROM reservas WHERE ID='".$ID."'";
		$result = mysqli_query($con,$sql);
		
		mysqli_close($con);
		//redireccionar a reservas
		header("location:/admin/reservas");
	}
?>
