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
                                <label class="col-md-3" for="nombreViaje">Nombre del Viaje</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="nombreViaje" name="nombreViaje">
                                    <span><?= form_error('nombreViaje'); ?></span>	
                                </div>																
                            </div>
                            
                            <div class="form-group row col-md-9 mx-auto">
                                <label class="col-md-3" for="descripcion">Descripción</label>
                                <div class="col-md-9">
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="5"></textarea>
                                    <span><?= form_error('descripcion'); ?></span>	
                                </div>								
                            </div>  
                            
                            <div class="form-group row col-md-9 mx-auto">
                                <div class="form-check col-md-4"></div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Privado
                                    </label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Público
                                    </label>
                                </div>
                                  
                            </div>                                      
                            <div class="form-check col-md-3"></div>               
                            <div class="form-goup row">
                                <div class="col-md-9 mx-auto">
                                    <button type="submit" class="_button btn-block">Crear Vieja</button>
                                </div>
                            </div>
                        </form>                        
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <img src="<?= base_url()?>/public/images/top_1.jpg" alt="">
                    </div>
                </div>

            </div>
        </div>
	</div>	

<!-- Footer -->
<?php echo $footer;?>