<?php
	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	$ruta1="";
	define ('SITE_ROOT', realpath(dirname(__FILE__)));

	$path="imgSlider/";

	//agregar las imágenes que corresponden

	if (isset ($_FILES["imagen"])) {         
        $tot = count($_FILES["imagen"]["name"]);         
        include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";
        for ($i = 0; $i < $tot; $i++){                     
            $nombreArchivo=str_replace(" ","_",$_FILES["imagen"]["name"][$i]);
			$nombreArchivo=str_replace(" ","_",$nombreArchivo);
			move_uploaded_file($_FILES["imagen"]["tmp_name"][$i], SITE_ROOT."/". $path . $nombreArchivo);
			$ruta1=$path . $nombreArchivo;
            $resultado = $con->query("INSERT INTO fotos_slider (ruta_foto) VALUES('$ruta1')");
        }
    }
	header("location:/admin/slider");
?>
