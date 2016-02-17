<?php
		$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

		if($sesion===false){
			header("location:/admin/login");
			exit;
		}

		include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
    	


		$id_producto= $_GET["p"];		

		include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

		$sql="SELECT * FROM productos WHERE id='$id_producto'";						
		$result = mysqli_query($con,$sql);
		
		for ($i = 0; $i <$result->num_rows; $i++) {			
			$result->data_seek($i);
			$fila = $result->fetch_assoc();						
			$nombre=$fila["nombre"];														
		}	


		
		$sql_fotos="SELECT * FROM fotos_productos WHERE id_producto='$id_producto'";
					
		$result_fotos = mysqli_query($con,$sql_fotos);
		$fotos=array();			
		
							

	?>
	</br>
	</br>	
	<div class="page-header">
        <h2 class="text-center">Eliminar Imagenes de <?php echo $nombre; ?></h2>
    </div>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="col-sm-10">Imagen</th>					
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php									
					
					for ($i = 0; $i <$result_fotos->num_rows; $i++) 
					{
						$result_fotos->data_seek($i);
						$fila = $result_fotos->fetch_assoc();	
						$id = $fila["id"];
						$nombreFoto=$fila["ruta_foto"];	
						echo '<tr>
								<td><img src="'.$nombreFoto.'" width="40%"; class="hidden-xs" /><img src="'.$nombreFoto.'" width="100%"; class="visible-xs" /></td>								
								<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDelete(\''.$id.'\',\''.$nombreFoto.'\',\''.$id_producto.'\')">
										<span class="glyphicon glyphicon-remove-circle text-danger"></span>
									</a></td>
							</tr>';
					}
				?>				
			</tbody>
		</table>

		
	</div>



	<div class="page-header">
        <h2 class="text-center">Agregar Imagenes a <?php echo $nombre; ?></h2>
    </div>
	<div class="col-sm-12">
		<form action="agregarNuevasImagenes.php" method="post" enctype="multipart/form-data">
			<input name="id_producto" value="<?php echo $id_producto; ?>" hidden/>
			<div class="form-group">
				<label for="nombre" class="control-label">Imagenes</label>
				<input type="file" class="filestyle" name="imagen[]" id="imagen" data-input="false" data-buttonText="Elegir Imagenes" multiple accept="image/*">
			</div>
			<div class="modal-footer">				
				<button class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Agregar</button>
			</div>
		</form>
	</div>



	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">¿Eliminar imagen?</h4>
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
	function funcionDelete(id,nombreFoto,idProducto) {
		$("#text-modal").html("");
		var cadena = "eliminarImagen.php?t=id&n=nombreFoto&producto=idProducto";
		cadena = cadena.replace("id",id);
		cadena = cadena.replace("nombreFoto",nombreFoto);
		cadena = cadena.replace("idProducto",idProducto);
		$("#btn_delete").attr("href", cadena);
		$("#text-modal").append("¿Está seguro de que desea eliminar esta imagen?");
	}
		
	</script>	
<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>	