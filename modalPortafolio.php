<?php
    $conexionModal=include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
    $sql="SELECT * FROM fotos_galeria ORDER BY ruta_foto DESC";                
    $result = mysqli_query($conexionModal,$sql);    
?>

<?php 

    for ($i = 0; $i <$result->num_rows; $i++) {
        $result->data_seek($i);
        $fila = $result->fetch_assoc();                     
        $cont=$i+1;    

        echo '<div class="portfolio-modal modal fade" id="portfolioModal'.$cont.'" tabindex="-1" role="dialog" aria-hidden="true">';
            echo '<div class="modal-content">';
                echo '<div class="close-modal" data-dismiss="modal">';
                    echo '<div class="lr">';
                        echo '<div class="rl">';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="container">';
                    echo '<div class="row">';
                        echo '<div class="col-lg-8 col-lg-offset-2">';
                            echo '<div class="modal-body">';
                                echo '<h2>Nuestra Flota</h2>';                            
                                echo '<img class="img-responsive img-centered img-rounded" src="/admin/galeria/'.$fila["ruta_foto"].'" alt="">';                                                            
                                echo '<ul class="list-inline hidden">';
                                        echo '<li>Date: July 2014</li>';
                                        echo '<li>Client: Round Icons</li>';
                                        echo '<li>Category: Graphic Design</li>';
                                echo '</ul>';
                                echo '<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';



        //echo '<img src="/admin/galeria/'.$fila["ruta_foto"].'" class="img-responsive" alt="" style="height: 230px;"">';                                                                
    }
    mysqli_close($conexionModal);    
?>
