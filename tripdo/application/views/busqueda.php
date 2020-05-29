<!-- Heder  -->
<?php echo $header;	?>

    <!-- Offers -->
    <div class="offers">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title text-center">
                        <h2>Encuentra tu viaje ideal</h2>
                    </div>
                </div>
            </div>

            <!-- Campo de busqueda de viaje -->
            <div class="menu_search_form_container">
                <form action="<?= base_url('busqueda')?>" method="GET" id="menu_search_form">
                    <input type="search" value="<?= $keywords ?>" class="menu_search_input menu_mm" name="keywords">
                    <button id="menu_search_submit" class="menu_search_submit" type="submit">
                        <img src="<?= base_url()?>/public/images/search_2.png" alt="">
                    </button>
                </form>
            </div>

            <div class="row">
                <div class="col">
                    <div class="items item_grid clearfix">
                        <!-- muestra el listado de los resultados de la busqueda -->
                        <?php 
                            $a = 0;
                            foreach ($viajes as $v) {
                            $v->valoracion = (int) $v->valoracion;
                            $a ++;
                            if($a == 5){
                                $a = 1;
                            }
                        ?>

                        <div class="item clearfix rating_<?= $v->valoracion ?>">
                            <a href="<?= base_url('/viaje/ver/'.$v->id) ?>">
                                <div class="item_image">
                                    <img src="<?= base_url()?>public/images/top_<?= $a?>.jpg" alt="Imagen del viaje <?= $v->nombre ?>">
                                </div>
                                <div class="item_content">
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
                            </a>
                        </div>
                        <?php } ?>
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

            <?php if ( strcmp($keywords, "") != 0 && count($viajes) == 0) { ?>
                <div class="row">
                <div class="col">
                    <div class="section_title text-center">
                        <h4>No hemos encontrado resultados para tu búsqueda</h4>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>

<!-- Footer -->
<?php echo $footer;?>