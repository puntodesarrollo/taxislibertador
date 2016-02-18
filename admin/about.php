<?php 

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}
	
	
	//obtener los datos de la bd
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	
	$sql="SELECT * FROM about ";

	$result = mysqli_query($con,$sql);
	
	if($result===false || $result->num_rows===0)
	{
		header("location:/admin/about.php");
	}
	
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		$ID=$fila["ID"];
		$texto1=$fila["quienes"];
		$texto2=$fila["history"];
		
	}
	
	mysqli_close($con);


include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>
		
	<div class="col-sm-8 col-sm-offset-2">
		<br />
		<br />
		<div class="page-header">
			<h2 class="text-center">Editar Secciones</h2>
		</div>
		<br class="hidden-xs">
		<br class="hidden-xs">
		<form action="metodoEditar.php" method="post" enctype="multipart/form-data" class="form-horizontal">
			<input name="ID" id="ID" value="<?php echo $ID;?>" hidden>
			
			<div class="form-group">
				<label for="nombre" class="control-label">Quienes Somos</label>
				<textarea id="txtEditor"></textarea>
				<textarea id="txtEditorContent" name="txtEditorContent" hidden=""></textarea>
			</div>
			<div class="form-group">
				<label for="nombre" class="control-label">Nuestra Historia</label>
				<textarea id="txtEditor2"></textarea>
				<textarea id="txtEditorContent2" name="txtEditorContent2" hidden=""></textarea>
			</div>
			<br />
			<br />
			<div class="modal-footer">
				<a href="/admin" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
				<button class="btn btn-primary btn-lg" id="botonAgregar"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Guardar</button>
			</div>
		</form>
			
	</div>
<script>
	
$( document ).ready(function() {
	    console.log( "ready!" );

	    $("#txtEditor").Editor();
	    $("#txtEditor2").Editor();

		<?php
			echo 'var stxt = \''. $texto1 .'\';';
			echo 'var stxt2 = \''. $texto2 .'\';';
		?>
	    $('#txtEditor').Editor("setText", [stxt ]);
	    $('#txtEditor2').Editor("setText", [stxt2 ]);

	    $("#botonAgregar").click(function(){

			console.log($('#txtEditor').Editor("getText"));

			$('#txtEditorContent').text($('#txtEditor').Editor("getText"));
			$('#txtEditorContent2').text($('#txtEditor2').Editor("getText"));
		});

		
	});
</script>

<?php
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>