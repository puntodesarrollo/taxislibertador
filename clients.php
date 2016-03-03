<!-- Clients Aside -->
    <div id="clients">
        <div class="container">
            <h2 class="section-heading text-center">Nuestros Clientes</h2>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/admin/categoria_cliente/obtener.php";
    include $_SERVER['DOCUMENT_ROOT']."/admin/clientes/obtener.php";

    $categorias = lista();

    for($i=0;$categorias[$i]!=null;$i++)
    {

        echo '<div class="col-md-6">
                <div class="page-header text-center">
                    <h4>
                    '.$categorias[$i][1].'
                    </h4>
                </div>';
        $clientes = obtenerClientes($categorias[$i][0]);

        for($j=0;$clientes[$j]!=null;$j++)
        {
            $cliente = obtenerCliente($clientes[$j]);
            echo '
                    <div class="col-md-4">
                        <img src="/admin/clientes/'.$cliente["imagen"].'" class="img-responsive img-centered img-rounded imageHover" alt="'.$cliente["nombre"].'"style="height:100px">
                        <h6 class="text-center text-muted">
                        '.$cliente["nombre"].'
                        </h6>
                    </div>';                
        }
        echo '<div class="clearfix"></div><hr>
        </div>';
    }
?>
        </div>
    </div>
    <div class="clearfix"></div>

    <script type="text/javascript">
        $(document).ready(function(){

            $( ".imageHover" ).hover(function() {
              $( this ).animate({
                opacity: 0.9
              }, 200, function() {
              });
            }, function() {
                $( this ).animate({
                    opacity: 1
                  }, 200, function() {
                  });
              });
        });
    </script>