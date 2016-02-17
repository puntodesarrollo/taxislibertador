<?php
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	define ('SITE_ROOT', realpath(dirname(__FILE__)));
	$path="/imagenes/";

	//Variables album
	$ID = $_POST["ID"];
	$nombre = $_POST["nombre"];

	$texto = $_POST['txtEditorContent'];

	//Se hace la conexion:
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

	if($_FILES["imagen"]["name"]!="")
	{
		//Se elimina la imagen actual:
		$sql="SELECT * FROM servicios WHERE ID='$ID'";

		$result = mysqli_query($con,$sql);
		
		if($result===false || $result->num_rows===0)
		{
			header("location:/admin/servicios");
		}
		
		for ($i = 0; $i <$result->num_rows; $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();
			
			if($fila["imagen"]!=null && $fila["imagen"]!="")
			{
				unlink($fila["imagen"]);
			}
		}

		//se sube la nueva imagen y se actualizan los datos
		$nombreArchivo =str_replace(" ","_",$_FILES['imagen']['name']); 
		$nombreArchivo =str_replace("/","_", $nombreArchivo);

		$subida = $nombre.$nombreArchivo;
		$subida =str_replace(" ","_", $subida);
		$subida =str_replace("/","_", $subida);

  		$file_tmp  = $_FILES['imagen']['tmp_name'];
  		move_uploaded_file($file_tmp, SITE_ROOT. $path .$subida);
		$ruta="imagenes/" .$subida;
		$resultado = $con->query("UPDATE servicios SET titulo='$nombre', descripcion='$texto', imagen='$ruta' WHERE ID='$ID'");

	}
	else{
		$resultado = $con->query("UPDATE servicios SET titulo='$nombre', descripcion='$texto' WHERE ID='$ID'");

	}
	
	//redireccionar a programas
	header("location:/admin/servicios");
?>
