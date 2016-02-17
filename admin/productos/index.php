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
        <h2 class="text-center">Productos del Sistema</h2>
    </div>
	<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Valor</th>
						<th>Cantidad</th>
						<th>Dias</th>
						<th>Mostrar</th>
						<th>Asignar Imágenes</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php								
					
					$sql="SELECT * FROM productos ORDER BY nombre DESC";
					
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) {
						$result->data_seek($i);
						$fila = $result->fetch_assoc();						

						$dias =obtenerDias($fila["id"],$con);	
						$nombreCod =  urlencode('aaaa');						

						if($fila["mostrar"]==1){

							$mostrar="Si";
						}else{

							$mostrar="No";
						}	

						echo '<tr>
							<td>'.$fila["nombre"].'</td>
							<td>'.$fila["descripcion"].'</td>
							<td>'.$fila["precio"].'</td>
							<td>'.$fila["cantidad"].'</td>	
							<td>'.$dias.'</td>
							<td>'.$mostrar.'</td>													
							<td><a href="editarImagenes.php?p='.$fila["id"].'"><span class="glyphicon glyphicon-picture text-primary"></span></a></td>
							<td><a href="editar.php?t='.$fila["id"].'"><span class="glyphicon glyphicon-edit text-primary"></span></a></td>
							<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDelete(\''.$nombreCod.'\')">
									<span class="glyphicon glyphicon-remove-circle text-danger"></span>
								</a></td>
						</tr>';
					}
					mysqli_close($con);
					?>
				</tbody>
			</table>
			<div class="modal-footer">
				<a href="agregar.php" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-plus text-primary"></span>&nbsp;Nueva Colacion</a>
			</div>
		</div>
<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>		
<?php 
	function obtenerDias($id_producto,$con){

		$sql="SELECT * FROM dias_productos WHERE id_producto='$id_producto' ORDER BY dia ASC";
					
		$result = mysqli_query($con,$sql);
		$dias="";			
		for ($i = 0; $i <$result->num_rows; $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();									
			$var= $fila["dia"];

			if($var == "0" ) {
				$dias .= "Domingo, ";
			} 
			if ($var == "1" ) {
				$dias .= "Lunes, ";
			} 
			if ($var == "2" ) {
				$dias .= "Martes, ";
			} 
			if ($var == "3" ) {
				$dias .= "Miercoles, ";
			} 
			if ($var == "4" ) {
				$dias .= "Jueves, ";

			}
			if ($var == "5" ) {
				$dias .= "Viernes, ";

			} 
			if ($var == "6" ) {
				$dias .= "Sabado, ";
			}
		}	

		return $dias;	
	}
?>
