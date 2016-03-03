<?php 

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		exit;
	}

	$arreglo = array();

	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

	$sql="SELECT * FROM categoria_cliente ORDER BY ID";

	$result = mysqli_query($con,$sql);
	
	for ($i = 0; $i <$result->num_rows; $i++) 
	{
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		$arreglo[$i][0] = $fila["ID"];
		$arreglo[$i][1] = $fila["nombre"];
	}

	return $arreglo;	
?>
	