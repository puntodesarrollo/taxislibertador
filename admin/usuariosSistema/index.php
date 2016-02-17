<?php 
$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

		if($sesion===false){
			header("location:/admin/login");
			exit;
		}

		include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
    	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
    ?>
    <br>
    <br>
    <div class="page-header">
        <h2 class="text-center">Usuarios Registrados en el Sistema</h2>
    </div>
	<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Direccion</th>
						<th>Telefono</th>						
						<th>Empresa</th>
						<th>Correo</th>						
						
					</tr>
				</thead>
				<tbody>
					<?php								
					
					$sql="SELECT * FROM usuarios";
					
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) {
						$result->data_seek($i);
					    $fila = $result->fetch_assoc();															
					
					    $es_empresa=$fila["es_empresa"];
					    if($es_empresa=="0"){

					    	$es_empresa="-";
					    }

						echo '<tr>
							<td>'.$fila["nombre"].'</td>
							<td>'.$fila["direccion"].'</td>
							<td>'.$fila["telefono"].'</td>
							<td>'.$es_empresa.'</td>	
							<td>'.$fila["correo"].'</td>							
						</tr>';
					}
					mysqli_close($con);
					?>
				</tbody>
			</table>
			
		</div>
<?php	
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>		