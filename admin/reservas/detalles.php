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
		header("location:/admin/reservas");
	}
	
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();

		$fecha = $fila["fecha"];
		$direccion = $fila["direccion"];
		$comentario = $fila["comentario"];
		$solicitante = $fila["solicitante"];
		$telefono = $fila["telefono"];
		$correo = $fila["correo"];

		$hora = explode(" ", $fecha);
		$hora = $hora[1];
		$fecha = explode(" ", $fecha);
		$fecha = $fecha[0];

		$fechas = explode("-", $fecha);
		$FECHA = $fechas[2] .'/'. $fechas[1] .'/'. $fechas[0];		

		$horas = explode("-", $hora);
		$HORA = $horas[0] .':'. $horas[1];
	}
	
	mysqli_close($con);
}
else
{
	header("location:/admin");
}


	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
?>

	<br>
	<div class="page-header">
		<h2 class="text-center">Agregar Reserva de Servicio</h2>
	</div>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1">
				<form action="metodoEditar.php" method="post" enctype="multipart/form-data" class="form-horizontal">
					<input class="hidden" name="id" id="id" value="<?php echo $ID?>">
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Fecha</label>
						<div class="col-sm-4">
			                <input class="form-control fecha" id="fecha" name="fecha"
			                       data-val-date="Ingrese por favor una fecha." data-val-required="El campo fecha es obligatorio."
			                       data-date-format="DD/MM/YYYY" pattern="[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]"
			                       type="text" value="<?php echo $FECHA;?>" required readonly>
                       </div>
	            	</div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Hora</label>
						<div class="col-sm-4">
			                <input class="form-control hora" id="hora" name="hora"
			                       data-val-date="Ingrese por favor una fecha." data-val-required="El campo hora es obligatorio."
			                       pattern="[0-9][0-9]*:[0-9][0-9] [a,p][m]"
			                       type="text" value="<?php echo $HORA;?>" required readonly>
                       </div>
	            	</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Dirección</label>
						<div class="col-sm-10">
							<input class="form-control" name="direccion" id="direccion" type="text" value="<?php echo $direccion;?>" required readonly />
                       </div>						
					</div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Comentarios del Servicio</label>
						<div class="col-sm-10">
							<textarea rows="5" name="comentario" id="comentario" class="form-control" placeholder="comentarios sobre el servicio" maxlength="2000" style="width:100% !important" required readonly ><?php echo $comentario;?></textarea>
                       </div>
					</div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Solicitante</label>
						<div class="col-sm-10">
							<input class="form-control" name="solicitante" id="solicitante" type="text" value="<?php echo $solicitante;?>" required readonly />
                       </div>
					</div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Telefono</label>
						<div class="col-sm-10">
							<input class="form-control" name="telefono" id="telefono" type="text" value="<?php echo $telefono;?>" required readonly />
                       </div>						
					</div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Correo</label>
						<div class="col-sm-10">
							<input class="form-control" name="correo" id="correo" type="mail" value="<?php echo $correo;?>" required readonly />
                       </div>
					</div>
					<br />
					<br />
					<div class="modal-footer">
						<a href="/admin/reservas" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-arrow-left" aria-hidden="true"></i>&nbsp;Volver</a>
					</div>
				</form>
			</div>
		</div>		
	</div>	
<script>

	// A $( document ).ready() block.
	$( document ).ready(function() {
	    console.log( "ready!" );

	    $(".fecha").datetimepicker({
                    viewMode: 'days',
                    format: 'DD/MM/YYYY'
                });
	    $(".hora").datetimepicker({
                    viewMode: 'days',
                    format: 'h:mm a'
                });

	});
</script>

<?php
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>