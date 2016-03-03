<!-- Clients Aside -->
    <div id="clients">
        <div class="container">
            <div class="page-header">
                <h2>Nuestros Clientes</h2>
            </div>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/admin/categoria_cliente/obtener.php";

    $categorias = lista();

    for($i=0;$categorias[$i]!=null;$i++)
    {
        echo '<div class="row">
                <h4>
                '.$categorias[$i][1].'
                </h4>
            </div>';
    }
    /*

                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/designmodo.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/themeforest.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img src="img/logos/creative-market.jpg" class="img-responsive img-centered" alt="">
                    </a>
                </div>
    //*/
?>
        </div>
    </div>