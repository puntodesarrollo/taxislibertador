<?php 

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}


	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
?>
	<br>
    <div class="page-header">
        <h2 class="text-center">Administrador <small>Taxis Libertador</small></h2>
    </div>
	<div class="col-sm-6">
		<div id="panel1">
			<div id="panel1Arriba"></div>									
			<img src="reservas.png" alt="Reservas de Productos" width="200px" height="200px" class="center-block img-circle">
			<div id="panel1Abajo"></div>
			<h4 class="text-center">Reservas de Servicios</h4>
		</div> 
		<div class="text-center">
			<br>
			<a href="/admin/servicios" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Ver Todos</a>
			<a href="/admin/servicios/agregar.php" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-plus"></span>&nbsp;Agregar Nuevo</a>
		</div>
	</div>
	<div class="col-sm-6">
		<div id="panel1">
			<div id="panel1Arriba"></div>									
			<img src="imagen.png" alt="Imagenes de Flota" width="200px" height="200px" class="center-block img-circle">
			<div id="panel1Abajo"></div>
			<h4 class="text-center">Imágenes de Flota</h4>
		</div> 
		<div class="text-center">
			<br>
			<a href="/admin/galeria" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Ver Todos</a>
			<a href="/admin/galeria/agregar.php" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-plus"></span>&nbsp;Agregar Nuevo</a>
		</div>
	</div>
	
<?php
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>