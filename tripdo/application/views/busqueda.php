<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Offers</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Destino project">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="<?= base_url()?>/public/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url()?>/public/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/plugins/OwlCarousel2-2.2.1/animate.css">
	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/bootstrap4/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/busqueda_style.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/styles/busqueda_reponsive.css">
	
</head>

<body>
	<div class="super_container">

		<!-- Heder  -->
		<?php include("include/heder.php");?>

		<!-- Offers -->
		<div class="offers">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="section_title text-center">
							<h2>Top destinations in Europe</h2>
						</div>
					</div>
				</div>

				<div class="menu_search_form_container">
					<form action="#" id="menu_search_form">
						<input type="search" class="menu_search_input menu_mm">
						<button id="menu_search_submit" class="menu_search_submit" type="submit"><img
								src="<?= base_url()?>/public/images/search_2.png" alt=""></button>
					</form>
				</div>

				<div class="row">
					<div class="col">
						<div class="items item_grid clearfix">

							<!-- Item -->
							<div class="item clearfix rating_5">
								<div class="item_image"><img src="<?= base_url()?>/public/images/top_1.jpg" alt=""></div>
								<div class="item_content">
									<div class="item_title">Paris, France</div>
									<div class="rating rating_5" data-rating="5">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
									<div class="item_text">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit.
										Fusce fringilla lectus nec diam auctor, ut fringilla diam sagittis. Quisque vel
										est id justo faucibus dapibus id a nibh. Aenean suscipit consequat lacus, sit
										amet mollis nulla. Morbi sagittis orci id lacus convallis tempus eget sit amet
										metus.
									</div>
								</div>
							</div>

							<!-- Item -->
							<div class="item clearfix rating_3">
								<div class="item_image"><img src="<?= base_url()?>/public/images/top_2.jpg" alt=""></div>
								<div class="item_content">
									<div class="item_title">Cinque Terre</div>
									
									<div class="rating rating_3" data-rating="3">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
									<div class="item_text">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit.
										Fusce fringilla lectus nec diam auctor, ut fringilla diam sagittis. Quisque vel
										est id justo faucibus dapibus id a nibh. Aenean suscipit consequat lacus, sit
										amet mollis nulla. Morbi sagittis orci id lacus convallis tempus eget sit amet
										metus.
									</div>
								</div>
							</div>

							<!-- Item -->
							<div class="item clearfix rating_4">
								<div class="item_image"><img src="<?= base_url()?>/public/images/top_3.jpg" alt=""></div>
								<div class="item_content">
									<div class="item_title">Italian Riviera</div>
									<div class="rating rating_4" data-rating="4">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
									<div class="item_text">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit.
										Fusce fringilla lectus nec diam auctor, ut fringilla diam sagittis. Quisque vel
										est id justo faucibus dapibus id a nibh. Aenean suscipit consequat lacus, sit
										amet mollis nulla. Morbi sagittis orci id lacus convallis tempus eget sit amet
										metus.
									</div>
								</div>
							</div>

							<!-- Item -->
							<div class="item clearfix rating_5">
								<div class="item_image"><img src="<?= base_url()?>/public/images/top_4.jpg" alt=""></div>
								<div class="item_content">
									<div class="item_title">Santorini, Greece</div>

									<div class="rating rating_5" data-rating="5">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
									<div class="item_text">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit.
										Fusce fringilla lectus nec diam auctor, ut fringilla diam sagittis. Quisque vel
										est id justo faucibus dapibus id a nibh. Aenean suscipit consequat lacus, sit
										amet mollis nulla. Morbi sagittis orci id lacus convallis tempus eget sit amet
										metus.
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!--
				<div class="row">
					<div class="col">
						<div class="pages">
							<ul class="pages_list">
								<li class="page active"><a href="#">01.</a></li>
								<li class="page"><a href="#">02.</a></li>
								<li class="page"><a href="#">03.</a></li>
								<li class="page"><a href="#">04.</a></li>
							</ul>
						</div>
					</div>
				</div>
				-->
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
	<script src="<?= base_url()?>/public/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script src="<?= base_url()?>/public/js/custom.js"></script>
</body>

</html>