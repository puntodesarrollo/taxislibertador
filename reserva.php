<?php

    $conexion = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

?>


<!-- About Section -->
    <section id="reserva" style="max-height:700px !important">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center" style="border-right:1px solid #e0e0eb !important">
                    <br class="hidden-xs">
                    <h1 class="section-heading">Taxis El Libertador</h1>
                    <h2 class="section-subheading text-muted">52 2511826 - 963030062</h2>
                    <h3 class="section-subheading text-muted">contacto@taxislibertador.cl<br><br>18 de septiembre 5083, Estación Paipote, Región de Atacama</h3>
                    <br>
                    <img class="img-rounded img-responsive" src="img2.jpg" width="100%" alt="">
                </div>
                <div class="col-md-6">
                    <br class="hidden-xs">
                    <h2 class="text-center">¡Haz tu reserva!</h2>
                    <form class="form-horizontal" role="form" action="enviarSolicitud()">
                        <div class="form-group">
                            <label for="nombre" class="control-label col-sm-4">Fecha</label>
                            <div class="col-sm-8">
                                <input class="form-control fecha" id="fecha" name="fecha"
                                       data-val-date="Ingrese por favor una fecha." data-val-required="El campo fecha es obligatorio."
                                       data-date-format="DD/MM/YYYY" pattern="[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]"
                                       type="text" required>
                           </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="control-label col-sm-4">Hora</label>
                            <div class="col-sm-8">
                                <input class="form-control hora" id="hora" name="hora"
                                       data-val-date="Ingrese por favor una fecha." data-val-required="El campo hora es obligatorio."
                                       pattern="[0-9][0-9]*:[0-9][0-9] [a,p][m]"
                                       type="text" required>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="nombre" class="control-label col-sm-4">Dirección</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="direccion" id="direccion" type="text" required />
                           </div>                       
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="control-label col-sm-4">Solicitante</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="solicitante" id="solicitante" type="text" required />
                           </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="control-label col-sm-4">Teléfono</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="telefono" id="telefono" type="text" required />
                           </div>                       
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="control-label col-sm-4">Correo</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="correo" id="correo" type="mail" required />
                           </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="control-label col-sm-4">Comentarios del Servicio</label>
                            <div class="col-sm-8">
                                <textarea rows="5" name="comentario" id="comentario" class="form-control" placeholder="comentarios sobre el servicio" maxlength="2000" style="width:100% !important" required ></textarea>
                           </div>
                        </div>
                        <div class="col-md-3 col-md-offset-9">
                            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>

    function enviarSolicitud()
    {
        
    }

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

    });
    </script>