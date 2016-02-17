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
        <h2 class="text-center">Imágenes del slider</h2>
    </div>
	<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Ruta</th>
						<th>Imagen</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//Se hace la conexion:
					include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
					
					$sql="SELECT * FROM slider ORDER BY imagen DESC";
					
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) {
						$result->data_seek($i);
						$fila = $result->fetch_assoc();						
						
						echo '<tr>
							<td>'.$fila["imagen"].'</td>
							<td class="col-sm-2"><img src="/admin/slider/'.$fila["imagen"].'" alt="error de imagen" width="60%" class="img-rounded img-responsive"></td>
							<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDelete(\''.$fila["imagen"].'\')">
									<span class="glyphicon glyphicon-remove-circle text-danger"></span>
								</a></td>
						</tr>';
					}
					mysqli_close($con);
					?>
				</tbody>
			</table>
			<div class="modal-footer">
				<a href="agregar.php" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-plus text-primary"></span>&nbsp;Nueva Imagen</a>
			</div>
		</div>


	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">¿Eliminar Imagen?</h4>
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

<!-- Para el modal -->
<script type="text/javascript">
	function funcionDelete(name) {
		$("#text-modal").html("");
		var cadena = "eliminar.php?t=name";
		cadena = cadena.replace("name",name);
		$("#btn_delete").attr("href", cadena);
		$("#text-modal").append("¿Está seguro de que desea eliminar la imagen <strong>" + name + "</strong>?");
	}
</script>


<?php
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>