<?php
	//Se hace la conexion:
	$con = new mysqli("localhost", "cco21607", "ndJ3bWpf", "cco21607_colaciones");
	//Se avisa si falla la conexion:
	if ($con->connect_errno) {
		echo "Falló la conexión con MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
	}
	
	if (!$con->set_charset("utf8")) {
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $con->error);
	}
?>