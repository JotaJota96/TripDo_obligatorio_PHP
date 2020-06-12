
	<!-- Heder  -->
	<?php echo $header;	?>
	
		<!-- news -->
		<div class="news">
			<div class="container main">
			<!-- <?php echo validation_errors(); ?> -->
				<div class="row">
					<!-- News Posts -->
					<div class="col-lg-8">
						<div class="form_registro">
						<form action="<?= base_url('/registro/validate')?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<h2 class="col-md-9">Registro</h2>
							</div>							
							<div class="form-group row col-md-9 mx-auto">
								<label class="col-md-3" for="nickname">Nickname</label>
								<div class="col-md-9 mx-auto">
									<input type="text" class="form-control" id="ninckname" name="nickname" value="<?= $defNick?>">
									<span><?= form_error('nickname'); ?></span>	
								</div>																
							</div>
							
							<div class="form-group row col-md-9 mx-auto">
							<label class="col-md-3" for="contrasenia">Contraseña</label>
								<div class="col-md-9 mx-auto">
									<input type="password" class="form-control" id="contrasenia" name="contrasenia">
									<span><?= form_error('contrasenia'); ?></span>	
								</div>								
							</div>
							
							<div class="form-group row col-md-9 mx-auto">
								<label class="col-md-3" for="contrasenia2">Confirmar Contraseña</label>
								<div class="col-md-9 mx-auto">
									<input type="password" class="form-control" id="contrasenia2" name="contrasenia2">
									<span><?= form_error('contrasenia2'); ?></span>	
								</div>								
							</div>

							<div class="form-group row col-md-9 mx-auto">
								<label class="col-md-3" for="email">Correo</label>
								<div class="col-md-9 mx-auto">
									<input type="email" class="form-control" id="email" name="email" value="<?= $defEmail?>">	
									<span><?= form_error('email'); ?></span>	
								</div>																
							</div>

							<div class="form-group row col-md-9 mx-auto">
								<label class="col-md-3" for="nombre">Nombre</label>
								<div class="col-md-9 mx-auto">
									<input type="text" class="form-control" id="nombre" name="nombre" value="<?= $defNombre?>">
									<span><?= form_error('nombre'); ?></span>	
								</div>
							</div>
							
								<div class="form-group row col-md-9 mx-auto">
									<label class="col-md-3" for="apellido">Apellido</label>
									<div class="col-md-9 mx-auto">
										<input type="text" class="form-control" id="apellido" name="apellido" value="<?= $defApellido?>">
										<span><?= form_error('apellido'); ?></span>	
									</div>
								</div>

								<div class="form-group col-md-9 mx-auto row">
									<label class="col-md-3" for="telefono">Teléfono *</label>
									<div class="col-md-9 mx-auto">
										<input type="phone" class="form-control" id="telefono" name="telefono" value="<?= $defTel?>">
									</div>
								</div>

								<div class="form-group row col-md-9 mx-auto">
									<label class="col-md-3" for="biografia">Biografía *</label>
									<div class="col-md-9 mx-auto">
    									<textarea class="form-control" id="biografia" rows="4" name="biografia" ><?= $defBiog?></textarea>
									</div>
								</div>	

								<div class="form-group row col-md-9 mx-auto">
									<label class="col-md-3" for="foto">Foto *</label>
									<div class="col-md-9 ">
										<input type="file" accept="image/*" class="form-control-file" id="foto" name="photo">
										<span class="mt-2 text-danger"><?php echo $msgFoto; ?></span>
									</div>
								</div>	
								
								<div class="form-goup row">
									<div class="col-md-9 mx-auto">
										<button type="submit" class="_button btn-block" name="btnregistrar">Registrarse</button>
										
										<?php if(isset($exception)){ ?>
										<span><?=  $exception; ?></span>
										<?php } ?>
											
									</div>
								</div>

								<div class="form-group row col-md-9 mx-auto mt-2">
									<span class="text-muted">Los campos con * son opcionales.</span>
								</div>
							</form>
							
						</div>
					</div>

					<!-- Sidebar -->
					<div class="col-lg-4">
						<div class="sidebar">
							<img src="<?= base_url('/public/images/top_1.jpg')?>" alt="">
						</div>
					</div>

				</div>
			</div>
		</div>		

	<!-- Footer -->
	<?php echo $footer;?>


	
