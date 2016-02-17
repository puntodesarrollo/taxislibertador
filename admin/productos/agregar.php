<?php 
$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

		if($sesion===false){
			header("location:/admin/login");
			exit;
		}

		include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
    	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

    	$sqlCategorias="SELECT * FROM categorias";		
				
		$resultCategorias = mysqli_query($con,$sqlCategorias);
		
		
    ?>	
    </br>
    </br>
	<div class="page-header">
		<h2 class="text-center">Agregar Colacion <small></small></h2>
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
									maxlength="200" placeholder="nombre de colacion" required>
									<span id="spanInput" class="glyphicon form-control-feedback"></span>									
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Descripción</label>
									<textarea class="form-control" name="descripcion" id="descripcion" 
									maxlength="5000" placeholder="descripción de colacion" required></textarea>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Precio</label>
									<input class="form-control" type="number" name="precio" id="precio"
									placeholder="Precio de colacion" required>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Cantidad a la venta</label>
									<input class="form-control" type="number" name="cantidad" id="cantidad"
									placeholder="Cantidad de unidades para vender de la colacion" required>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Categoria</label>
									<select class="form-control" name="categoria" >
										<?php
											for ($i = 0; $i <$resultCategorias->num_rows; $i++) {			
												$resultCategorias->data_seek($i);
												$fila = $resultCategorias->fetch_assoc();						
												$id=$fila["ID"];								
												$nombre=$fila["nombre"];
												echo "<option value='".$id."'>".$nombre."</option>";
											}
										?>
									</select>
								</div>
							</div>






							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Dias</label>
									<select class="form-control" name="dias[]"  multiple="multiple" >
										<option value="1">Lunes</option>
										<option value="2">Martes</option>
										<option value="3">Miercoles</option>
										<option value="4">Jueves</option>
										<option value="5">Viernes</option>
										<option value="6">Sabado</option>
										<option value="0">Domingo</option>
									</select>
								</div>
							</div>							
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Imagenes</label>
									<input type="file" class="filestyle" name="imagen[]" id="imagen" data-input="false" data-buttonText="Elegir Imagenes"
									multiple accept="image/*">
								</div>
							</div>

						</div>
						<br />
						<br />
						<div class="modal-footer">
							<a href="/admin/productos" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
							<button id="botonAgregar" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Agregar</button>
						</div>
					</form>
			</div>
		</div>		
	</div>
<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>			