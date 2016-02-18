
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contactenos</h2>
                    <h3 class="section-subheading text-muted">Envienos sus dudas o consultas y se las responderemos a la brevedad!</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success hidden" id="form-message">
                        <strong>¡Mensaje Enviado correctamente!</strong> Gracias por contactarnos!
                    </div>
                    <div id="form-message"></div>
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Tu Nombre *" id="nombre" name="nombre" required data-validation-required-message="Por favor ingresa tu nombre.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Tu Email *" id="mail" name="mail" required data-validation-required-message="Porfavor ingresa tu correo electronico.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Tu Telefono *" id="telefono" name="telefono" required data-validation-required-message="Por favor ingresa tu telefono.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Tu Mensaje *" id="mensaje" name="mensaje" required data-validation-required-message="Por favor ingresa un mensaje."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl" onclick="return enviarCorreo();">Enviar Mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        
        function enviarCorreo(){

                var nombre = $("#nombre").val();
                var mail =$("#mail").val();
                var telefono = $("#telefono").val();  
                var mensaje = $("#mensaje").val();                  
                //$("#form-message").empty();    
                
                
                    $.ajax({
                        url: "enviarMensajeContacto.php", data: { "nombre": nombre, "mail": mail, "telefono": telefono, "mensaje":mensaje },
                        success: function (retorno) {  
                             $("#form-message").removeClass("hidden");
                                $("#nombre").val('');
                                $("#mail").val('');
                                $("#mensaje").val(''); 
                                $("#telefono").val(''); 
                                $("#form-message").delay(5000).fadeOut('slow');
                
                        }
                    });
                            
                
                return false;
            }


            function verificarEmail(){

                if($("#mail").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) {
                    //alert('El correo electrónico introducido no es correcto.');
                    return false;
                }
                return true;
            }
    </script>