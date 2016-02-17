<?php

	session_start();

	$conVerificar = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

	$sqlVerificar="SELECT password FROM admin WHERE usuario = '" . $_SESSION['usuario'] . "' AND ID='" . $_SESSION['IDUsuario'] . "'";
		
	$resultVerificar = mysqli_query($conVerificar,$sqlVerificar);

	if(!($resultVerificar===false) && $resultVerificar->num_rows>0)
	{	
		mysqli_close($conVerificar);
		return true;
	}
	mysqli_close($conVerificar);
	return false;

?>