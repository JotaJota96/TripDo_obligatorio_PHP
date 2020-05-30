<!-- Heder  -->
<?php echo $header;	?>

    <div class="news">
        <div class="container main">
        
            <div class="row">
                <!-- News Posts -->
                <div class="col-lg-8">
                    <div class="form_registro">
                        <form action="<?= base_url('login/validate')?>" method="POST" >
                            <div class="form-group row col-md-9 mx-auto">
                                <h2 class="col-md-9">Iniciar Sesión</h2>
                            </div>

                            <div class="form-group row col-md-9 mx-auto">
                                <label class="col-md-3" for="nickname">Nickname o Correo</label>
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

                            <div class="form-group row col-md-9 mx-auto justify-content-center">
                                <?php if (isset($loginFailed) && $loginFailed){ ?>
                                <span class="text-danger text-center"><?= "El usuario o la contraseña son incorrectos" ?></span>	
                                <?php } ?>
                            </div>                        

                            <div class="form-goup row">
                                <div class="col-md-9 mx-auto">
                                    <button type="submit" name="login" class="_button btn-block">Ingresar</button>
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