<?php	
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	//Variables album
	$nombre = $_POST["nombre"];

	//agregar los datos a la BD
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

	$sql="SELECT * FROM creatuplatobase";

	$result = mysqli_query($con,$sql);
	
	//Se agregan los datos			
	$resultado = $con->query("INSERT INTO creatuplatoacompanamiento(nombre) VALUES('$nombre')");

	mysqli_close($con);

	//redireccionar a programas
	header("location:/admin/creatuplato");
?>
