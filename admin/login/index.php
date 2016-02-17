<?php

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($_GET["close"]==1)
	{		
		unset($_SESSION["IDUsuario"]);
		unset($_SESSION["usuario"]);
		/*session deleted. if you try using this you've got an error*/
		header("location:/admin/login");
		exit;
	}
	else if($sesion){
		header("location:/admin");
		exit;
	}
	else if($_POST["usuario"]!=null){
		
		$usuarioIngresado = $_POST["usuario"];

		include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
		
		$sql="SELECT * FROM admin WHERE usuario = '" . $usuarioIngresado . "'";
		
		$result = mysqli_query($con,$sql);
		
		for ($i = 0; $i <$result->num_rows; $i++) 
		{
			$result->data_seek($i);
			$fila = $result->fetch_assoc();
			
			if($fila["password"]==$_POST["password"])
			{
				//Se inicia la sesión con la ID del usuario
				$_SESSION['IDUsuario']  = $fila["ID"];

				$_SESSION['usuario']  = $usuarioIngresado;

				header("location:/admin");
				exit;
			}
		}

		mysqli_close($con);
	}

	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
?>



	<?php
	if($_GET["m"]==1)echo '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" 
				aria-hidden="true">
				&times;
			</button>
		   La contraseña ha sido modificada. Por favor, vuelva a ingresar
		</div>';
	?>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">				
		<div class="row">
			<div class="col-xs-12 col-sm-4">
			</div>
			<div class="col-xs-12 col-sm-4">
				<form role="form" action="index.php" method="post">
					<div class="form-group">
						<label>Usuario</label>
						<input type="text" class="form-control" id="usuario" name="usuario"
						   placeholder="Introduce tu nombre de usuario" required>
					</div>
					<div class="form-group">
						<label>Contraseña</label>
						<input type="password" class="form-control" id="password" name="password"
						   placeholder="Contraseña" required>
					</div>					
					<button type="submit" class="btn btn-primary btn-block btn-lg"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Ingresar</button>
					<br>
					<br>
				</form>
			</div>
			<div class="col-xs-12 col-sm-4">				
			</div>
		</div>		
	</div>	

<?php
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>