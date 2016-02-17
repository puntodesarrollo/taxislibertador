<?php 
$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

		if($sesion===false){
			header("location:/admin/login");
			exit;
		}

		if($_GET["t"]!=null){
	
			$ID = $_GET["t"];

			include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
	    	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

	    	$sql="SELECT * FROM usuarios WHERE ID='$ID'";
						
			$result = mysqli_query($con,$sql);
			
			for ($i = 0; $i <$result->num_rows; $i++) {
				$result->data_seek($i);
			    $fila = $result->fetch_assoc();															
			
		    	$es_empresa=$fila["es_empresa"];			
				$nombre = $fila["nombre"];
				$direccion = $fila["direccion"];
				$telefono = $fila["telefono"];
				$correo = $fila["correo"];
			}
			mysqli_close($con);
		}
		else
		{
			header("location:/admin/usuariosSistema");
			exit;
		}
    ?>
    <br>
    <br>
    <div class="col-sm-8 col-sm-offset-2">
	    <div class="page-header">
	        <h2 class="text-center">Datos de Usuario</h2>
	    </div>
		<div class="col-sm-6">
			<h3>Datos Personales:</h3>
		    <strong>Nombre: </strong><?php echo $nombre; ?>
		    <br>
		    <strong>Dirección: </strong><?php echo $direccion; ?>
		    <br>
		    <strong>Teléfono: </strong><?php echo $telefono; ?>
		    <br>
		    <strong>Correo: </strong><?php echo $correo; ?>
		    <br>
		</div>
	    <div class="col-sm-6">
			<h3>Datos de Facturación:</h3>
			<?php if($es_empresa==="0"){
				echo '<h4>Sin datos</h4>';
			}
			else
			{
				echo 'nombre o razón social, RUT, domicilio, comuna, giro del negocio y teléfono.';
			} ?>
	    	
	    </div>
    </div>
	
<?php	
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>		