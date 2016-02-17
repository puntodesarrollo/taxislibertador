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
        <h2 class="text-center">Categorías de Productos</h2>
    </div>
	<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

					$sql="SELECT * FROM categorias";
		
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) 
					{
						$result->data_seek($i);
						$fila = $result->fetch_assoc();
						$ID = $fila["ID"];
						$Nombre = $fila["nombre"];

						echo '<tr>
								<td>'. $fila["nombre"] .'</td>
								<td><a href="editar.php?t='.$Nombre.'"><span class="glyphicon glyphicon-edit text-primary"></span></a></td>
								<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDelete(\''.$Nombre.'\')">
										<span class="glyphicon glyphicon-remove-circle text-danger"></span>
									</a></td>
							</tr>';
					}
				?>		
				</tbody>
			</table>
			<div class="modal-footer">
				<a href="agregar.php" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-plus text-primary"></span>&nbsp;Nueva Categoría</a>
			</div>
		</div>


	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">¿Eliminar Categoría?</h4>
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
	
</div><!--body-->

<!-- Para el modal -->
<script type="text/javascript">
	function funcionDelete(name) {
		$("#text-modal").html("");
		var cadena = "eliminar.php?t=name";
		cadena = cadena.replace("name",name);
		$("#btn_delete").attr("href", cadena);
		$("#text-modal").append("¿Está seguro de que desea eliminar la categoría <strong>" + name + "</strong>?");
	}
</script>

<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>