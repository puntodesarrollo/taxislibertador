<?php
require  $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';

//Se obtiene el pago
$receiver_id = 56247;
$secret = 'b91a4947d8326319e66fa13abd6d4dd84661c587';

$api_version = $_POST["api_version"];  // Parámetro api_version
$notification_token = $_POST["notification_token"]; //Parámetro notification_token

$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

//Se agregan los datos:

$sql = "INSERT INTO pagos_recibidos(api_version, notification_token) VALUES('$api_version','$notification_token')";

$resultado = $con->query($sql);

mysqli_close($con);

$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

//Se agregan los datos:

$sql = "INSERT INTO log(texto) VALUES('notificación de Pago Token: $notification_token')";

$resultado = $con->query($sql);

mysqli_close($con);

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
                $respuesta = json_decode($response);

                $idCobro = $respuesta->payment_id;

                //Se actualiza el pago como realizado en la BD
                        //agregar los datos a la BD
                $con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

                //Se agregan los datos:

                $sql = "UPDATE cobro SET pagado='SI' WHERE idCobro='$idCobro'";
                //$sql = "UPDATE cobro SET pagado='SI'";

                $resultado = $con->query($sql);

                //Se registra el pago en el log

                $sql = "INSERT INTO log(texto) VALUES('Pago de Servicio ID: $$idCobro')";
                //$sql = "UPDATE cobro SET pagado='SI'";

                $resultado = $con->query($sql);

                mysqli_close($con);
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