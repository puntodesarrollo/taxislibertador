<?php
require  $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';


$receiver_id = 43182;
$secret = '7b32f743f795ac77cd9e7b99c1ccece20d1921cb';

$api_version = $_POST["api_version"];  // Parámetro api_version
$notification_token = $_POST["notification_token"]; //Parámetro notification_token

try {
    if ($api_version == '1.3') {
        $configuration = new Khipu\Configuration();
        $configuration->setSecret($secret);
        $configuration->setReceiverId($receiver_id);
        // $configuration->setDebug(true);

        $client = new Khipu\ApiClient($configuration);
        $payments = new Khipu\Client\PaymentsApi($client);

        $response = $payments->paymentsGet($notification_token);
        if ($response->getReceiverId() == $receiver_id) {
            if ($response->getStatus() == 'done') {
                // marcar el pago como completo y entregar el bien o servicio
                $tema = "Pago desde taxislibertador.cl";

                //$to = 'contacto@taxislibertador.cl';
                $to = "gpuellestorres@gmail.com";
                $email_subject = $tema;
                $email_body = $response;
                $headers = $correo;

                mail($to,$email_subject,$email_body,$headers);
            }
        } else {
            // receiver_id no coincide
        }
    } else {
        // Usar versión anterior de la API de notificación
    }
} catch (\Khipu\ApiException $exception) {
    print_r($exception->getResponseObject());
}

?>