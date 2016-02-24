<?php

   	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";


    if($sesion===false){
		header("location:/admin/login");
		exit;
	}

   if($_GET["t"]!=null){
	
	$ID = $_GET["t"];
	
	//obtener los datos de la bd
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	
	$sql="SELECT * FROM reservas WHERE ID='$ID'";

	$result = mysqli_query($con,$sql);
	
	if($result===false || $result->num_rows===0)
	{
		header("location:/admin/cobros");
	}
	
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();

		$IDrerserva = $fila["ID"];
		$origen = $fila["direccion"];
		$destino = $fila["destino"];
		$solicitante = $fila["solicitante"];
		$precio = $fila["precio"];
		$correo = $fila["correo"];
	
	}
	
	mysqli_close($con);
}
else
{
	header("location:/admin");
}



	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";

?>


<!-- About Section -->
         <div class="container">
             <br>   
             <div class="page-header">
			 <h2 class="text-center">Generar Pago</h2>
			</div>     
            <form action="crearPago.php" method="post" enctype="multipart/form-data">
			   
			    <div class="form-group" hidden>
			        <label for="inputEmail">ID</label>
			        <input class="form-control" id="idReserva" name="idReserva" value="<?php echo $IDrerserva;?>" readonly>
			    </div>
			    <div class="form-group">
			        <label for="inputEmail">Usuario</label>
			        <input class="form-control" id="usuario" name="usuario" value="<?php echo $solicitante;?>" readonly>
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Correo</label>
			        <input class="form-control" id="correo" name="correo" value="<?php echo $correo;?>">
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Origen</label>
			        <input class="form-control" id="origen" name="origen" value="<?php echo $origen;?>">
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Destino</label>
			        <input class="form-control" id="destino" name="destino" value="<?php echo $destino;?>">
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Precio</label>
			        <input class="form-control" id="precio" name="precio" value="<?php echo $precio;?>">
			    </div>
			    <div class="modal-footer">
						<a href="/admin/cobros" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
						<button id="botonAgregar" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Generar</button>
					</div>
			</form>    
		</div>	    