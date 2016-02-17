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
		<h2 class="text-center">Agregar Acompañamiento <small>Arma tu Plato</small></h2>
	</div>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2">
				<form action="subir.php" method="post" enctype="multipart/form-data" class="form-horizontal">
					<div id="divNombre" class="form-group">
						<label for="nombre" class="control-label">Nombre de Acompañamiento</label>
						<input type="text" class="form-control" name="nombre" id="nombre" 
						maxlength="200" required>
						<span id="spanInput" class="glyphicon form-control-feedback"></span>
						<div id="mensajeError" class="alert alert-danger hidden">
							<strong>Error: </strong> ya existe un acompañamiento con ese nombre en el sistema
						</div>
					</div>
					<br />
					<br />
					<div class="modal-footer">
						<a href="/admin/creatuplato" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
						<button id="botonAgregar" class="btn btn-primary btn-lg" disabled><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Agregar</button>
					</div>
				</form>
			</div>
		</div>		
	</div>	

<script>

	function verificarCampos(){
		
		habilitarBoton=true;
		
		nombre=$("#nombre").val();
		
		console.log("nombre: "+nombre);
		
		$.get( "verificarNombre.php", { nombre: nombre } )
			.done(function( data ) {
				console.log(data);
				if(data=="true")
				{
					$("#divNombre").addClass(" has-error");
					$("#divNombre").addClass(" has-feedback");
					$("#divNombre").removeClass(" has-success");
					$("#spanInput").addClass("glyphicon-remove");
					$("#spanInput").removeClass("glyphicon-ok");					
					$("#mensajeError").removeClass("hidden");
					
					habilitarBoton=false;
				}
				else 
				{
					$("#divNombre").removeClass(" has-error");
					$("#divNombre").addClass(" has-feedback");
					$("#divNombre").addClass(" has-success");
					$("#spanInput").addClass("glyphicon-ok");
					$("#spanInput").removeClass("glyphicon-remove");
					$("#mensajeError").addClass("hidden");
				}
				
				
				if(habilitarBoton)
				{
					$("#botonAgregar").removeAttr("disabled");
				}
				else
				{
					$("#botonAgregar").attr("disabled", "disabled");
				}
				
			});
	}

	$("#nombre").change(function () {
		verificarCampos();
	});
</script>

<?php
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>
