<?php
	if($IDproducto!=null){

		//obtener los datos de la bd
		$conObtenerDatosProducto = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
		$sqlObtenerDatosProducto="SELECT * FROM productos WHERE ID='$IDproducto'";

		$resultObtenerDatosProducto = mysqli_query($conObtenerDatosProducto,$sqlObtenerDatosProducto);
		
		if($resultObtenerDatosProducto===false || $resultObtenerDatosProducto->num_rows===0)
		{
			exit;
		}
		
		for ($z = 0; $z <$resultObtenerDatosProducto->num_rows; $z++) {
			$resultObtenerDatosProducto->data_seek($z);
			$estaFila = $resultObtenerDatosProducto->fetch_assoc();

			$Producto = $estaFila["nombre"];
		}
		
		mysqli_close($conObtenerDatosProducto);
	}
?>