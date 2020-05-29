	<!-- Heder  -->
	<?php echo $header;	?>
	
	<!-- news -->
	<div class="news">
		<div class="container">
			<div class="row">
				<!-- News Posts -->
				<div class="col-lg-7">
					<div class="news_posts">
						<!-- News Post -->

						<div class="news_post">
							<!-- Titulo -->
							<div class="post_title">
								<h2><?= $viaje->nombre ?></h2>
							</div>
							<!-- imagen -->
							<div class="post_image">
								<img src="<?= base_url()?>public/images/news_1.jpg">
								<a><div class="post_image_box text-center">+</div></a>
							</div>

							<!-- Botones de control -->
							<?php 
								if (strcmp($rol, "") != 0){ 
									$col_md = "col-md-6";
									if(strcmp($rol, "duenio") == 0) $col_md = "col-md-4";
							?>
							<div class="container p-1 m-0">
								<div class="justify-content-between row ">
									
									<!-- Sugerir Destino -->
									<div class="col-12 <?= $col_md ?> p-0 m-0">
										<div class="buttons">
											<div class="buttons_container">
												<div class="button button_1 elements_button" data-toggle="modal" data-target="#agregarDestino">Agregar destino</div>
											</div>
										</div>
									</div>

									<!-- Sugerir Plan -->
									<div class="col-12 <?= $col_md ?> p-0 m-0">
										<div class="buttons">
											<div class="buttons_container">
												<div class="button button_1 elements_button" data-toggle="modal" data-target="#agregarPlan">Agregar plan</div>
											</div>
										</div>
									</div>

									<?php if(strcmp($rol, "duenio") == 0){ ?>
									<!-- Administrar -->
									<div class="col-12 col-md-4 p-0 m-0">
										<div class="buttons">
											<div class="buttons_container">
												<div class="button button_1 elements_button" data-toggle="modal" data-target="#administracion">Administrar</div>
											</div>
										</div>
									</div>
									<?php } ?>

								</div>
							</div>
							<?php } ?>

							<hr>

							<!-- Listado de Destinos y planes -->
							<div class="post_text">
								<!-- Destinos -->
								<?php 
									if (count($log) > 0){
										foreach($destinos as $d){
											// modificar la linea para decidir si el destino ya fue votado por el usuario o no
											$mostrarVotarDestino = (strcmp($rol, "viajero") == 0 || strcmp($rol, "duenio") == 0 );
											$col_destino = "col-10";
											if ( ! $mostrarVotarDestino) $col_destino = "col-12";
								?>
								<div class="accordion_container">
									<div class="row p-0 m-0">
										<div class= "<?= $col_destino ?> p-0">
											<!-- Informacion del destino -->
											<div class="accordion d-flex flex-row align-items-center mt-1">
												Ciudad: <?= $d->ciudad ?>
												<br>
												País: <?= $d->pais ?>
											</div>
											<!-- Listado de Planes del destino -->
											<div class="accordion_panel p-0">
												<ul class="list-group">
													<!-- Planes -->
													<?php 
														foreach ($planes[$d->id] as $p){
															// Cambiar la linea siguiente y evaluar si el usuario ya voto el plan o no
															$mostrarVotarPlan = (strcmp($rol, "viajero") == 0 || strcmp($rol, "duenio") == 0 );
															$col_plan = "col-10";
															if ( ! $mostrarVotarPlan) $col_plan = "col-12";
													?>
													<li class="list-group-item ">
														<!-- Titulo del plan -->
														<H6><?= $p->nombre ?></H6>
														<div class="container">
															<div class="row justify-content-between">
																<!-- descripcion -->
																<div class="<?= $col_plan ?>">
																	<P class="pt-0"><?= $p->descripcion ?></P>
																	<a href="#">Ver en el mapa</a>
																</div>
																<?php if ($mostrarVotarPlan){ ?>
																<div class="col-2">
																	<a href="#">Votar</a>
																</div>
																<?php } ?>
															</div>
														</div>
													</li>
													<?php } ?>
												</ul>	
											</div>
										</div>
										<?php if ($mostrarVotarDestino){ ?>
										<!-- Boton para votar -->
										<div class= "col-2 p-0 m-0">
											<div class="buttons w-100">
												<div class="buttons_container  h-100 w-100">
													<div class="button button_1 elements_button d-flex align-content-center justify-content-center" >Votar</div>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
								<?php
										}
									}else{
								?>
								<h4 class="text-center">
										Este viaje aun no tiene destinos ni planes
								</h4>
								<?php } ?>

							</div>
						</div>
					</div>
				</div>

				<!-- Sidebar -->
				<div class="col-lg-5">
					<div class="sidebar">
						<!-- Featured Posts -->
						<div class="sidebar_featured">
							<div class="conteiner">
								<div class="row redesSociales">
									<div class="w-100 h-100 col text-right redSociales fb-share-button" 
										data-href="http://localhost/laboratorio-php/tripdo/" 
										data-layout="button_count">
									</div>
									<div class=" redSociales">
										<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="w-100 h-100 twitter-share-button" data-show-count="false">
											Tweet
										</a>
									</div>
								</div>
							</div>
						
							<!-- Featured Post -->
							<div class="sidebar_featured_post">
								<div class="tab_panels">
									<div class="sidebar_featured_image"><img src="<?= base_url()?>/public/images/mapa.png" alt=""></div>
								</div>

								<!-- Actividad reciente / log -->
								<div class="tabs_container">
									<div class="tabs d-flex flex-row align-items-center justify-content-around">
										<div class="tab log">Actividad reciente</div>
									</div>
									<div class="tab_panels">
										<div class="tab_panel log">
											<div class="tab_panel_content">
												<?php if (count($log) > 0){ ?>
												<ul class="list-group log-list">
													<?php 
														foreach ($log as $l){
															$elem = $l['elem'];

															$texto = "";
															$fecha = date('d/m/Y', strtotime($elem->fechaAgregado));

															if (strcmp($l['tipo'], 'destino') == 0){
																// pepe ha agregado un nuevo destino: Roma (Italia)
																$texto = "<b>$elem->agregadoPor</b> ha agregado un nuevo destino: <b>$elem->ciudad ($elem->pais)</b><br>$fecha";
															} elseif (strcmp($l['tipo'], 'plan') == 0){
																$texto = "<b>$elem->agregadoPor</b> ha agregado un nuevo plan: <b>$elem->nombre</b><br>$fecha";
															}
															
													?>
													<li class="list-group-item">
														<div class="row">
															<div class="col-1 my-2 d-flex align-content-center">
																<img src="<?= base_url()?>/public/images/news_1.jpg" width="30px" height="30px" class="rounded-circle">
															</div>
															<div class="col-11">
																<?= $texto ?>
															</div>
														</div>
													</li>
													<?php } ?>
												</ul>
												<?php }else{ ?>
													<div class="text-center">
														No hay actividad reciente
													</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>


	<!-- Ventanas emergentes -->
	<!-- Ventana modal Agregar Destino -->
	<div class="modal fade" id="agregarDestino" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar destino</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="exampleInputEmail1">Pais</label>
						<input class="form-control">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Ciudad</label>
						<input class="form-control">
					</div>

					<div class="modal-footer">
						<div class="buttons h-100 w-100">
							<div class="buttons_container h-100 w-100">
								<div class="button button_1 elements_button" data-toggle="modal">Guardar</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>

	<!-- Ventana modal Agregar Plan -->
	<div class="modal fade" id="agregarPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="exampleFormControlSelect1">Selecione el destino del plan</label>
						<select class="form-control" id="exampleFormControlSelect1">
							<option>Destino 1</option>
							<option>Destino 2</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Titulo del plan</label>
						<input class="form-control">
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Descripcion</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Latitud</label>
						<input class="form-control">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Longitud</label>
						<input class="form-control">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">¿Algun link para que podamos encontrar mas info?</label>
						<input class="form-control">
					</div>

					<div class="modal-footer">
						<div class="buttons h-100 w-100">
							<div class="buttons_container h-100 w-100">
								<div class="button button_1 elements_button" data-toggle="modal">Guardar</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>

	<!-- Ventana modal Administracion -->
	<div class="modal fade" id="administracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Administrar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>										
			</div>
			<div class="modal-body">
			<div class="tabs_container">
					<div class="tabs d-flex flex-row align-items-center justify-content-around">
						<div class="tab active">Viajeros</div>
						<div class="tab">Colaboradores</div>
						<div class="tab">Mas</div>
					</div>
					<div class="tab_panels">
						<div class="tab_panel active">
							<div class="tab_panel_content">
								<div class="menu_search_form_container" >
									<input type="search" class="menu_search_input menu_mm" value= "http://TripDo/viaje/873838" disabled>
								</div>	
								<br>
								<ul class="list-group">
									<li class="list-group-item">
										<img src="<?= base_url()?>/public/images/news_1.jpg" width="40px" height="40px" class="rounded-circle">
										Cras justo odio
									</li>
									<li class="list-group-item">
										<img src="<?= base_url()?>/public/images/news_1.jpg" width="40px" height="40px" class="rounded-circle">
										Cras justo odio
									</li>
									<li class="list-group-item">
										<img src="<?= base_url()?>/public/images/news_1.jpg" width="40px" height="40px" class="rounded-circle">
										Cras justo odio
									</li>
								</ul>	
								<p>¿Quieres invitar a alguien mas?</p> 
								<div class="container p-1 m-0">
									<div class="menu_search_form_container row">
										<div class="col-9 pt-2">
											<input type="email" class="form-control" class="menu_search_input menu_mm" >	
										</div>
										<div class="col-3  p-0 m-0">
											<div class="buttons_container w-75 h-75 p-0 m-0">
												<div class="pb-3 button button_1 elements_button" data-toggle="modal">Enviar</div>
											</div>
										</div>
									</div>
								</div>												
							</div>
						</div>
						<div class="tab_panel">
							<div class="tab_panel_content">
								<div class="menu_search_form_container" >
									<input type="search" class="menu_search_input menu_mm" value= "http://TripDo/viaje/873838" disabled>
								</div>	
								<br>
								<ul class="list-group">
									<li class="list-group-item">
										<img src="<?= base_url()?>/public/images/news_1.jpg" width="40px" height="40px" class="rounded-circle">
										Cras justo odio
									</li>
									<li class="list-group-item">
										<img src="<?= base_url()?>/public/images/news_1.jpg" width="40px" height="40px" class="rounded-circle">
										Cras justo odio
									</li>
									<li class="list-group-item">
										<img src="<?= base_url()?>/public/images/news_1.jpg" width="40px" height="40px" class="rounded-circle">
										Cras justo odio
									</li>
									<p>¿Quieres invitar a alguien mas?</p> 
									<div class="container p-1 m-0">
										<div class="menu_search_form_container row">
											<div class="col-9 pt-2">
												<input type="email" class="form-control" class="menu_search_input menu_mm" >	
											</div>
											<div class="col-3  p-0 m-0">
												<div class="buttons_container w-75 h-75 p-0 m-0">
													<div class="pb-3 button button_1 elements_button" data-toggle="modal">Enviar</div>
												</div>
											</div>
										</div>
									</div>
								</ul>		
							</div>
						</div>
						<div class="tab_panel">
							<div class="buttons m-5">
								<div class="buttons h-100 w-100">
									<div class="buttons_container h-100 w-100">
										<div class="button button_1 elements_button" data-toggle="modal">Guardar</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php echo $footer;?>