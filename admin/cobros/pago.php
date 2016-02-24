<?php

   	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";


    if($sesion===false){
		header("location:/admin/login");
		exit;
	}

    include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";

?>


<!-- About Section -->
         <div class="container">
             <br>   
             <div class="page-header">
			 <h2 class="text-center">Generar Pago</h2>
			</div>     
            <form>
			   
			    <div class="form-group">
			        <label for="inputEmail">Usuario</label>
			        <input class="form-control" id="usuario" name="usuario">
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Correo</label>
			        <input class="form-control" id="correo" name="correo">
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Origen</label>
			        <input class="form-control" id="origen" name="origen">
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Destino</label>
			        <input class="form-control" id="destino" name="destino">
			    </div>
			    <div class="form-group">
			        <label for="inputPassword">Precio</label>
			        <input class="form-control" id="precio" name="precio">
			    </div>
			    
			    <button type="submit" class="btn btn-primary">Enviar</button>
			</form>    
		</div>	    