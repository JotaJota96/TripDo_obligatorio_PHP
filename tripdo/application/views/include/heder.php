<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?= base_url()?>/public/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url()?>/public/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/bootstrap4/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/main_styles.css">
</head>
<body>
    	<!-- Header -->
		<header class="header">
			<div class="container">
				<div class="row">
					<div class="col">
						<div
							class=" header_container fixed-top d-flex flex-row align-items-center justify-content-start">
							<!-- Logo -->
							<div class="logo_container ">
								<div class="logo">
									<div>TripDo</div>
									<div>travel agency</div>
									<div class="logo_image"><img src="<?= base_url()?>/public/images/logo.png" alt=""></div>
								</div>
							</div>

							<!-- Main Navigation -->
							<nav class="main_nav ml-auto ">
								<ul class="main_nav_list ">
									<li class="main_nav_item active"><a href="index.html">Inicio</a></li>
									<li class="main_nav_item"><a href="#">About us</a></li>
									<li class="main_nav_item"><a href="busqueda.html">Buscar</a></li>
									<li class="main_nav_item"><a href="viaje.html">Viaje</a></li>
									<li class="main_nav_item"><a href="#">Contact</a></li>
								</ul>
							</nav>
							<!-- Hamburger -->
							<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<!-- Menu -->
		<div class="menu_container menu_mm">

			<!-- Menu Close Button -->
			<div class="menu_close_container">
				<div class="menu_close"></div>
			</div>

			<!-- Menu Items -->
			<div class="menu_inner menu_mm">
				<div class="menu menu_mm">
					<div class="menu_search_form_container">
						<form action="#" id="menu_search_form">
							<input type="search" class="menu_search_input menu_mm">
							<button id="menu_search_submit" class="menu_search_submit" type="submit"><img
									src="<?= base_url()?>/public/images/search_2.png" alt=""></button>
						</form>
					</div>
					<ul class="menu_list menu_mm">
						<li class="menu_item menu_mm"><a href="#">Home</a></li>
						<li class="menu_item menu_mm"><a href="about.html">About us</a></li>
						<li class="menu_item menu_mm"><a href="offers.html">Offers</a></li>
						<li class="menu_item menu_mm"><a href="news.html">News</a></li>
						<li class="menu_item menu_mm"><a href="contact.html">Contact</a></li>
					</ul>

					<!-- Menu Social -->

					<div class="menu_social_container menu_mm">
						<ul class="menu_social menu_mm">
							<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-pinterest"
										aria-hidden="true"></i></a></li>
							<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-linkedin"
										aria-hidden="true"></i></a></li>
							<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-instagram"
										aria-hidden="true"></i></a></li>
							<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-facebook"
										aria-hidden="true"></i></a></li>
							<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-twitter"
										aria-hidden="true"></i></a></li>
						</ul>
					</div>

					<div class="menu_copyright menu_mm">Colorlib All rights reserved</div>
				</div>

			</div>

		</div>

        

	<script src="<?= base_url()?>/public/js/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url()?>/public/styles/bootstrap4/popper.js"></script>
	<script src="<?= base_url()?>/public/styles/bootstrap4/bootstrap.min.js"></script>
	<script src="<?= base_url()?>/public/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="<?= base_url()?>/public/plugins/easing/easing.js"></script>
	<script src="<?= base_url()?>/public/plugins/parallax-js-master/parallax.min.js"></script>
	<script src="<?= base_url()?>/publicp/lugins/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script src="<?= base_url()?>/public/js/custom.js"></script>
</body>
</html>