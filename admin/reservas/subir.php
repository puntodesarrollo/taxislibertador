<?php	
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

	define ('SITE_ROOT', realpath(dirname(__FILE__)));
	$path="/imagenes/";

	//Variables album
	$fecha = $_POST["fecha"];
	$hora = $_POST["hora"];

	$direccion = $_POST["direccion"];
	$comentario = $_POST["comentario"];
	$solicitante = $_POST["solicitante"];
	$telefono = $_POST["telefono"];
	$correo = $_POST["correo"];

	//agregar los datos a la BD
	include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
	
	//echo "$fecha , $hora , $direccion , $comentario , $solicitante , $correo";

	$fechas = explode("/", $fecha);
	$horas = explode(" ", $hora);

	//echo '<br>';

	//echo $fechas[0] .' , '. $fechas[1] . ' , '. $fechas[2];

	//echo '<br>';

	$horasNum = explode(":", $horas[0]);

	//echo $horasNum[0] .' , '. $horasNum[1] . ' , ' . $horas[1];

	if($horasNum[0]=="12" && $horas[1]=="am")
	{
		$horasNum[0]="00";
	}
	if($horas[1]=="pm")
	{
		$horasNum[0]="" + (((int)$horasNum[0])+12) + "";
	}
	if($horasNum[0]=="24")
	{
		$horasNum[0]="12";
	}

	$d1=new DateTime($fechas[2] . '-' . $fechas[1] .'-' . $fechas[0] . ' ' . $horasNum[0].':'.$horasNum[1].':00');

	//echo '<br>';
	//echo $d1->format('Y-m-d H:i:s');
	$mysqltime = date ("Y-m-d H:i:s", $d1->getTimestamp());

	//Se agregan los datos

	$sql = "INSERT INTO reservas (fecha,direccion, solicitante, comentario, telefono, correo) VALUES('".$d1->format('Y-m-d H:i:s')."','$direccion','$solicitante', '$comentario', '$telefono', '$correo')";

	$resultado = $con->query($sql);

	mysqli_close($con);

	//redireccionar a programas
	header("location:/admin/reservas");
?>
