<?php 
$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

		if($sesion===false){
			header("location:/admin/login");
			exit;
		}

		include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
    	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";	
    	$precio= include $_SERVER['DOCUMENT_ROOT']."/login/obtenerPrecioPedido.php";
		
    ?>	
    </br>
    </br>
	<div class="page-header">
		<h2 class="text-center">Modificar Precio <small></small></h2>
	</div>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2">
				<form action="metodoCambiarPrecio.php" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="precio" class="control-label">Precio</label>
									<input type="number" class="form-control" name="precio" id="precio" 
									 placeholder="Precio crea tu plato" value="<?php echo $precio; ?>" required>
									<span id="spanInput" class="glyphicon form-control-feedback"></span>									
								</div>
							</div>							
						</div>
						<br />
						<br />
						<div class="modal-footer">
							<a href="/admin/creatuplato" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
							<button id="botonAgregar" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Modificar</button>
						</div>
					</form>
			</div>
		</div>		
	</div>
<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>			