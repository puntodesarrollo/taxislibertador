<?php 
	
	$name = $_GET['nombre'];
	$fono = $_GET['telefono'];
	$email_address = $_GET['mail'];
	$message = $_GET['mensaje'];
	$tema = "Contacto desde taxislibertador.cl";
	

	$fechaActual=date('Y-m-d');
	//$to='contacto@taxislibertador.cl';
	$to = include $_SERVER['DOCUMENT_ROOT']."/admin/obtenerCorreoAdmin.php";
	$email_subject = $tema;
	$email_body = "Ha recibido un nuevo mensaje desde la página web taxislibertador.cl\n\n".
				  " Detalles:\n \nNombre Contacto: ".$name ."\n ".
				  "Telefono: ".$fono ."\n ".
				  "Correo electrónico: ".$email_address."\n\n Mensaje: \n ".$message;
	$headers = $email_address;	
	
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	$resultado = $con->query("INSERT INTO contacto (nombre_contacto,mail_contacto,mensaje_contacto,telefono_contacto,fecha) VALUES('$name','$email_address','$message','$fono','$fechaActual')");
	mysqli_close($con);
	

	
    mail($to,$email_subject,$email_body,$headers);   
	return true;
	//header("location:/contacto.html");
?>