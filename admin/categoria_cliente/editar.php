<?php 

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}
	
	
	if($_GET["t"]!=null){
	
	$ID = $_GET["t"];
	
	//obtener los datos de la bd
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	
	$sql="SELECT * FROM categoria_cliente WHERE ID='$ID'";

	$result = mysqli_query($con,$sql);
	
	if($result===false || $result->num_rows===0)
	{
		header("location:/admin/servicios");
	}
	
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		$nombre=$fila["nombre"];
	}
	
	mysqli_close($con);
}
else
{
	header("location:/admin");
}


include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>
		
	<div class="col-sm-8 col-sm-offset-2">
		<div class="page-header">
			<h2 class="text-center">Editar Categoría de Cliente</h2>
		</div>
		<br class="hidden-xs">
		<br class="hidden-xs">
		<form action="metodoEditar.php" method="post" enctype="multipart/form-data" class="form-horizontal">
			<input name="ID" id="ID" value="<?php echo $ID;?>" hidden>
			<div class="form-group">
				<label for="nombrePrograma" class="control-label">Nombre Actual</label>
				<input type="text" class="form-control" id="nombreAnterior" <?php echo 'value="'.$nombre.'"' ?>
				maxlength="200" readonly>
			</div>
			<div id="divNombre" class="form-group">
				<label for="nombre" class="control-label">Nombre</label>
				<input type="text" class="form-control" name="nombre" id="nombre" <?php echo 'value="'.$nombre.'"' ?>
				maxlength="100" placeholder="nombre de producto" required>
				<span id="spanInput" class="glyphicon form-control-feedback"></span>
				<div id="mensajeError" class="alert alert-danger hidden">
					<strong>Error: </strong> ya existe una categoría con este nombre
				</div>
			</div>
			<div class="modal-footer">
				<a href="/admin/categoria_cliente" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
				<button class="btn btn-primary btn-lg" id="botonAgregar"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Guardar</button>
			</div>
		</form>
			
	</div>
<script>
	
$( document ).ready(function() {
	    console.log( "ready!" );

	    function verificarCampos(){

			habilitarBoton=true;		
			
			nombre=$("#nombre").val();
			nombreAnterior=$("#nombreAnterior").val();
			
			$.get( "verificarNombre.php", { nombre: nombre } )
				.done(function( data ) {
					console.log(data);
					if(data=="true" && nombre!=nombreAnterior)
					{
						$("#divNombre").addClass(" has-error");
						$("#divNombre").addClass(" has-feedback");
						$("#divNombre").removeClass(" has-success");
						$("#spanInput").addClass("glyphicon-remove");
						$("#spanInput").removeClass("glyphicon-ok");					
						$("#mensajeError").removeClass("hidden");
						
						habilitarBoton=false;
					}
					else 
					{
						$("#divNombre").removeClass(" has-error");
						$("#divNombre").addClass(" has-feedback");
						$("#divNombre").addClass(" has-success");
						$("#spanInput").addClass("glyphicon-ok");
						$("#spanInput").removeClass("glyphicon-remove");
						$("#mensajeError").addClass("hidden");
					}
					
					
					if(habilitarBoton)
					{
						$("#botonAgregar").removeAttr("disabled");
					}
					else
					{
						$("#botonAgregar").attr("disabled", "disabled");
					}				
				});
		}

		$("#nombre").change(function () {
			verificarCampos();
		});
	});
</script>

<?php
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>