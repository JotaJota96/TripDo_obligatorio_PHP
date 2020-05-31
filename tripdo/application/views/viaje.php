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
								<img src="<?= $viaje->imagen ?>">
								<?php if (strcmp($rol, "") != 0){  ?>
								<form action="<?= base_url('/viaje/copiar') ?>" method="POST">
									<input type="hidden" name="idViaje" value="<?= $id ?>" >
									<button type="submit" name="copiarViaje" class="boton-copiar text-center p-0 px-1">Copiar</button>
								</form>
								<?php } ?>
	                        </div>

	                        <!-- Botones de control -->
	                        <?php
								if ( !$viaje->realizado && strcmp($rol, "") != 0){ 
									$col_md = "col-md-6";
									if(strcmp($rol, "duenio") == 0) $col_md = "col-md-4";
							?>
	                        <div class="container p-1 m-0">
	                            <div class="justify-content-between row ">

	                                <!-- Sugerir Destino -->
	                                <div class="col-12 <?= $col_md ?> p-0 m-0">
	                                    <div class="buttons">
	                                        <div class="buttons_container">
	                                            <div class="button button_1 elements_button" data-toggle="modal"
	                                                data-target="#agregarDestino">Sugerir destino</div>
	                                        </div>
	                                    </div>
	                                </div>

	                                <!-- Sugerir Plan -->
	                                <div class="col-12 <?= $col_md ?> p-0 m-0">
	                                    <div class="buttons">
	                                        <div class="buttons_container">
	                                            <div class="button button_1 elements_button" data-toggle="modal"
	                                                data-target="#agregarPlan">Sugerir plan</div>
	                                        </div>
	                                    </div>
	                                </div>

	                                <?php if(strcmp($rol, "duenio") == 0){ ?>
	                                <!-- Administrar -->
	                                <div class="col-12 col-md-4 p-0 m-0">
	                                    <div class="buttons">
	                                        <div class="buttons_container">
	                                            <div class="button button_1 elements_button" data-toggle="modal"
	                                                data-target="#administracion">Administrar</div>
	                                        </div>
	                                    </div>
	                                </div>
									<?php } ?>
	                            </div>
	                        </div>
	                        <?php } ?>

							<?php if ($permitirCalificar && $viaje->realizado && (strcmp($rol, "duenio") == 0 || strcmp($rol, "viajero") == 0)){ ?>
	             	           <div class="container p-1 m-0">
	                         	   <div class="justify-content-between row ">
										<!-- Calificar viaje -->
										<div class="col-12 p-0">
											<div class="buttons">
												<div class="buttons_container">
													<div class="button button_1 elements_button" data-toggle="modal"
														data-target="#calificarViaje">Calificar viaje</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
	                        <hr>
							
	                        <div class="container p-1 m-0">
	                            <div class="justify-content-between row ">
									<h6 class="col-12">Descripción:</h6>
									<p class="col-12"><?= $viaje->descripcion ?></p>
								</div>
							</div>

							<hr>
							
	                        <!-- Listado de Destinos y planes -->
	                        <div class="post_text">
	                            <!-- Destinos -->
	                            <?php 
									if (count($destinos) > 0){
									?>
										<div class="form-goup row">
											<div class="col-md-12 mx-auto m-0 pr-1">
												<button onclick="verTodos()" class="_button btn-block m-0 p-0">Ver todos los marcadores</button>
											</div>
										</div>
									<?php 		
										foreach($destinos as $d){
											// modificar la linea para decidir si el destino ya fue votado por el usuario o no
											$mostrarVotarDestino = (strcmp($rol, "viajero") == 0 || strcmp($rol, "duenio") == 0 );
											$col_destino = "col-10";
											if ( ! $mostrarVotarDestino) $col_destino = "col-12";
								?>
								
	                            <div class="accordion_container">
	                                <div class="row p-0 m-0">
	                                    <div class="<?= $col_destino ?> p-0">
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
																	<?php if (isset($p->link) && strcmp($p->link, "") != 0) { ?>
																	<a href="<?= $p->link ?>">Más información</a>
																	<br>
																	<?php } ?>
	                                                                <a  href="javascript:verMarcador(<?= $p->longitud.",".$p->latitud;?>)">Ver en el mapa</a>
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
	                                                <?php if (count($planes[$d->id]) == 0) { ?>
	                                                <li class="list-group-item text-center">
	                                                    No hay planes para este destino
	                                                </li>
	                                                <?php } ?>
	                                            </ul>
	                                        </div>
	                                    </div>
	                                    <?php if ($mostrarVotarDestino){ ?>
	                                    <!-- Boton para votar -->
	                                    <div class="col-2 p-0 m-0">
	                                        <div class="buttons w-100">
	                                            <div class="buttons_container  h-100 w-100">
	                                                <div
	                                                    class="button button_1 elements_button d-flex align-content-center justify-content-center">
	                                                    Votar</div>
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
	                                    data-href="http://localhost/laboratorio-php/tripdo/" data-layout="button_count">
	                                </div>
	                                <div class=" redSociales">
	                                    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
	                                        class="w-100 h-100 twitter-share-button" data-show-count="false">
	                                        Tweet
	                                    </a>
	                                </div>
	                            </div>
	                        </div>

	                        <!-- Featured Post -->
	                        <div class="sidebar_featured_post">
	                            <div id="map-div-container" class="tab_panels">
	                                <!-- mapa -->
	                                <div id="map" style='width: 100%; height: 300px;'>
	                                </div>
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
																// pepe ha sugerido un nuevo destino: Roma (Italia)
																$texto = "<b>$elem->agregadoPor</b> ha sugerido un nuevo destino: <b>$elem->ciudad ($elem->pais)</b><br>$fecha";
															} elseif (strcmp($l['tipo'], 'plan') == 0){
																$texto = "<b>$elem->agregadoPor</b> ha sugerido un nuevo plan: <b>$elem->nombre</b><br>$fecha";
															}
															
													?>
	                                                <li class="list-group-item">
	                                                    <div class="row">
	                                                        <div class="col-1 my-2 d-flex align-content-center">
	                                                            <img src="<?= base_url("public/perfiles/" . $elem->agregadoPor)?>"
	                                                                width="30px" height="30px" class="rounded-circle">
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

	<!-- Ventana modal Sugerir Destino -->
	<div class="modal fade" id="agregarDestino" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	    aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Sugerir destino</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	                <form action="<?= base_url('viaje/sugerirDestino') ?>" method="POST">
	                    <div class="form-group">
	                        <label for="Pais">País</label>
	                        <input name="Pais" class="form-control">
	                    </div>
	                    <div class="form-group">
	                        <label for="Ciudad">Ciudad</label>
	                        <input name="Ciudad" class="form-control">
	                    </div>
	                    <div class="form-group">
	                        <label for="Tags">Tags:</label>
	                        <input name="Tags" class="form-control">
	                        <small>Ingrese los tags separados por coma (,)</small>
	                    </div>
	                    <input type="hidden" id="idViaje" name="idViaje" value="<?= $id ?>">
	                    <div class="form-goup row">
	                        <div class="col-md-12 mx-auto">
	                            <button type="submit" name="btnAgregarDestino" class="_button btn-block">Enviar sugerencia</button>
	                        </div>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Ventana modal Sugerir Plan -->
	<div class="modal fade" id="agregarPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	    aria-hidden="true">
	    <div class="modal-dialog">												
	        <div class="modal-content">
				<div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Sugerir Plan</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
					<form action="<?= base_url('viaje/sugerirPlan') ?>" method="POST">
	                    <div class="conteiner">
	                        <div class="row">
	                            <div class="col-12 col-md-6">
									<!-- Drop down de destinos-->
	                                <div class="form-group">
	                                    <label for="exampleFormControlSelect1">Selecione el destino</label>
	                                    <select name="idDestino" class="form-control" id="SelectDestinos">
	                                        <?php 
											foreach($destinos as $d){
										?>
	                                        <option value="<?= $d->id ?>"> <?=" $d->ciudad ($d->pais)"?> </option>
	                                        <?php 
											}
										?>
	                                    </select>
	                                </div>
	                                <div class="form-group">
	                                    <label for="titulo">Título del plan</label>
	                                    <input name="titulo" class="form-control">
	                                </div>
	                                <div class="form-group">
	                                    <label for="descripcion">Descripción</label>
	                                    <textarea name="descripcion" class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
	                                </div>
	                                <div class="form-group">
	                                    <label for="link">¿Algún link para encontrar más info?</label>
	                                    <input name="link" class="form-control">
	                                </div>

									<!-- campos ocultos para coordenadas del mapa -->
									<input type="hidden"  id="input-latitud"  name="latitud"  value="0">
									<input type="hidden"  id="input-longitud" name="longitud" value="0">
									
									<!-- campo oculto para el ID del viaje-->
									<input type="hidden" name="idViaje" value="<?= $id ?>">
								</div>
								<!-- div para el mapa -->
	                            <div class="col-12 col-md-6">
									<label>Ubicación en el mapa</label>
	                                <div id='map2' class="m-1 p-0" style='width: 40; height: 300px;'>
	                                </div>
									<pre id='coordenadas2'></pre>
	                            </div>
	                        </div>
	                    </div>
						<div class="form-goup row">
	                        <div class="col-md-12 mx-auto">
	                            <button type="submit" name="btnSugerirPlan" class="_button btn-block">Enviar sugerencia</button>
	                        </div>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Ventana modal Administracion -->
	<div class="modal fade" id="administracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	    aria-hidden="true">
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
	                        <div class="tab">Más</div>
	                    </div>
	                    <div class="tab_panels">
	                        <div class="tab_panel active">
	                            <div class="tab_panel_content">
	                                <div class="menu_search_form_container">
										<label>Comparte este enlace para agregar viajeros</label>
	                                    <input type="search" class="menu_search_input menu_mm"
	                                        value="<?= $linkAgregarViajero ?>" disabled>
	                                </div>
	                                <br>
	                                <?php 
									foreach($viajeros as $v){
								?>
	                                <ul class="list-group">
	                                    <li class="list-group-item">
	                                        <img src="<?= base_url("public/perfiles/" . $v->nickname)?>" width="40px" height="40px"
	                                            class="rounded-circle">
	                                        <?="$v->nombre $v->apellido ($v->nickname)"?>
	                                    </li>
	                                </ul>
	                                <?php 
									}
								?>
	                                <hr>
	                                <p>Enviar invitacion por correo</p>
	                                <div class="container p-1 m-0">
										<form action="<?= base_url('/viaje/enviarInvitacion') ?>" method="POST">
											<div class="menu_search_form_container row">
												<div class="col-9 pt-2">
													<input type="email" name="destinatario" placeholder="ejemplo@email.com" class="form-control" >
												</div>
												<input type="hidden" name="enlace" value="<?= $linkAgregarViajero ?>">
												<input type="hidden" name="id" value="<?= $id ?>">
												<div class="col-3  p-0 m-0">
													<div class="buttons_container w-75 h-75 p-0 m-0">
														<button type="submit" name="btnEnviarInvitacion" class="_button btn-block">Enviar</button>
													</div>
												</div>
											</div>
										</form>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="tab_panel">
	                            <div class="tab_panel_content">
	                                <div class="menu_search_form_container">
										<label>Comparte este enlace para agregar colaboradores</label>
	                                    <input type="search" class="menu_search_input menu_mm"
	                                        value="<?= $linkAgregarColaborador ?>" disabled>
	                                </div>
	                                <br>
	                                <ul class="list-group">
	                                    <?php 
										foreach($colaboradores as $c){
									?>
	                                    <li class="list-group-item">
	                                        <img src="<?= base_url("public/perfiles/" . $c->nickname)?>" width="40px" height="40px"
	                                            class="rounded-circle">
	                                        <?="$c->nombre $c->apellido ($c->nickname)"?>
	                                    </li>
	                                    <?php 
										}
									?>
	                                    <hr>
	                                    <p>Enviar invitacion por correo</p>
	                                    <div class="container p-1 m-0">
											<form action="<?= base_url('/viaje/enviarInvitacion') ?>" method="POST">
												<div class="menu_search_form_container row">
													<div class="col-9 pt-2">
														<input type="email" name="destinatario" placeholder="ejemplo@email.com" class="form-control">
													</div>
													<input type="hidden" name="enlace" value="<?= $linkAgregarColaborador ?>">
													<input type="hidden" name="id" value="<?= $id ?>">
													<div class="col-3  p-0 m-0">
														<div class="buttons_container w-75 h-75 p-0 m-0">
															<button type="submit" name="btnEnviarInvitacion" class="_button btn-block">Enviar</button>
														</div>
													</div>
												</div>
											</form>
	                                    </div>
	                                </ul>
	                            </div>
	                        </div>
	                        <div class="tab_panel">
	                            <div class="buttons m-5">
									<form action="<?= base_url('viaje/marcarComoRealizado') ?>" method="POST">
										<input type="hidden" id="idViaje" name="idViaje" value="<?= $id ?>">
										<div class="form-goup row">
											<div class="col-md-12 mx-auto">
												<button type="submit" name="btnMarcarComoRealizado" class="_button btn-block">Marcar como realizado</button>
											</div>
										</div>
									</form>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Ventana modal Calificar -->
	<div class="modal fade" id="calificarViaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	    aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleModalLabel">Calificar Viaje</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	                <form action="<?= base_url('viaje/calificarViaje') ?>" method="POST">
	                    <div class="form-group">
	                        <label class="form-control" for="calificacion" id="labelid">Valoracion: 5 estrellas</label>
	                        <input name="calificacion" type="range" max="5" min="1" step="1" value="5" id="slider" class="form-control-range w-100" onchange="actualizarSlider(this.value)" >
						</div>
						
						<div class="form-group">
							<label for="texto">Comentarios sobre el viaje</label>
							<textarea name="texto" class="form-control" rows="1"></textarea>
						</div>
						<input type="hidden" name="id" value="<?= $id ?>">

	                    <div class="form-goup row">
	                        <div class="col-md-12 mx-auto">
	                            <button type="submit" name="btnCalificarViaje" class="_button btn-block">Calificar</button>
	                        </div>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
						
	<!-- Footer -->
	<script>
		//esto actualiza el valor del label valoracion 5 estrellas, en el model calificar
		function actualizarSlider(val){
			document.getElementById("labelid").innerHTML = "Valoracion: "+val+" estrellas";
		}

		var longitud = -56.732051948450575;
		var latitud = -34.33235873819117;
		var zoom = 5;
		var markerModal;
		var markerMapaPrincipal;

		// Crea el mapa principal
		mapboxgl.accessToken = 'pk.eyJ1IjoidHJpcGRvIiwiYSI6ImNrYWpuOG5iYTAzeDEycG4xcTg0Y2N0YjMifQ.iZfqiqKWwbtqynAoSICDEw';
		var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v11',
			antialias: true,
			center: [longitud, latitud],
			zoom: zoom
		});
		
		// Crea el mapa del modal
		var map2 = new mapboxgl.Map({
			container: 'map2',
			style: 'mapbox://styles/mapbox/streets-v11',
			antialias: true,
			center: [longitud, latitud],
			zoom: 8
		});

		//Capturar las coordenadas del puntero del raton
		map2.on('click', function (e) {          
			document.getElementById('input-latitud').value = e.lngLat.lat;
			document.getElementById('input-longitud').value = e.lngLat.lng;
			if(markerModal != null){
				markerModal.remove();
			}                
			markerModal = new mapboxgl.Marker({draggable: false}).setLngLat([e.lngLat.lng, e.lngLat.lat])                            
						.addTo(map2);                               
		});

		// Agrega un marcador al hacer click en "ver en el mapa"
		function verMarcador(longitud, latitud){
			if(markerMapaPrincipal != null){
				markerMapaPrincipal.remove();
			}                
			markerMapaPrincipal = new mapboxgl.Marker({draggable: false}).setLngLat([longitud, latitud])                            
						.addTo(map); 
			map.setCenter([longitud, latitud]);
			map.setZoom(12);
			// esto scrolea la pagina hasta mostrar el mapa pero el menu lo tapa y queda feo
			//document.getElementById('map-div-container').scrollIntoView();
		}



		function verTodos(){
			<?php 
			foreach($destinos as $d){
				foreach ($planes[$d->id] as $p){
					?>
					verTodosLosMarcadores(<?= $p->longitud.",".$p->latitud ?>);
					<?php 
				}
			}
			?>
		}

		function verTodosLosMarcadores(longitud, latitud){
			if(markerMapaPrincipal != null){
				markerMapaPrincipal.remove();
			}    
			            
			let marker = new mapboxgl.Marker({draggable: false}).setLngLat([longitud, latitud])                            
						.addTo(map); 
			map.setCenter([0,0]);
			map.setZoom(0);
		}

		//Agrega el cuadro de buscar en el mapa principal
		map.addControl(
			new MapboxGeocoder({
				accessToken: mapboxgl.accessToken,
				localGeocoder: forwardGeocoder,
				zoom: 14,
				placeholder: 'Buscar ciudad',
				mapboxgl: mapboxgl
			})
		);
		
		// Agrega el cuadro de busqueda en el mapa del modal
		map2.addControl(
			new MapboxGeocoder({
				accessToken: mapboxgl.accessToken,
				localGeocoder: forwardGeocoder,
				zoom: 14,
				placeholder: 'Buscar ciudad',
				mapboxgl: mapboxgl
			})
		);

		//Agregar controles al mapa con geolocalización y la opcion de pantalla completa
		map.addControl(new mapboxgl.NavigationControl());
		map.addControl(new mapboxgl.FullscreenControl());
		
	</script> 

	<?php echo $footer;?>