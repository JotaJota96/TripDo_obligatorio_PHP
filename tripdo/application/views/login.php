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
</head>

<body>
    <!-- Heder  -->
    <?php include("include/heder.php");?>

    <div class="news mt-5">
        <form action="<?php echo base_url();?>login/ingresar" method="POST">
            <input type="text" placeholder="Nickname" name="txtnick"><br>
            <input type="password" placeholder="Password" name="txtpass"><br>
            <input type="submit" name="login" value="Ingresar">
        </form>
        <p>Para salir entrar a /login/salir </p>
        <!-- Mensaje de error al iniciar sesion -->
        <p><?= $mensaje ?></p>
    </div>
    
    <!-- Footer -->
    <?php include("include/footer.php");?>

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