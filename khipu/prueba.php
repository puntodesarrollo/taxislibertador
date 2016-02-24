<?php

	// Debemos conocer el $receiverId y el $secretKey de ante mano.
	require __DIR__ . '/vendor/autoload.php';
	$receiver_id = 43182;
	$secret = '7b32f743f795ac77cd9e7b99c1ccece20d1921cb';
	$method = 'POST';
	$url = 'https://khipu.com/api/2.0/payments';

	$params = array('subject' => 'ejemplo de compra'
	, 'amount' => '1000'
	, 'currency' => 'CLP'
	);

	$keys = array_keys($params);
	sort($keys);

	$toSign = "$method&" . rawurlencode($url);
	foreach ($keys as $key) {
	        $toSign .= "&" . rawurlencode($key) . "=" . rawurlencode($params[$key]);
	}
	$hash = hash_hmac('sha256', $toSign , $secret);
	$value = "$receiver_id:$hash";
	print "$value\n";

?>