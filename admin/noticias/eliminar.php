<?php
	
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}
		
	if($_GET["t"]!=null){
		
		$ID = $_GET["t"];
		
		include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
		
		$sql="SELECT * FROM noticias WHERE ID='$ID'";

		$result = mysqli_query($con,$sql);
		
		if($result===false || $result->num_rows===0)
		{
			header("location:/admin/noticias");
		}
		
		for ($i = 0; $i <$result->num_rows; $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();
			
			unlink($fila["imagen"]);
		}


		$sql="DELETE FROM noticias WHERE ID='".$ID."'";
		$result = mysqli_query($con,$sql);
		
		mysqli_close($con);
		//redireccionar a productos
		header("location:/admin/noticias");
	}
?>
