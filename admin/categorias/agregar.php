<?php 

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}


	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
?>
	<br>
	<br>	
	<div class="page-header">
		<h2 class="text-center">Agregar Categoría</h2>
	</div>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2">
				<form action="subir.php" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
								<div id="divNombre" class="form-group">
									<label for="nombre" class="control-label">Nombre</label>
									<input type="text" class="form-control" name="nombre" id="nombre" 
									maxlength="200" placeholder="nombre de categoría" required>
									<span id="spanInput" class="glyphicon form-control-feedback"></span>
									<div id="mensajeError" class="alert alert-danger hidden">
										<strong>Error: </strong> ¡ya existe esta categoría!
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<br />
						<br />
						<div class="modal-footer">
							<a href="/admin/categorias" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
							<button id="botonAgregar" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Agregar</button>
						</div>
					</form>
			</div>
		</div>		
	</div>
<script>

	$("#nombre").change(function () {
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
					
					$("#botonAgregar").attr("disabled", "disabled");
				}
				else 
				{
					$("#divNombre").removeClass(" has-error");
					$("#divNombre").addClass(" has-feedback");
					$("#divNombre").addClass(" has-success");
					$("#spanInput").addClass("glyphicon-ok");
					$("#spanInput").removeClass("glyphicon-remove");
					$("#mensajeError").addClass("hidden");
					
					$("#botonAgregar").removeAttr("disabled");
				}
				
			});
	});
	
</script>

<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>