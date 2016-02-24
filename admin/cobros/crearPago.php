<?php

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
			header("location:/admin/login");
			exit;
		}

	// Debemos conocer el $receiverId y el $secretKey de ante mano.
	$receiverId = 43182;
	$secretKey = '7b32f743f795ac77cd9e7b99c1ccece20d1921cb';

	$correo = $_POST["correo"];
	$origen = $_POST["origen"];
	$destino = $_POST["destino"];
	$idReserva = $_POST["idReserva"];
	$precio = $_POST["precio"];
	$usuario = $_POST["usuario"];

	require  $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';

	$configuration = new Khipu\Configuration();
	$configuration->setReceiverId($receiverId);
	$configuration->setSecret($secretKey);
	$configuration->setDebug(false);
	// $configuration->setDebug(true);

	$client = new Khipu\ApiClient($configuration);
	$payments = new Khipu\Client\PaymentsApi($client);
	$subject  = 'Cobro de Servicio de Transporte';

	try {
	    $response = $payments->paymentsPost($subject
	        , 'CLP'
	        , $precio
	        , "Cobro de Servicio de Transporte"
	        , "Cobro por Servicio desde $origen hasta $destino"
	        , null, null
	        , null
	        , null
	        , "http://taxislibertador.cl/logo.png"
	        , null, null, null
	        , true
	        , $usuario
	        , $correo
	        , true
	    );

	    $respuesta = json_decode($response);

		$idCobro = $respuesta->payment_id; 
		$urlCobro = $respuesta->payment_url;

		ini_set('display_errors', 1);
	    ini_set('display_startup_errors', 1);
	    error_reporting(E_ALL);

		//agregar los datos a la BD
		$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

		//Se agregan los datos:

		$sql = "INSERT INTO cobro (usuario, correo, origen, destino, idCobro, idReserva, precio, urlCobro) VALUES('$usuario','$correo','$origen','$destino','$idCobro','$idReserva','$precio','$urlCobro')";

		$resultado = $con->query($sql);

		mysqli_close($con);

		//redireccionar a programas
		header("location:/admin/cobros");
		
	} catch (Exception $e) {
	    echo $e->getMessage();
	}

?>