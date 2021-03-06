<?php 

	$sesion = include $_SERVER['DOCUMENT_ROOT']."/admin/verificarSesion.php";

	if($sesion===false){
		header("location:/admin/login");
		exit;
	}

	if($_GET["Inicio"]!=null){
		$Inicio = $_GET["Inicio"];
		$Inicio = explode("-", $Inicio);
		$INICIO = $Inicio[0] . '/' . $Inicio[1] .'/' . $Inicio[2];
		$Inicio = new DateTime($Inicio[2] . '-' . $Inicio[1] .'-' . $Inicio[0] . ' 00:00:00');
		$Inicio = $Inicio->format('Y-m-d H:i:s');
	}
	else
	{
		$Inicio = new DateTime('now');
		$Inicio->sub( new DateInterval('P1D') )->format('Y-m-d');
		$Inicio = $Inicio->format('Y-m-d H:i:s');

		$Inicio = explode(" ", $Inicio);
		$Inicio = explode("-", $Inicio[0]);
		$INICIO = $Inicio[2] . '/' . $Inicio[1] .'/' . $Inicio[0];
		$Inicio = new DateTime($Inicio[2] . '-' . $Inicio[1] .'-' . $Inicio[0] . ' 00:00:00');
		$Inicio = $Inicio->format('Y-m-d H:i:s');
	}

	if($_GET["Termino"]!=null){
		$Termino = $_GET["Termino"];
		$Termino = explode("-", $Termino);
		$TERMINO = $Termino[0] . '/' . $Termino[1] .'/' . $Termino[2];
		$Termino = new DateTime($Termino[2] . '-' . $Termino[1] .'-' . $Termino[0] . ' 00:00:00');
		$Termino = $Termino->format('Y-m-d H:i:s');
	}
	else
	{
		$Termino = new DateTime('now');
		$Termino->add(new DateInterval('P10D'))->format('Y-m-d');
		$Termino = $Termino->format('Y-m-d H:i:s');

		$Termino = explode(" ", $Termino);
		$Termino = explode("-", $Termino[0]);
		$TERMINO = $Termino[2] . '/' . $Termino[1] .'/' . $Termino[0];

		$Termino = new DateTime($Termino[2] . '-' . $Termino[1] .'-' . $Termino[0] . ' 00:00:00');
		$Termino = $Termino->format('Y-m-d H:i:s');
	}
	
	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";
?>
	<br>
	<br>
	<br>
	<div class="page-header">
		<h2 class="text-center">Reservas de Servicios</h1>
	</div>
	<div class="col-sm-12">
		<div class="col-sm-3">
			<h4>Filtros:</h4>
		</div>
		<div class="col-sm-3">
			<label class="control-label">Inicio:</label>
			<input class="form-control fecha" id="inicio" name="inicio"
               data-val-date="Ingrese por favor una fecha." data-val-required="El campo fecha es obligatorio."
               data-date-format="DD/MM/YYYY" pattern="[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]"
               type="text" value="<?php echo $INICIO;?>" required>
		</div>
		<div class="col-sm-3">
			<label class="control-label">Término:</label>
			<input class="form-control fecha" id="termino" name="termino"
               data-val-date="Ingrese por favor una fecha." data-val-required="El campo fecha es obligatorio."
               data-date-format="DD/MM/YYYY" pattern="[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]"
               type="text" value="<?php echo $TERMINO;?>" required>
		</div>
		<div class="col-sm-3">
			<br class="hidden-xs">
			<button id="buscar" class="btn btn-default btn-lg btn-block">Buscar</button>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Origen</th>
					<th>Destino</th>
					<th>Solicitante</th>
					<th>Confirmado</th>
					<th>Ver Detalles</th>
					<th>Marcar Confirmado/No Confirmado</th>
					<th>Generar Cobro</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include $_SERVER['DOCUMENT_ROOT']."/admin/conexion.php";

					$sql="SELECT * FROM reservas WHERE fecha<='$Termino' AND fecha>='$Inicio' ORDER BY fecha ASC";

					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) 
					{
						$result->data_seek($i);
						$fila = $result->fetch_assoc();
						$ID = $fila["ID"];

						echo '<tr>
								<td>'. $fila["fecha"] .'</td>
								<td>'. $fila["direccion"] .'</td>
								<td>'. $fila["destino"] .'</td>
								<td>'. $fila["solicitante"] .'</td>
								<td>'. $fila["realizado"] .'</td>
								<td><a href="detalles.php?t='.$ID.'"><span class="glyphicon glyphicon-search text-primary"></span></a></td>
								<td><a href="marcar.php?t='.$ID.'"><span class="glyphicon glyphicon-check text-primary"></span></a></td>
								<td><a href="/admin/cobros/pago.php?t='.$ID.'"><span class="glyphicon glyphicon-usd text-primary"></span></a></td>
								<td><a href="editar.php?t='.$ID.'"><span class="glyphicon glyphicon-edit text-primary"></span></a></td>								
								<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDelete(\''.$ID.'\')">
										<span class="glyphicon glyphicon-remove-circle text-danger"></span>
									</a></td>
							</tr>';
					}
				?>				
			</tbody>
		</table>
		<div class="modal-footer">
			<a href="agregar.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;Agregar</a>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">¿Eliminar Reserva?</h4>
				</div>
				<div class="modal-body">
					<h5 class="text-center" id="text-modal"></h5>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>Cancelar</button>
					<a href="" type="button" id="btn_delete" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i>Eliminar</a>
				</div>
			</div>
		</div>
	</div>

<script>

	// A $( document ).ready() block.
	$( document ).ready(function() {
	    console.log( "ready!" );

	    $(".fecha").datetimepicker({
                    viewMode: 'days',
                    format: 'DD/MM/YYYY'
                });
	    $(".hora").datetimepicker({
                    viewMode: 'days',
                    format: 'h:mm a'
                });

	    $("#buscar").click(function()
	    	{


	    		window.location = "index.php?Inicio="+$("#inicio").val().replace("/","-").replace("/","-")+"&Termino="+$("#termino").val().replace("/","-").replace("/","-");
	    	});

	});
</script>

	<script type="text/javascript">
	function funcionDelete(name) {
		$("#myModalLabel").html("¿Eliminar Reserva?");
		$("#text-modal").html("");
		var cadena = "eliminar.php?t=name";
		cadena = cadena.replace("name",name);
		$("#btn_delete").attr("href", cadena);
		$("#text-modal").append("¿Está seguro/a de que desea eliminar la reserva?");
	}
	</script>

<?php
	mysqli_close($con);
	include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";
?>