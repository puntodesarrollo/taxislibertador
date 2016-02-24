<?php

   	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";


    if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	if($_GET["t"]!=null){
	
		$ID = $_GET["t"];
		
		//obtener los datos del cobro:
		$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
		$sql="SELECT * FROM cobro WHERE ID='$ID'";

		$result = mysqli_query($con,$sql);
		
		if($result===false || $result->num_rows===0)
		{
			header("location:/admin/cobros");
		}
		
		for ($i = 0; $i <$result->num_rows; $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();

			$usuario = $fila["usuario"];
			$correo = $fila["correo"];
			$origen = $fila["origen"];
			$destino = $fila["destino"];
			$idCobro = $fila["idCobro"];
			$idReserva = $fila["idReserva"];
			$precio = $fila["precio"];
			$urlCobro = $fila["urlCobro"];
			$pagado = $fila["pagado"];
		}

		//obtener los datos de la reserva:
		
		$sql="SELECT * FROM reservas WHERE ID='$idReserva'";
		
		$result = mysqli_query($con,$sql);
		
		for ($i = 0; $i <$result->num_rows; $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();

			$fecha = $fila["fecha"];
			$telefono = $fila["telefono"];
			$correoReserva = $fila["correo"];
			$comentario = $fila["comentario"];
		}	
		mysqli_close($con);
	}
	else
	{
		header("location:/admin/cobros");
	}

    include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";

?>
<br>
<br>
<div class="container">
	<div class="col-md-4">
		<div class="rows">
			<div class="page-header"><h3 class="text-center">Detalles de Reserva</h3></div>
		    <form>			   
			    <div class="form-group">
			        <label for="inputEmail">Fecha</label>
			        <p><?php echo $fecha; ?><p>
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Teléfono</label>
			        <p><?php echo $telefono; ?><p>
			    </div>	    
			    <div class="form-group">
			        <label for="inputPassword">Correo</label>
			        <p><?php echo $correoReserva; ?><p>
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Comentario</label>
			        <p><?php echo $comentario; ?><p>
			    </div>
			</form>    
		</div>
	</div>
	<div class="col-md-4">
		 <div class="rows">
		 	<div class="page-header"><h3 class="text-center">Detalles de Cobro</h3></div>
		    <form>			   
			    <div class="form-group">
			        <label for="inputEmail">Usuario</label>
			        <p><?php echo $usuario; ?><p>
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Correo</label>
			        <p><?php echo $correo; ?><p>
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Origen</label>
			        <p><?php echo $origen; ?><p>
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Destino</label>
			        <p><?php echo $destino; ?><p>
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Precio</label>
			        <p><?php echo $precio; ?><p>
			    </div>
			</form>
		</div>
		</div>
	<div class="col-md-4">
		<div class="rows">
			<div class="page-header"><h3 class="text-center">Detalles de Pago Khipu</h3></div>
		    <form>			   
			    <div class="form-group">
			        <label for="inputEmail">ID de Cobro</label>
			        <p><?php echo $idCobro; ?><p>
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">URL de Cobro</label>
			        <p><a target="_blank" href='<?php echo $urlCobro; ?>'><?php echo $urlCobro; ?></a><p>
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Pagado</label>
			        <p><?php echo $pagado; ?><p>
			    </div>
			</form>    
		</div>
	</div>
</div>