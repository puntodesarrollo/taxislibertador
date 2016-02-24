<?php
require  $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';

//Mandar correo
$name = "Sistema de pagos taxis libertador";

$email_address = "gpuellestorres@gmail.com";
$tema = "Pago desde taxislibertador.cl";


$fechaActual=date('Y-m-d');
//$to='contacto@taxislibertador.cl';
$to = $email_address;
$email_subject = $tema;
$email_body = "Ha recibido un nuevo pago desde la página web taxislibertador.cl. Revise su correo electrónico\n\n".
$headers = $email_address;  

include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
$resultado = $con->query("INSERT INTO contacto (nombre_contacto,mail_contacto,mensaje_contacto,telefono_contacto,fecha) VALUES('$name','$email_address','$message','$fono','$fechaActual')");
mysqli_close($con);

mail($to,$email_subject,$email_body,$headers);


//Se obtiene el pago
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
                $respuesta = json_decode($response);

                $idCobro = $respuesta->payment_id;

                //Se actualiza el pago como realizado en la BD
                        //agregar los datos a la BD
                $con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

                //Se agregan los datos:

                $sql = "UPDATE cobro SET pagado='SI' WHERE idCobro='$idCobro'";

                $resultado = $con->query($sql);

                mysqli_close($con);
                exit;
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