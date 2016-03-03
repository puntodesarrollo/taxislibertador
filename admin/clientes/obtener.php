<?php

	function obtenerCliente($ID)
	{
		$datos = array();

		$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

		$sql="SELECT * FROM clientes WHERE ID='$ID'";

		$result = mysqli_query($con,$sql);
		
		for ($i = 0; $i <$result->num_rows; $i++) 
		{
			$result->data_seek($i);
			$fila = $result->fetch_assoc();
			$datos["ID"] = $fila["ID"];
			$datos["nombre"] = $fila["nombre"];
			$datos["categoria"] = $fila["categoria"];
			$datos["imagen"] = $fila["imagen"];
		}

		return $datos;
	}

	//entrega las ID de los clientes de una categoría
	function obtenerClientes($categoria)
	{
		$clientes = array();

		$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

		$sql="SELECT * FROM clientes WHERE categoria='$categoria'";

		$result = mysqli_query($con,$sql);
		
		for ($i = 0; $i <$result->num_rows; $i++) 
		{
			$result->data_seek($i);
			$fila = $result->fetch_assoc();
			$clientes[$i] = $fila["ID"];
		}

		return $clientes;

	}

?>