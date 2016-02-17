<?php 

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
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
				<form action="subir.php" method="post" enctype="multipart/form-data" class="form-horizontal">
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Fecha</label>
						<div class="col-sm-4">
			                <input class="form-control fecha" id="fecha" name="fecha"
			                       data-val-date="Ingrese por favor una fecha." data-val-required="El campo fecha es obligatorio."
			                       data-date-format="DD/MM/YYYY" pattern="[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]"
			                       type="text" required>
                       </div>
	            	</div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Hora</label>
						<div class="col-sm-4">
			                <input class="form-control hora" id="hora" name="hora"
			                       data-val-date="Ingrese por favor una fecha." data-val-required="El campo hora es obligatorio."
			                       pattern="[0-9][0-9]*:[0-9][0-9] [a,p][m]"
			                       type="text" required>
                       </div>
	            	</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Dirección</label>
						<div class="col-sm-10">
							<input class="form-control" name="direccion" id="direccion" type="text" required />
                       </div>						
					</div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Comentarios del Servicio</label>
						<div class="col-sm-10">
							<textarea rows="5" name="comentario" id="comentario" class="form-control" placeholder="comentarios sobre el servicio" maxlength="2000" style="width:100% !important" required ></textarea>
                       </div>
					</div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Solicitante</label>
						<div class="col-sm-10">
							<input class="form-control" name="solicitante" id="solicitante" type="text" required />
                       </div>
					</div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Telefono</label>
						<div class="col-sm-10">
							<input class="form-control" name="telefono" id="telefono" type="text" required />
                       </div>						
					</div>
					<div class="form-group">
						<label for="nombre" class="control-label col-sm-2">Correo</label>
						<div class="col-sm-10">
							<input class="form-control" name="correo" id="correo" type="mail" required />
                       </div>
					</div>
					<br />
					<br />
					<div class="modal-footer">
						<a href="/admin/reservas" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
						<button id="botonAgregar" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Agregar</button>
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