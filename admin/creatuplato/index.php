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
        <h1 class="text-center">Crea Tu Plato</h2>
	<div class="table-responsive">
		<h3>Bases:</h3>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Descripción de base</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

					$sql="SELECT * FROM creatuplatobase";
		
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) 
					{
						$result->data_seek($i);
						$fila = $result->fetch_assoc();
						$ID = $fila["ID"];

						echo '<tr>
								<td>'. $fila["nombre"] .'</td>
								<td><a href="bases/editar.php?t='.$ID.'"><span class="glyphicon glyphicon-edit text-primary"></span></a></td>
								<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDelete(\''.$ID.'\')">
										<span class="glyphicon glyphicon-remove-circle text-danger"></span>
									</a></td>
							</tr>';
					}
				?>				
			</tbody>
		</table>
		<div class="modal-footer">
			<a href="bases/agregar.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;Agregar</a>
		</div>
	</div>
	<hr>
	<div class="table-responsive">
		<h3>Acompañamientos:</h3>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Descripción de acompañamiento</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

					$sql="SELECT * FROM creatuplatoacompanamiento";
		
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) 
					{
						$result->data_seek($i);
						$fila = $result->fetch_assoc();
						$ID = $fila["ID"];

						echo '<tr>
								<td>'. $fila["nombre"] .'</td>
								<td><a href="acompanamiento/editar.php?t='.$ID.'"><span class="glyphicon glyphicon-edit text-primary"></span></a></td>
								<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDeleteAcompanamiento(\''.$ID.'\')">
										<span class="glyphicon glyphicon-remove-circle text-danger"></span>
									</a></td>
							</tr>';
					}
				?>				
			</tbody>
		</table>
		<div class="modal-footer">
			<a href="acompanamiento/agregar.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;Agregar</a>
		</div>
	</div>


	<div class="row">
		<h3>Precio:</h3>
		<div class="col-md-6">
			<?php $precio= include $_SERVER['DOCUMENT_ROOT']."/login/obtenerPrecioPedido.php";?>                                
            <label class="col-md-12"><b>El precio del plato es de $<?php echo number_format($precio);?></b></label>	
		</div>
		<div class="col-md-6">
			<div class="modal-footer">
				<a href="modificarPrecio.php" class="btn btn-primary"><span class="glyphicon glyphicon-usd"></span>&nbsp;Modificar</a>
			</div>
		</div>
		
	</div>




	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">¿Eliminar Base?</h4>
				</div>
				<div class="modal-body">
					<h5 class="text-center" id="text-modal"></h5>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>Cancelar</button>
					<a href="" type="button" id="btn_delete" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i>Eliminar</a>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	function funcionDelete(name) {
		$("#myModalLabel").html("¿Eliminar Base?");
		$("#text-modal").html("");
		var cadena = "bases/eliminar.php?t=name";
		cadena = cadena.replace("name",name);
		$("#btn_delete").attr("href", cadena);
		$("#text-modal").append("¿Está seguro de que desea eliminar la base?");
	}

	function funcionDeleteAcompanamiento(name) {
		$("#myModalLabel").html("¿Eliminar Acompañamiento?");
		
		$("#text-modal").html("");
		var cadena = "acompanamiento/eliminar.php?t=name";
		cadena = cadena.replace("name",name);
		$("#btn_delete").attr("href", cadena);
		$("#text-modal").append("¿Está seguro de que desea eliminar el acompañamiento?");
	}
	</script>

<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>