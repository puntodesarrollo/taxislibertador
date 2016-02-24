<?php

	// Debemos conocer el $receiverId y el $secretKey de ante mano.
	$receiverId = 43182;
	$secretKey = '7b32f743f795ac77cd9e7b99c1ccece20d1921cb';

	require __DIR__ . '/vendor/autoload.php';

	$configuration = new Khipu\Configuration();
	$configuration->setReceiverId($receiverId);
	$configuration->setSecret($secretKey);
	$configuration->setDebug(true);
	// $configuration->setDebug(true);

	$client = new Khipu\ApiClient($configuration);
	$payments = new Khipu\Client\PaymentsApi($client);
	$subject  = 'PRUEBA PAGO KHIPU';

	try {
	    $response = $payments->paymentsPost($subject
	        , 'CLP'
	        , 500 
	        , null, null, null, null, null, null, null, null, null, null
	        , true
	        , 'Estefanía Palacios Cortés'
	        , 'estefaniapc05@gmail.com'
	        , true
	    );

	    print_r($response);
	} catch (Exception $e) {
	    echo $e->getMessage();
	}

?>