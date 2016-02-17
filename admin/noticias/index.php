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
    <h1 class="text-center">Noticias</h1>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Título</th>
					<th>Fecha</th>
					<th class="col-sm-2">Imagen</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

					$sql="SELECT * FROM noticias";
		
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) 
					{
						$result->data_seek($i);
						$fila = $result->fetch_assoc();
						$ID = $fila["ID"];

						echo '<tr>
								<td>'. $fila["titulo"] .'</td>
								<td>'. $fila["fecha"] .'</td>
								<td><img class="img-rounded" alt="sin imagen" src="'. $fila["imagen"] .'" width="100%"></td>
								<td><a href="editar.php?t='.$ID.'"><span class="glyphicon glyphicon-edit text-primary"></span></a></td>
								<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDelete(\''.$ID.'\')">
										<span class="glyphicon glyphicon-remove-circle text-danger"></span>
									</a></td>
							</tr>';
					}
				?>				
			</tbody>
		</table>
		<div class="modal-footer">
			<a href="agregar.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;Agregar</a>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">¿Eliminar Noticia?</h4>
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
		$("#myModalLabel").html("¿Eliminar Noticia?");
		$("#text-modal").html("");
		var cadena = "eliminar.php?t=name";
		cadena = cadena.replace("name",name);
		$("#btn_delete").attr("href", cadena);
		$("#text-modal").append("¿Está seguro de que desea eliminar la noticia?");
	}
	</script>

<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>