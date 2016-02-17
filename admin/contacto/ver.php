<?php 

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}


	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";

	$id = $_GET["t"];
	if($id==null)
	{
		header("location:/admin/contacto");
	}

	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	$sql="SELECT * FROM contacto WHERE id='$id'";

	$result = mysqli_query($con,$sql);	
	
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		$id = $fila["id"];
		$nombre_contacto = $fila["nombre_contacto"];
		$mail_contacto = $fila["mail_contacto"];
		$telefono_contacto = $fila["telefono_contacto"];						
		$mensaje_contacto = $fila["mensaje_contacto"];
		$fecha = $fila["fecha"];						
	}
	

?>
	<br>
	<br>
	<div class="page-header">
		<h2 class="text-center">Ver Mensaje</h2>
	</div>	
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
		<div class="col-xs-12 col-sm-10 col-sm-offset-2">
			<label class="control-label">Fecha</label>
			<p><?php echo $fecha; ?></p>
			<label class="control-label">Nombre Contacto</label>
			<p><?php echo $nombre_contacto; ?></p>			
			<label class="control-label">Telefono Contacto</label>
			<p><?php echo $telefono_contacto; ?></p>
			<label class="control-label">Mail Contacto</label>
			<p><?php echo $mail_contacto; ?></p>
			<label class="control-label">Mensaje Contacto</label>
			<p><?php echo $mensaje_contacto; ?></p>
		</div>
		</div>		
	</div>


<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>