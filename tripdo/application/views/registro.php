
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
						<form action="<?= base_url('registro/validate')?>" method="POST" >
							<div class="form-group">
								<h2 class="col-md-9">Registro</h2>
							</div>							
							<div class="form-group row col-md-9">
								<label class="col-md-3" for="nickname">Ninckname</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="ninckname" name="nickname">
									<span><?= form_error('nickname'); ?></span>	
								</div>																
							</div>
							
							<div class="form-group row col-md-9">
							<label class="col-md-3" for="contrasenia">Contraseña</label>
								<div class="col-md-9">
									<input type="password" class="form-control" id="contrasenia" name="contrasenia">
									<span><?= form_error('contrasenia'); ?></span>	
								</div>								
							</div>
							
							<div class="form-group row col-md-9">
								<label class="col-md-3" for="contrasenia2">Confirmar Contraseña</label>
								<div class="col-md-9">
									<input type="password" class="form-control" id="contrasenia2" name="contrasenia2">
									<span><?= form_error('contrasenia2'); ?></span>	
								</div>								
							</div>

							<div class="form-group row col-md-9">
								<label class="col-md-3" for="email">Correo</label>
								<div class="col-md-9">
									<input type="email" class="form-control" id="email" name="email">	
									<span><?= form_error('email'); ?></span>	
								</div>																
							</div>

							<div class="form-group row col-md-9">
								<label class="col-md-3" for="nombre">Nombre</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="nombre" name="nombre">
									<span><?= form_error('nombre'); ?></span>	
								</div>
							</div>
							
								<div class="form-group row col-md-9">
									<label class="col-md-3" for="apellido">Apellido</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="apellido" name="apellido">
										<span><?= form_error('apellido'); ?></span>	
									</div>
								</div>

								<div class="form-group col-md-9 row">
									<label class="col-md-3" for="telefono">Teléfono</label>
									<div class="col-md-9">
										<input type="phone" class="form-control" id="telefono" name="telefono">
									</div>
								</div>

								<div class="form-group row col-md-9">
									<label class="col-md-3" for="biografia">Biografía</label>
									<div class="col-md-9">
    									<textarea class="form-control" id="biografia" rows="4"></textarea>
									</div>
								</div>	

								<div class="form-group row col-md-9">
									<label class="col-md-3" for="foto">Subir Foto</label>
									<div class="col-md-9">
										<input type="file" class="form-control-file" id="foto">
									</div>
								</div>						
								<div class="form-goup row">
									<div class="col-md-9">
										<button type="submit" class="_button btn-block">Registrarse</button>
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
	<?php echo $_SERVER['REQUEST_URI']; ?>
	<!-- Footer -->
	<?php echo $footer;?>


	
