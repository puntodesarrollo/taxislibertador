<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador - Colaciones Andrea</title>

	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/admin/Scripts/editor.css">

	<link rel="shortcut icon" href="/logo_icon.png">

</head>
<body style="background-color:#FAFAFA !important">	
	<?php

$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if(!($sesion===false)){
		echo '<nav role="navigation" class="navbar navbar-fixed-top navbar-inverse">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="/admin" class="navbar-brand">Inicio</a>
		</div>
		<!-- Collection of nav links and other content for toggling -->
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
			<li><a href="/admin/productos">Productos</a></li>
			<li><a href="/admin/categorias">Categorías</a></li>
			<li><a href="/admin/creatuplato">Crea Tu Plato</a></li>
			<li><a href="/admin/pedidos">Pedidos</a></li>	
			<li><a href="/admin/ventas">Registro de ventas</a></li>
			<li><a href="/admin/noticias">Noticias</a></li>
			<li><a href="/admin/slider">Slider</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<li><a href="/admin/usuariosSistema">Usuarios Registrados</a></li>
			<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">Mi Cuenta<b class="caret"></b></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="/admin/login/cambiarContrasena.php">Cambiar mi Contraseña</a></li>
						<li><a href="/admin/login/index.php?close=1">Salir</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>';
	}

	?>

<div class="container">