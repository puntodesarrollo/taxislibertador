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
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Quienes Somos</h2>
                    <h3 class="section-subheading text-muted">'.$texto1.'</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Nuestra Historia</h2>
                    <h3 class="section-subheading text-muted">'.$texto2.'</h3>
                </div>
            </div> ';
            ?>
        </div>
    </section>