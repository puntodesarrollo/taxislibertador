<!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Servicios</h2>
                   
                </div>
            </div>
            <?
            $conexion1 = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
            $sql="SELECT * FROM servicios";
        
            $result = mysqli_query($conexion1,$sql);

            for ($i = 0; $i <$result->num_rows; $i++) {
            $result->data_seek($i);
            $fila = $result->fetch_assoc();
            
            echo '
            <div class="col-md-4 text-center">
                
                    <h4 class="service-heading">'.$fila["titulo"].'</h4>
                    <img class="img-responsive img-hover img-rounded" width="90%" src="/admin/servicios/'.$fila["imagen"].'">
                    <br>
                    <p class="text-muted">'.$fila["descripcion"].'</p>
                
                
            </div> ';
            }

            mysqli_close($conexion1);    

            ?>
        </div>
    </section>