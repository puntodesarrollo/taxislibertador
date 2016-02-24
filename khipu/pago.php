<?php

	// Debemos conocer el $receiverId y el $secretKey de ante mano.
	$receiverId = 43182;
	$secretKey = '7b32f743f795ac77cd9e7b99c1ccece20d1921cb';

	require __DIR__ . '/vendor/autoload.php';

	$configuration = new Khipu\Configuration();
	$configuration->setReceiverId($receiverId);
	$configuration->setSecret($secretKey);
	// $configuration->setDebug(true);

	$client = new Khipu\ApiClient($configuration);
	$payments = new Khipu\Client\PaymentsApi($client);
	$subject  = 'asdf';

	try {
	    $expires_date = new DateTime();
	    $expires_date->setDate(2016, 4, 4);
	    $response = $payments->paymentsPost('PRUEBA PAO QL'
	        , 'CLP' // Código de moneda
	        , 5000 // monto a cobrar
	    );

			/*
	        , 'FACT2001' // código del cobrador de la transacción, Ej. orden de cómpra o número de factura
	        , null
	        , 'Descripción de la compra' // Descripción
	        , null
	        , 'http://google.com' // URL de retorno
	        , 'http://mi-ecomerce.com/backend/cancel' // URL de rechazo
	        , 'http://http://arropa.org/admin/imagenes/Holaupcycling2.jpg' // Imágen a mostrar
	        , 'http://mi-ecomerce.com/backend/notify'// URL de notificación
	        , '1.3' // Versión de la API de notificación
	        , $expires_date//*/

	    echo 'aqui';
	} catch (Exception $e) {
	    echo $e->getMessage();
	}

?>