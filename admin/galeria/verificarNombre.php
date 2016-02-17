<?php
	
	$retorno="false";	
	$nombre=$_GET["imagen"];

	$nombre=str_replace(" ","_",$nombre);
	$nombre=str_replace("/","_",$nombre);

	$path="imgGaleria/";

	$nombre = $path . $nombre;

	//Se hace la conexion:
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";				
	
	$sql="SELECT ruta_foto FROM fotos_galeria WHERE ruta_foto='$nombre'";
	
	$result = mysqli_query($con,$sql);
		
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		if($fila["ruta_foto"]==$nombre && $nombre!="")
		{
			$retorno="true";
		}
	}
	mysqli_close($con);
	
	echo $retorno;
?>
