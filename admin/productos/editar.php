<?php
		$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

		if($sesion===false){
			header("location:/admin/login");
			exit;
		}

		include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
    	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";		


		$id_producto= $_GET["t"];		

		include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

		$sql="SELECT * FROM productos WHERE id='$id_producto'";	


	
		$result = mysqli_query($con,$sql);
		

		for ($i = 0; $i <$result->num_rows; $i++) {			
			$result->data_seek($i);
			$fila = $result->fetch_assoc();						
			$nombre=$fila["nombre"];								
			$descripcion=$fila["descripcion"];
			$cantidad=$fila["cantidad"];
			$precio=$fila["precio"];
			$mostrar=$fila["mostrar"];	
			$categoria=$fila["Idcategoria"];
			
		}	



		$sqlCategorias="SELECT * FROM categorias";						
		$resultCategorias = mysqli_query($con,$sqlCategorias);


		
		$sql_dias="SELECT * FROM dias_productos WHERE id_producto='$id_producto' ORDER BY dia ASC";
					
		$result_dias = mysqli_query($con,$sql_dias);
		$dias=array();			
		
		for ($i = 0; $i <$result_dias->num_rows; $i++) {
			$result_dias->data_seek($i);
			$fila = $result_dias->fetch_assoc();	
			array_push($dias,$fila["dia"]);
			//$fila["dia"];
		}			
	?>
	</br>
	</br>
	<div class="page-header">
		<h2 class="text-center">Editar <?php echo $nombre; ?> <small></small></h2>
	</div>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2">
				<form action="metodoEditar.php" method="post" enctype="multipart/form-data">
				<input name="id" value="<?php echo $id_producto?>" hidden/>
						<div class="row">
							<div class="col-sm-12">
								<div id="divNombre" class="form-group">
									<label for="nombre" class="control-label">Nombre</label>
									<input type="text" class="form-control" name="nombre" id="nombre" 
									maxlength="200" placeholder="nombre de colacion" required value="<?php echo $nombre ?>">
									<span id="spanInput" class="glyphicon form-control-feedback"></span>									
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Descripción</label>
									<textarea class="form-control" name="descripcion" id="descripcion" 
									maxlength="5000" placeholder="descripción de colacion" required><?php echo $descripcion; ?></textarea>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Precio</label>
									<input class="form-control" type="number" name="precio" id="precio"
									placeholder="Precio de colacion" required value="<?php echo $precio ?>">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Cantidad a la venta</label>
									<input class="form-control" type="number" name="cantidad" id="cantidad"
									placeholder="Cantidad de unidades para vender de la colacion" required value="<?php echo $cantidad; ?>">
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
												$idCat=$fila["ID"];								
												$nombreCat=$fila["nombre"];
												echo "<option value='".$idCat."'";
												if($categoria==$idCat){

													echo " selected";
												}
												echo">".$nombreCat."</option>";
											}
										?>
									</select>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Dias</label>
									<select class="form-control" name="dias[]"  multiple="multiple" >
										<?php 
											if (in_array("1", $dias)){
												echo "<option value='1' selected>Lunes</option>";													 
											}else{
												echo "<option value='1'>Lunes</option>";	
											}
											if (in_array("2", $dias)){
												echo "<option value='2' selected>Martes</option>";													 	
											}else{
												echo "<option value='2'>Martes</option>";
											}
											if (in_array("3", $dias)){
												echo "<option value='3' selected>Miercoles</option>";													 	
											}else{
												echo "<option value='3'>Miercoles</option>";													
											}
											if (in_array("4", $dias)){
												echo "<option value='4' selected>Jueves</option>";														 	
											}else{
												echo "<option value='4'>Jueves</option>";
											}
											if (in_array("5", $dias)){
												echo "<option value='5' selected>Viernes</option>";													 	
											}else{
												echo "<option value='5'>Viernes</option>";													 	 													
											}
											if (in_array("6", $dias)){
												echo "<option value='6' selected>Sabado</option>";												 	
											}else{												
												echo "<option value='6'>Sabado</option>";
											}
											if (in_array("0", $dias)){
												echo "<option value='0' selected>Domingo</option>";													 	
											}else{
												echo "<option value='0'>Domingo</option>";
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Dias</label>
									<select class="form-control" name="mostrar" >
										<?php 
											if($mostrar==1){

												echo "<option value='1' selected>Si</option>";
												echo "<option value='0'>No</option>";	
											}else{
												echo "<option value='1'>Si</option>";	
												echo "<option value='0' selected>No</option>";		
											}
										?>
																													
									</select>
								</div>
							</div>							
							

						</div>
						<br />
						<br />
						<div class="modal-footer">					
							<button id="botonAgregar" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Guardar</button>
						</div>
					</form>
			</div>
		</div>		
	</div>	
<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>	