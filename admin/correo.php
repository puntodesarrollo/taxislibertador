<?php 

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}
	
	
$correo = include $_SERVER['DOCUMENT_ROOT']."/admin/obtenerCorreoAdmin.php";


include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>
		
	<div class="col-sm-8 col-sm-offset-2">
		<br />
		<br />
		<div class="page-header">
			<h2 class="text-center">Correo para avisos del sistema</h2>
		</div>
		<br class="hidden-xs">
		<br class="hidden-xs">
		<form action="guardarCorreo.php" method="post" enctype="multipart/form-data" class="form-horizontal">
			<input name="ID" id="ID" value="<?php echo $ID;?>" hidden>
			
			<div class="form-group">
				<label for="nombre" class="control-label">Dirección de Correo</label>
				<input type="mail" class="form-control" name="correo" value="<?php echo $correo; ?>"/>
			</div>
			<div class="modal-footer">
				<a href="/admin" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
				<button class="btn btn-primary btn-lg" id="botonAgregar"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Guardar</button>
			</div>
		</form>
			
	</div>
<script>
	
$( document ).ready(function() {
	    console.log( "ready!" );		
	});
</script>

<?php
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>