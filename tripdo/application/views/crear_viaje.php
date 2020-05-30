<!-- Header -->
<?php echo $header;	?>


<div class="news">
        <div class="container main">
            <div class="row">
                <!-- News Posts -->
                <div class="col-lg-8">
                    <div class="form_registro">
                        <form action="<?= base_url('crearViaje/validate')?>" method="POST" >
                            <div class="form-group row col-md-9 mx-auto">
                                <h2 class="col-md-9">Crear Nuevo Viaje</h2>
                            </div>

                            <div class="form-group row col-md-9 mx-auto">
                                <label class="col-md-3" for="nombreViaje">Nombre del viaje</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="nombreViaje" name="nombreViaje" value="<?= $defNombre?>">
                                    <span><?= form_error('nombreViaje'); ?></span>	
                                </div>																
                            </div>
                            
                            <div class="form-group row col-md-9 mx-auto">
                                <label class="col-md-3" for="descripcion">Descripción</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="5"><?= $defDescripcion?></textarea>
                                    <span><?= form_error('descripcion'); ?></span>	
                                </div>								
                            </div>  
                            
                            <div class="form-group row col-md-9 mx-auto">
                                <label class="col-md-3" for="linkImagen">URL de imagen</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="linkImagen" name="linkImagen" value="<?= $defLinkImagen?>">
                                    <span><?= form_error('linkImagen'); ?></span>	
                                </div>																
                            </div>
                            
                            <div class="form-group row col-md-9 mx-auto">
                                <label class="col-md-3" for="publico">Privacidad</label>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="form-check col-6 text-center">
                                            <input class="form-check-input" type="radio" name="publico" id="exampleRadios1" value="option1" checked>
                                            <label class="form-check-label py-0 px-1" for="publico">
                                                Privado
                                            </label>
                                        </div>
                                        <div class="form-check col-6 text-center">
                                            <input class="form-check-input" type="radio" name="publico" id="exampleRadios2" value="option2">
                                            <label class="form-check-label py-0 px-1" for="publico">
                                                Público
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-goup row">
                                <div class="col-md-9 mx-auto">
                                    <button type="submit" class="_button btn-block" name="btncrearViaje">Crear viaje</button>
                                </div>
                            </div>
                        </form>                        
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 mt-5 mt-md-0">
                    <div class="sidebar">
                        <img src="<?= base_url()?>/public/images/top_1.jpg" alt="">
                    </div>
                </div>

            </div>
        </div>
	</div>	

<!-- Footer -->
<?php echo $footer;?>