<?php
require  $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';


$receiver_id = 43182;
$secret = '7b32f743f795ac77cd9e7b99c1ccece20d1921cb';

echo $api_version;
echo "<br>".$notification_token;
exit;

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

                $sql = "UPDATE cobro SET pagado='Sí' WHERE idCobro='$idCobro'";

                $resultado = $con->query($sql);

                mysqli_close($con);
                exit;

                //redireccionar a cobros
                header("location:/admin/cobros");
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