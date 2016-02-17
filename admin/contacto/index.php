<?php 

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}


	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";

	$fInicioValue="";
	$fTerminoValue="";
	if($_GET["inicio"]!=null && $_GET["termino"]!=null){

		list($mes1, $dia1, $anio1) = split('-', $_GET["inicio"]);
		list($mes2, $dia2, $anio2) = split('-', $_GET["termino"]);
		$fInicioValue=$dia1.'-'$mes1											
	}

?>
	<br>
	<br>
    <div class="page-header">
        <h2 class="text-center">Mensajes</h2>
    </div>

    <div class="col-md-11">    
    	<div class="col-md-2">
        	<h4><small>Filtro de fechas:</small></h4>
    	</div>
    	<div class="col-md-4">
        	<input class="form-control fecha" id="fecha1" name="fecha1" data-val-date="Ingrese por favor una fecha." data-val-required="El campo fecha es obligatorio."
            	   data-date-format="DD/MM/YYYY" pattern="[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]"
               		type="text" value="<? echo  $fInicioValue; ?>">

    		</div>
    		<div class="col-md-4">
        		<input class="form-control fecha" id="fecha2" name="fecha2" data-val-date="Ingrese por favor una fecha." data-val-required="El campo fecha es obligatorio."
               		data-date-format="DD/MM/YYYY" pattern="[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]"
               		type="text" value="<? echo $fTerminoValue; ?>">
    		</div>
    		
    		<div class="col-md-2">
        		<input class="form-control" id="Boton" value="Buscar" type="button" />
    		</div>
	</div>
	<div class="clearfix"></div>
	
	<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Fecha</th>
						<th>Nombre Contacto</th>
						<th>Mail</th>
						<th>Telefono</th>
						<th>Ver Mensaje</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

					if($_GET["inicio"]!=null && $_GET["termino"]!=null){
						$fInicio=$_GET["inicio"];
						$fTermino=$_GET["termino"];										
						$sql="SELECT * FROM contacto WHERE fecha>='$fInicio' AND fecha<='$fTermino'";
						//$sql="SELECT * FROM contacto WHERE fecha>=$fInicio AND fecha<=$fTermino";								
					}else{
						$sql="SELECT * FROM contacto";			
					}	
										
					
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) 
					{
						$result->data_seek($i);
						$fila = $result->fetch_assoc();
						$id = $fila["id"];
						$fecha = $fila["fecha"];
						$nombre_contacto = $fila["nombre_contacto"];
						$mail_contacto = $fila["mail_contacto"];
						$telefono_contacto = $fila["telefono_contacto"];						

						echo '<tr>
								<td>'. $fecha .'</td>
								<td>'. $nombre_contacto .'</td>
								<td>'. $mail_contacto .'</td>
								<td>'. $telefono_contacto .'</td>
								<td><a href="ver.php?t='.$id.'"><span class="glyphicon glyphicon-edit text-primary"></span></a></td>								
							</tr>';
					}
				?>		
				</tbody>
			</table>			
		</div>

	
</div><!--body-->

<script>
	$( document ).ready(function() {
	    $(".fecha").datetimepicker({
                    viewMode: 'days',
                    format: 'DD/MM/YYYY'
        });	 
        $("#Boton").click(function () {
                var fecha1 = $("#fecha1").val();
                var fecha2 = $("#fecha2").val();                

                fecha1 = fecha1.replace("/", "-").replace("/", "-");
                fecha2 = fecha2.replace("/", "-").replace("/", "-");
                
				var fecha1S = fecha1.split('-');
				fecha1= fecha1S[2]+"-"+fecha1S[1]+"-"+fecha1S[0];

				var fecha2S = fecha2.split('-');
				fecha2= fecha2S[2]+"-"+fecha2S[1]+"-"+fecha2S[0];


                if (fecha1=="" || fecha2=="") {
                    alert("Debe ingresar ambas fechas");
                }
                else {
                    console.log(fecha1 + "-" + fecha2);
                    ruta = "/admin/contacto?inicio=" + fecha1 + "&termino=" + fecha2;
                    console.log(ruta);
                    window.location.href = ruta
                }
        });   
	});
</script>

<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>