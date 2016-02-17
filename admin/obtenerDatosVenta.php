<?php	
	if($IDpedido!=null){

		//obtener los datos de la bd
		$conObtenerDatosVenta = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

		$sqlObtenerDatosVenta="SELECT * FROM pedidos WHERE ID='$IDpedido'";

		$resultObtenerDatosVenta = mysqli_query($conObtenerDatosVenta,$sqlObtenerDatosVenta);
		
		if($resultObtenerDatosVenta===false || $resultObtenerDatosVenta->num_rows===0)
		{
			exit;
		}
		
		for ($z = 0; $z <$resultObtenerDatosVenta->num_rows; $z++) {
			$resultObtenerDatosVenta->data_seek($z);
			$filaObtenerDatosVenta = $resultObtenerDatosVenta->fetch_assoc();

			$IDusuario = $filaObtenerDatosVenta["IDusuario"];
			$Fecha = $filaObtenerDatosVenta["fecha"];
		}


		//Se obtiene el nombre del usuario:
		$sqlObtenerDatosVenta="SELECT * FROM usuarios WHERE ID='$IDusuario'";

		$resultObtenerDatosVenta = mysqli_query($conObtenerDatosVenta,$sqlObtenerDatosVenta);
		
		$Usuario="";

		for ($z = 0; $z <$resultObtenerDatosVenta->num_rows; $z++) {
			$resultObtenerDatosVenta->data_seek($z);
			$filaObtenerDatosVenta = $resultObtenerDatosVenta->fetch_assoc();

			$Usuario = $filaObtenerDatosVenta["nombre"];
		}

		//Se obtiene el total de venta:
		$Total = 0;

		$sqlObtenerDatosVenta="SELECT * FROM detallepedido WHERE IDpedido='$IDpedido'";

		$resultObtenerDatosVenta = mysqli_query($conObtenerDatosVenta,$sqlObtenerDatosVenta);

		for ($z = 0; $z <$resultObtenerDatosVenta->num_rows; $z++) {
			$resultObtenerDatosVenta->data_seek($z);
			$filaObtenerDatosVenta = $resultObtenerDatosVenta->fetch_assoc();

			$Total += ($filaObtenerDatosVenta["cantidad"] * $filaObtenerDatosVenta["precio"]);
		}

		$sqlObtenerDatosVenta="SELECT * FROM pedidoarmapedido WHERE IDpedido='$IDpedido'";

		$resultObtenerDatosVenta = mysqli_query($conObtenerDatosVenta,$sqlObtenerDatosVenta);

		for ($z = 0; $z <$resultObtenerDatosVenta->num_rows; $z++) {
			$resultObtenerDatosVenta->data_seek($z);
			$filaObtenerDatosVenta = $resultObtenerDatosVenta->fetch_assoc();

			$Total += ($filaObtenerDatosVenta["cantidad"] * $filaObtenerDatosVenta["precio"]);
		}
		
		mysqli_close($conObtenerDatosVenta);
	}
?>