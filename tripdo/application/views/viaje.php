<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="es">

<head>
<title>Destino</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Destino project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/bootstrap4/bootstrap.min.css">
	
	<link href="<?= base_url()?>/public/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/viaje_style.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/viaje_reponsive.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/elements_styles.css">
</head>

<body>
	<div class="super_container">



		<!-- Heder  -->
		<?php include("include/heder.php");?>

		<!-- news -->
		<div class="news">
			<div class="container">
				<div class="row">
					<!-- News Posts -->
					<div class="col-lg-7">
						<div class="news_posts">
							<!-- News Post -->

							<div class="news_post">
								<div class="post_title">
									<h2>Top destinations in Europe</h2>
								</div>

								<div class="post_image">
									<img src="<?= base_url()?>/public/images/news_1.jpg">

								</div>

								<!-- Buttons -->
								<div class="buttons">
									<div class="buttons_container">
										<div class="button button_1 elements_button"><a href="#">Administrar</a></div>
									</div>
								</div>
								<hr>
								<div class="post_text">
									<div class="accordions_content">

										<div class="accordion_container">
											<div class="accordion d-flex flex-row align-items-center"><div>Usuario: Destino</div></div>
											<div class="accordion_panel">
												<p>Plan para el siguiente destino</p>
											</div>
										</div>
										<div class="accordion_container">
											<div class="accordion d-flex flex-row align-items-center"><div>Usuario: Destino</div></div>
											<div class="accordion_panel">
												<p>Plan para el siguiente destino</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Sidebar -->
					<div class="col-lg-5">
						<div class="sidebar">
							<!-- Featured Posts -->
							<div class="sidebar_featured">|
								<!-- Featured Post -->
								<div class="sidebar_featured_post">
									<div class="tab_panels">
										<div class="sidebar_featured_image"><img src="<?= base_url()?>/public/images/mapa.png" alt=""></div>
									</div>

									<!-- Tabs -->
									<div class="tabs_container">
										<div class="tabs d-flex flex-row align-items-center justify-content-around">
											<div class="tab active">Log</div>
										</div>
										<div class="tab_panels">
											<div class="tab_panel active">
												<div class="tab_panel_content">
													<p>Lorem ipsum dolor sit amet,</p>
													<p>Lorem ipsum dolor sit amet,</p>
													<p>Lorem ipsum dolor sit amet,</p>
													<p>Lorem ipsum dolor sit amet,</p>
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

		<!-- Footer -->
		<?php include("include/footer.php");?>
		
	</div>

	<script src="<?= base_url()?>/public/js/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url()?>/public/styles/bootstrap4/popper.js"></script>
	<script src="<?= base_url()?>/public/styles/bootstrap4/bootstrap.min.js"></script>

	<script src="<?= base_url()?>/public/plugins/greensock/TweenMax.min.js"></script>
	<script src="<?= base_url()?>/public/plugins/greensock/TimelineMax.min.js"></script>
	<script src="<?= base_url()?>/public/plugins/scrollmagic/ScrollMagic.min.js"></script>
	<script src="<?= base_url()?>/public/plugins/greensock/animation.gsap.min.js"></script>
	<script src="<?= base_url()?>/public/plugins/greensock/ScrollToPlugin.min.js"></script>
	<script src="<?= base_url()?>/public/plugins/easing/easing.js"></script>
	<script src="<?= base_url()?>/public/plugins/progressbar/progressbar.min.js"></script>
	<script src="<?= base_url()?>/public/plugins/parallax-js-master/parallax.min.js"></script>

	<script src="<?= base_url()?>/public/js/elements_custom.js"></script>
	<script src="<?= base_url()?>/public/js/news_custom.js"></script>

</body>


</html>