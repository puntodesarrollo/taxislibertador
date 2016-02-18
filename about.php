<!-- About Section -->
    <section id="about">
        <div class="container">
            <?
            $conexion2=include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
    
            $sql="SELECT * FROM about ";

            $result = mysqli_query($conexion2,$sql);
            
            if($result===false || $result->num_rows===0)
            {
                header("location:/admin/about.php");
            }
            
            for ($i = 0; $i <$result->num_rows; $i++) {
                $result->data_seek($i);
                $fila = $result->fetch_assoc();
                
                $texto1=$fila["quienes"];
                $texto2=$fila["history"];
                
            }
            mysqli_close($conexion2);    
            echo '
            <div class="row text-center" style="text-align: justify; text-justify: inter-word !important">
                <div class="col-md-6">
                    <h3 class="section-heading text-center">Quiénes Somos</h3>
                    <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                    <br>'.$texto1.'
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="section-heading text-center">Nuestra Historia</h3>
                    <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <br>'.$texto2.'
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
            </div> ';
            ?>
        </div>
    </section>