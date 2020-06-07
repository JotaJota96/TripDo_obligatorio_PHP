
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="es">


<head>
	<title><?php echo $title ?></title>
	<?php
		if(isset($mapa)){
	?>
	<!-- Links para mapbox -->
	<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
    <!-- Links para Geocoder -->
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />
	<!-- Links para Buscar Rutas -->
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.css' type='text/css'/>   
	
	<meta property="og:url"           content="https://www.your-domain.com/your-page.html" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Your Website Title" />
	<meta property="og:description"   content="Your description" />
	<meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />
	<?php
		}
	?>

	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Registro de usuario">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="<?= base_url('/public/styles/bootstrap4/bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('/public/plugins/font-awesome-4.7.0/css/font-awesome.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('/public/styles/main_styles.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('/public/styles/elements_styles.css')?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url('/public/styles/'. $style)?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('/public/styles/'. $responsive)?>">
	<script>
		
	</script>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  
	<script>
		function myFunction(x) {
			x.classList.toggle("fa-thumbs-down");
		}
	</script>
	
	<!-- Header -->
	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div id="menu-superior" class=" header_container fixed-top d-flex flex-row align-items-center justify-content-start">
						<!-- Logo -->
						<div class="logo_container ">
                            <a href="<?= base_url() ?>">
                                <div class="logo">
                                    <div>TripDo</div>
                                    <div>Planea tu viaje</div>
                                    <div class="logo_image"><img src="<?= base_url('/public/images/logo.png')?>" alt=""></div>
                                </div>
                            </a>
						</div>

						<!-- Main Navigation -->
						<nav class="main_nav ml-auto pr-5">
							<ul class="main_nav_list ">

								<?php foreach($main_menu['opciones'] as $item): ?>
								<li class="main_nav_item">
									<a href="<?= $item['url'] ?>"><?= $item['title'] ?></a>
								</li>
								<?php endforeach ?>			
								<?php 
									if (array_key_exists("usuario", $main_menu)) { 
										$item = $main_menu['usuario'];
								?>
								<li class="main_nav_item">
									<a href="<?= $item['url'] ?>">
										<strong><?= $item['nickname'] ?></strong>
										<img src="<?= base_url("public/perfiles/" . $item['nickname'])?>"
											width="30px" height="30px" class="rounded-circle">
									</a>
								</li>
								<?php } ?>
							</ul>
						</nav>

						<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Menu aside -->
	<div class="menu_container menu_mm" style="background-color:rgb(14, 14, 31);color: rgb(255, 255, 255);">
		
		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="container">
				<div class="row">
					<div class=" header_container fixed-top d-flex flex-row align-items-center justify-content-start">
						<!-- Logo -->
						<div class="logo_container ">
							<a href="<?= base_url() ?>">
								<div class="logo">
									<div>TripDo</div>
									<div>Planea tu viaje</div>
									<div class="logo_image"><img src="<?= base_url('/public/images/logo.png')?>" alt=""></div>
								</div>
							</a>
						</div>
						<!-- Menu Close Button -->
						<div class="menu_close_container">
							<div class="menu_close"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="menu menu_mm">
					
						<ul class="menu_list menu_mm">
							<?php foreach($main_menu['opciones'] as $item): ?>
							<li class="mobile-menu-item menu_mm">
								<a href="<?= $item['url'] ?>" style="color: rgb(255, 255, 255);"><?= $item['title'] ?></a>
							</li>
							<?php endforeach ?>
							
							<?php 
								if (array_key_exists("usuario", $main_menu)) { 
									$item = $main_menu['usuario'];
							?>
							<li class="menu_item menu_mm text-center">
								<br><br>
								<a href="<?= $item['url'] ?>" style="color: rgb(202, 202, 202);">
									<img src="<?= base_url("public/perfiles/" . $item['nickname'])?>"
										width="60px" height="60px" class="rounded-circle">
									<br>
									<?= $item['nickname'] ?>
								</a>
							</li>
							<?php } ?>
						</ul>
						
						<div class="menu_copyright menu_mm">TripDo todos los derechos reservados.</div>
					</div>
				</div>
			</div>
		</div>
	</div>

        
