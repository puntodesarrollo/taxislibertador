<!-- Portfolio Grid Section -->
<?php 
    $conexionPortafolio=include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
    $sql="SELECT * FROM fotos_galeria ORDER BY ruta_foto DESC";                
    $result = mysqli_query($conexionPortafolio,$sql);

    for ($i = 0; $i <$result->num_rows; $i++) {
        $result->data_seek($i);
        $fila = $result->fetch_assoc();                     
                                                
    }
?>
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Galeria</h2>
                    <h3 class="section-subheading text-muted">Nuestro Automoviles</h3>
                </div>
            </div>
            <div class="row">
                <?php 
                    for ($i = 0; $i <$result->num_rows; $i++) {
                        $result->data_seek($i);
                        $fila = $result->fetch_assoc();                     
                        $cont=$i+1;    
                        echo '<div class="col-md-4 col-sm-6 portfolio-item">';
                            echo '<a href="#portfolioModal'.$cont.'" class="portfolio-link" data-toggle="modal">';
                                echo '<div class="portfolio-hover">';
                                    echo '<div class="portfolio-hover-content">';
                                        echo '<i class="fa fa-plus fa-3x"></i>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<img src="/admin/galeria/'.$fila["ruta_foto"].'" class="img-responsive" alt="" style="height: 230px;"">';
                            echo '</a>';
                            echo '<div class="portfolio-caption hidden">';
                                echo '<h4>Round Icons</h4>';
                                echo '<p class="text-muted">Graphic Design</p>';
                            echo '</div>';
                        echo '</div>';                                            
                    }
                ?>                                                                          
            </div>
        </div>
    </section>

<?php
    mysqli_close($conexionPortafolio);
?>    