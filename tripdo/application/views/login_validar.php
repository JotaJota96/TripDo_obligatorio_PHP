<!-- Heder  -->
<?php echo $header;	?>

    <div class="news">
        <div class="container main">
        
            <div class="row">
                <!-- News Posts -->
                <div class="col-lg-8">
                    <div class="form_registro">
                        <form action="<?= base_url('loginValidar/validate')?>" method="POST" >
                            <div class="form-group row col-md-9 mx-auto">
                                <h2 class="col-md-9">Valída tu registro</h2>
                                <p class="col-md-9">Te hemos enviado un correo con el codigo de validacion a tu direccion de correo.</p>
                            </div>

                            <div class="form-group row col-md-9 mx-auto">
                                <label class="col-md-3" for="nickname">Ninckname</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="ninckname" name="nickname">
                                    <span><?= form_error('nickname'); ?></span>	
                                </div>																
                            </div>
                            
                            <div class="form-group row col-md-9 mx-auto">
                                <label class="col-md-3" for="contrasenia">Contraseña</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" id="contrasenia" name="contrasenia">
                                    <span><?= form_error('contrasenia'); ?></span>	
                                </div>								
                            </div>

                            <div class="form-group row col-md-9 mx-auto">
                                <label class="col-md-3" for="codigo">Código</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="codigo" name="codigo">
                                    <span><?= form_error('codigo'); ?></span>	
                                </div>								
                            </div>                          

                            <div class="form-group row col-md-9 mx-auto justify-content-center">
                                <?php if (isset($loginFailed) && $loginFailed){ ?>
                                <span class="text-danger text-center">Los datos ingresados son incorrectos, por favor vuelva a ingresarlos</span>	
                                <?php } ?>
                            </div>                        

                            <div class="form-goup row">
                                <div class="col-md-9 mx-auto">
                                    <button type="submit" name="login_validar" class="_button btn-block">Ingresar</button>
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