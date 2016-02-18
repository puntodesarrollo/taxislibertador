<?php 
    $conexionCorreo=include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
    $sql="SELECT * FROM correo ORDER BY correo DESC";                
    $result = mysqli_query($conexionCorreo,$sql);

    $correoAdmin="";
    for ($i = 0; $i <$result->num_rows; $i++) {
        $result->data_seek($i);
        $fila = $result->fetch_assoc();                     
		$correoAdmin=$fila["correo"];                                                
    }
    mysqli_close($conexionCorreo);

    return $correoAdmin;
?>