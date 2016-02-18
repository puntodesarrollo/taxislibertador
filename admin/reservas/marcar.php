<?php
	
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}
		
	if($_GET["t"]!=null){
		
		$ID = $_GET["t"];
		
		include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

		$sql="SELECT * FROM reservas WHERE ID='$ID'";

		$result = mysqli_query($con,$sql);
		
		if($result===false || $result->num_rows===0)
		{
			header("location:/admin/reservas");
		}
		
		for ($i = 0; $i <$result->num_rows; $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();

			$realizado = $fila["realizado"];
		}

		if($realizado=="Sí")
		{
			$cambio="No";
		}
		if($realizado=="No")
		{
			$cambio="Sí";
		}

		$sql="UPDATE reservas SET realizado='$cambio' WHERE ID='".$ID."'";
		$result = mysqli_query($con,$sql);
		
		mysqli_close($con);
		//redireccionar a reservas
		header("location:/admin/reservas");
	}
?>
