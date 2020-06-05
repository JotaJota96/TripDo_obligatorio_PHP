<!-- Heder  -->
<?php echo $header;	?>

    <!-- Offers -->
    <div class="offers m-0">
        <div class="container">
            
           
            <div class="row">
                <div class="col">
                    <div class="items item_grid clearfix">
                        <!-- muestra el listado de los resultados de la busqueda -->
                        <?php 
                            foreach ($multiArray as $key => $viajes) {

                                if(strcmp($key, "duenio") == 0 && count($viajes)>0){
                                    echo "<h2>Viajes de los cuales eres dueño</h2><hr>";
                                }else if(strcmp($key, "viajero" ) == 0 && count($viajes)>0){
                                    echo "<h2>Viajes de los cuales eres viajero</h2><hr>";
                                }else if(strcmp($key, "colaborador") == 0 && count($viajes)>0){
                                    echo "<h2>Viajes de los cuales eres colaborador</h2><hr>";
                                }

                                foreach ($viajes as $v) {
                                    $v->valoracion = (int) $v->valoracion;
                        ?>

                        <div class="item clearfix rating_<?= $v->valoracion ?>">
                            <a href="<?= base_url('/viaje/ver/'.$v->id) ?>">
                                <div class="row">
                                    <div class="item_image col-12 col-md-4">
                                        <img src="<?= $v->imagen ?>" alt="Imagen del viaje <?= $v->nombre ?>">
                                    </div>
                                    <div class="item_content col-12 col-md-8">
                                        <div class="item_title"> <?= $v->nombre ?> </div>
                                        <div class="rating rating_<?= $v->valoracion ?>" data-rating="<?= $v->valoracion ?>">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        
                                        <div class="item_text">
                                            Organizado por: <?= $v->idUsuario ?>
                                        </div>
                                        
                                        <div class="item_text">
                                            <?= $v->descripcion ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php   
                                }
                            } 
                        ?>

                        
                    </div>
                </div>
            </div>
            <!-- Paginado -->
            <!--
            <div class="row">
                <div class="col">
                    <div class="pages">
                        <ul class="pages_list">
                            <li class="page active"><a href="#">01.</a></li>
                            <li class="page"><a href="#">02.</a></li>
                            <li class="page"><a href="#">03.</a></li>
                            <li class="page"><a href="#">04.</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            -->

        </div>
    </div>

<!-- Footer -->
<?php echo $footer;?>