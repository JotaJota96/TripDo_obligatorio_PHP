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

	<link href="<?= base_url()?>/public/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url()?>/public/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/bootstrap4/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/inex_style.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/index_reponsive.css">

</head>

<body>
	<div class="super_container">


		<!-- Heder  -->
		<?php include("include/heder.php");?>

		<!-- Home -->
		<div class="home">
			<div class="home_background" style="background-image:url(<?= base_url()?>/public/images/home.jpg)"></div>
			<div class="home_content">
				<div class="home_content_inner">
					<div class="home_text_large">TRIPDO</div>
					<div class="home_text_small">Discover new worlds</div>
				</div>
			</div>
		</div>
		
		<!-- Popular -->
		<div class="popular">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="section_title text-center">
							<h2>Destinos populares</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div
							class="popular_content d-flex flex-md-row flex-column flex-wrap align-items-md-center align-items-start justify-content-md-between justify-content-start">

							<!-- Popular Item -->
							<div class="popular_item">
								<a href="offers.html">
									<img src="<?= base_url()?>/public/images/popular_1.jpg" alt="image by Egzon Bytyqi">
									<div class="popular_item_content">
										<div class="popular_item_title">Turkey</div>
									</div>
								</a>
							</div>

							<!-- Popular Item -->
							<div class="popular_item">
								<a href="offers.html">
									<img src="<?= base_url()?>/public/images/popular_2.jpg" alt="https://unsplash.com/@michael75">
									<div class="popular_item_content">
										<div class="popular_item_title">Hawai</div>
									</div>
								</a>
							</div>

							<!-- Popular Item -->
							<div class="popular_item">
								<a href="offers.html">
									<img src="<?= base_url()?>/public/images/popular_3.jpg" alt="https://unsplash.com/@sapegin">
									<div class="popular_item_content">
										<div class="popular_item_title">Ireland</div>
									</div>
								</a>
							</div>

							<!-- Popular Item -->
							<div class="popular_item">
								<a href="offers.html">
									<img src="<?= base_url()?>/public/images/popular_4.jpg" alt="https://unsplash.com/@kensuarez">
									<div class="popular_item_content">
										<div class="popular_item_title">Thailand</div>
									</div>
								</a>
							</div>

							<!-- Popular Item -->
							<div class="popular_item">
								<a href="offers.html">
									<img src="<?= base_url()?>/public/images/popular_5.jpg" alt="https://unsplash.com/@noahbasle">
									<div class="popular_item_content">
										<div class="popular_item_title">Croatia</div>
									</div>
								</a>
							</div>

							<!-- Popular Item -->
							<div class="popular_item">
								<a href="offers.html">
									<img src="<?= base_url()?>/public/images/popular_6.jpg" alt="https://unsplash.com/@seb">
									<div class="popular_item_content">
										<div class="popular_item_title">Bali</div>
									</div>
								</a>
							</div>

							<!-- Popular Item -->
							<div class="popular_item">
								<a href="offers.html">
									<img src="<?= base_url()?>/public/images/popular_7.jpg" alt="https://unsplash.com/@nevenkrcmarek">
									<div class="popular_item_content">
										<div class="popular_item_title">France</div>
									</div>
								</a>
							</div>

							<!-- Popular Item -->
							<div class="popular_item">
								<a href="offers.html">
									<img src="<?= base_url()?>/public/images/popular_8.jpg" alt="https://unsplash.com/@bergeryap87">
									<div class="popular_item_content">
										<div class="popular_item_title">Vietnam</div>
									</div>
								</a>
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
	<script src="<?= base_url()?>/public/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="<?= base_url()?>/public/plugins/easing/easing.js"></script>
	<script src="<?= base_url()?>/public/plugins/parallax-js-master/parallax.min.js"></script>
	<script src="<?= base_url()?>/publicp/lugins/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script src="<?= base_url()?>/public/js/custom.js"></script>
</body>

</html>