<?php 

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;

	}

	if($_GET["t"]!=null){
		$ID = $_GET["t"];
	}
	else
	{
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
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

					$sql="SELECT * FROM detallepedido WHERE ID='$ID'";
		
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) 
					{
						$result->data_seek($i);
						$fila = $result->fetch_assoc();
						$IDproducto = $fila["IDproducto"];

						include $_SERVER['DOCUMENT_ROOT']."/admin/obtenerDatosProducto.php";

						echo '<tr>
								<td>'. $Producto .'</td>
								<td>'. $fila["cantidad"] .'</td>
								<td>'. $fila["precio"] .'</td>
							</tr>';
					}
				?>				
			</tbody>
		</table>
		<div class="modal-footer">
			<a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Volver</a>
		</div>
	</div>

<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>