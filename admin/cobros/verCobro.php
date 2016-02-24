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

<div class="col-sm-8 col-sm-offset-2">
	<div class="rows">
		<br>
		<br>
		 <h3 class="text-center">Detalles de Reserva</h3>
	    <form>			   
		    <div class="form-group">
		        <label for="inputEmail">Fecha</label>
		        <input class="form-control" id="fecha" name="fecha" value="<?php echo $fecha; ?>" readonly>
		    </div>
		    <div class="form-group">
		        <label for="inputPassword">Teléfono</label>
		        <input class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" readonly>
		    </div>	    
		    <div class="form-group">
		        <label for="inputPassword">Correo</label>
		        <input class="form-control" id="correo" name="correo" value="<?php echo $correoReserva; ?>" readonly>
		    </div>
		    <div class="form-group">
		        <label for="inputPassword">Comentario</label>
		        <textarea class="form-control" id="comentario" name="comentario" readonly rows="4"><?php echo $comentario; ?></textarea>
		    </div>
		</form>    
	</div>
	<hr>
	 <div class="rows">
	 	<h3 class="text-center">Detalles de Cobro</h3>
	    <form>			   
		    <div class="form-group">
		        <label for="inputEmail">Usuario</label>
		        <input class="form-control" id="usuario" name="usuario" value="<?php echo $usuario; ?>" readonly>
		    </div>
		    <div class="form-group">
		        <label for="inputPassword">Correo</label>
		        <input class="form-control" id="correo" name="correo" value="<?php echo $correo; ?>" readonly>
		    </div>
		    <div class="form-group">
		        <label for="inputPassword">Origen</label>
		        <input class="form-control" id="origen" name="origen" value="<?php echo $origen; ?>" readonly>
		    </div>
		    <div class="form-group">
		        <label for="inputPassword">Destino</label>
		        <input class="form-control" id="destino" name="destino" value="<?php echo $destino; ?>" readonly>
		    </div>
		    <div class="form-group">
		        <label for="inputPassword">Precio</label>
		        <input class="form-control" id="precio" name="precio" value="<?php echo $precio; ?>" readonly>
		    </div>
		</form>
	</div>
	<hr>
	<div class="rows">
	     <h3 class="text-center">Detalles de Pago Online en Khipu</h3>
	    <form>			   
		    <div class="form-group">
		        <label for="inputEmail">ID de Cobro</label>
		        <input class="form-control" id="idCobro" name="idCobro" value="<?php echo $idCobro; ?>" readonly>
		    </div>
		    <div class="form-group">
		        <label for="inputPassword">URL de Cobro</label>
		        <input class="form-control" id="urlCobro" name="urlCobro" value="<?php echo $urlCobro; ?>" readonly>
		    </div>
		    <div class="form-group">
		        <label for="inputPassword">Pagado</label>
		        <input class="form-control" id="pagado" name="pagado" value="<?php echo $pagado; ?>" readonly>
		    </div>
		</form>    
	</div>
</div>