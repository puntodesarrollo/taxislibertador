<?php
$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

		if($sesion===false){
			header("location:/admin/login");
			exit;
		}
		include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
    	


		$id_imagen= $_GET["t"];		
		$nombreImagen= $_GET["n"];		
		$id_producto=$_GET["producto"];	 

		define ('SITE_ROOT', realpath(dirname(__FILE__)));
	

	
if($_GET["t"]!=null){		
		
	$sql="DELETE FROM fotos_productos WHERE id='$id_imagen'";
					
	$result = mysqli_query($con,$sql);
	
	unlink($nombreImagen);
	
	mysqli_close($con);
	//redireccionar a imagen de producto
	header("location:/admin/productos/editarImagenes.php?p=$id_producto");

//	header("location:/admin/productos/editarImagenes.php?p=".$id_producto);
}
?>