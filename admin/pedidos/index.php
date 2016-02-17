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
    <h1 class="text-center">Pedidos</h1>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Usuario</th>
					<th>Fecha</th>
					<th>Total Ventas</th>
					<th>Ver Detalle</th>
					<th>Confirmar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

					$sql="SELECT ID, IDusuario FROM pedidos WHERE entregado='false'";

					$result = mysqli_query($con,$sql);

					for ($i = 0; $i <$result->num_rows; $i++) 
					{
						$result->data_seek($i);
						$fila = $result->fetch_assoc();

						$IDpedido = $fila["ID"];
						$IDusuario = $fila["IDusuario"];

						include $_SERVER['DOCUMENT_ROOT']."/admin/obtenerDatosVenta.php";

						echo '<tr>
								<td><a href="/admin/usuariosSistema/datosUsuario.php?t='.$IDusuario.'" target="_blank">'. $Usuario .'</a></td>
								<td>'. $Fecha .'</td>
								<td>'. $Total .'</td>
								<td><a href="detallePedido.php?t='.$IDpedido.'"><span class="glyphicon glyphicon-list text-primary"></span></a></td>
								<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionConfirmar(\''.$IDpedido.'\')">
										<span class="glyphicon glyphicon-ok text-success"></span>
									</a></td>
								<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDelete(\''.$IDpedido.'\')">
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
					<h4 class="modal-title text-center" id="myModalLabel"></h4>
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
	function funcionDelete(name) 
	{
		$("#myModalLabel").html("¿Eliminar Pedido?");
		$("#text-modal").html("");
		var cadena = "eliminar.php?t=name";
		cadena = cadena.replace("name",name);
		$("#btn_delete").attr("href", cadena);
		$("#btn_delete").html("Eliminar");
		$("#text-modal").append("¿Está seguro de que desea eliminar el pedido?");
	}

	function funcionConfirmar(name) 
	{
		$("#myModalLabel").html("Confirmar Pedido?");
		$("#text-modal").html("");
		var cadena = "confirmar.php?t=name";
		cadena = cadena.replace("name",name);
		$("#btn_delete").attr("href", cadena);
		$("#btn_delete").html("Confirmar");
		$("#text-modal").append("¿Está seguro de que desea marcar el pedido como entregado?");
	}
	</script>

<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>