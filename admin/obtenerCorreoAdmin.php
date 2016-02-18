<!-- Portfolio Grid Section -->
<?php 
    $conexionCorreo=include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
    $sql="SELECT * FROM correo ORDER BY correo DESC";                
    $result = mysqli_query($conexionCorreo,$sql);

    $correo="";
    for ($i = 0; $i <$result->num_rows; $i++) {
        $result->data_seek($i);
        $fila = $result->fetch_assoc();                     
		$correo=$fila["correo"];                                                
    }
    mysqli_close($conexionCorreo);

    return $correo;
?>