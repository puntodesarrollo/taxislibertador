<?php
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	//Variables album
	$usuario = $_SESSION['usuario'];
	$actual = $_POST["contrasenaActual"];
	$nueva = $_POST["nuevaContrasena"];
	$nueva2 = $_POST["nuevaContrasena2"];

	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

	$sql="SELECT password FROM admin WHERE usuario = '" . $usuario . "'";
		
	$result = mysqli_query($con,$sql);
	
	$cambiarContrasena=false;
	
	for ($i = 0; $i < 1; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		if($fila["password"]==$actual)
		{
			$cambiarContrasena=true;
		}
	}
	
	if($cambiarContrasena)
	{
		$sql="UPDATE admin SET password='".$nueva."' WHERE usuario = '" . $usuario . "'";
		
		$result = mysqli_query($con,$sql);
		
		unset($_SESSION["IDUsuario"]);
		unset($_SESSION["usuario"]);
		
		//redireccionar a login (contraseña cambiada correctamente)
		header("location:/admin/login/index.php?m=1");
	}
	else
	{
		//redireccionar a login (error de contraseña)
		header("location:/admin/login/cambiarContrasena.php?e=1");
	}	
?>
