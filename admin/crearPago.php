<?php

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
	$subject  = 'PRUEBA PAGO KHIPU';

	try {
	    $response = $payments->paymentsPost($subject
	        , 'CLP'
	        , 1000
	        , null, null, null, null
	        , "http://www.taxislibertador.cl/retornoPago.php"
	        , null, null, null, null, null
	        , true
	        , 'Guillermo Puelles Torres'
	        , 'gpuellestorres@gmail.com'
	        , true
	    );

	    //print_r($response);

	    $respuesta = json_decode($response);
		// access title of $book object
		//echo $respuesta->payment_id; 
		//echo $respuesta->payment_url;

		$idCobro = $respuesta->payment_id; 
		$urlCobro = $respuesta->payment_url;

		$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

	//agregar los datos a la BD
	include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

	$fechas = explode("/", $fecha);
	$horas = explode(" ", $hora);
	//echo '<br>';
	//echo $d1->format('Y-m-d H:i:s');
	$mysqltime = date ("Y-m-d H:i:s", $d1->getTimestamp());

	//Se agregan los datos

	$sql = "INSERT INTO cobro (usuario, correo, origen, destino, idCobro, idReserva, precio, urlCobro) VALUES('$usuario','$correo','$origen','$destino','$idCobro','$idCobro','$idReserva','$precio','$urlCobro')";

	$resultado = $con->query($sql);

	mysqli_close($con);

	//redireccionar a programas
	header("location:/admin/reservas");
		
	} catch (Exception $e) {
	    echo $e->getMessage();
	}

?>