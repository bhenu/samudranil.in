<?php
require_once "handle_picasa.php";
require_once "handle_tumblr.php";
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<title> Samudranil Roy -- Photography</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name='description' content='Samudranil Roy is a  hobby photographer. This website contains some of his works and also his blogs.'>
<meta name='keywords' content='Samudranil Roy, Samudranil, Photography, Nature Photography, photos'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" href="http://localhost/css/normalize.css" />
<link rel="stylesheet" href="http://localhost/css/main.css" />
<link rel="stylesheet" href="http://localhost/css/computer.css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300' rel='stylesheet' type='text/css'>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<?php if (!isset($_GET['page'])): ?>
    <script src="http://localhost/scripts/jquery.slides.min.js"></script>
    <script>
    $(function() {
      $('#featured').slidesjs({
        width: 4,
        height: 3,
        play: {
          active: true,
          effect: "fade",
          interval: 3000,
          auto: true,
          swap: true,
          pauseOnHover: false,
          restartDelay: 2500
        },
        navigation: {
          active: false
        },
        pagination: {
          effect: "fade"
        },
        effect: {
          fade: {
            speed: 400
          }
      }
      });
    });
    </script>
<?php endif; ?>


</head>
<body>
     <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <aside class='navbar'>
        <div id="logo"><img src="http://localhost/images/Logo.png" alt="logo"></div>
        <div id="links">
            <ul>
                <li>home</li>
                <li>albums</li>
                <li>blog</li>
                <li>olympus</li>
                <li>about</li>
                <li>credits</li>
            </ul>
        </div>

        <div class="credit"> Designed by Binayak &amp; Bishakh</div>
    </aside>
    <section class="container">
        <!-- home page-->
        <?php if(!isset($_GET['page'])):?>
        <div class='slide-container'>
            <div id="featured">
                    <div><img width='100%' style='margin: 0 auto;' src='http://localhost/images/featured/Image1.jpg'></div>
                    <div><img width='100%' style='margin: 0 auto;' src='http://localhost/images/featured/Image2.jpg'></div>
                    <div><img width='100%' style='margin: 0 auto;' src='http://localhost/images/featured/Image3.jpg'></div>
                    <div><img width='100%' style='margin: 0 auto;' src='http://localhost/images/featured/Image4.jpg'></div>
                    <div><img width='100%' style='margin: 0 auto;' src='http://localhost/images/featured/Image5.jpg'></div>
                    <div><img width='100%' style='margin: 0 auto;' src='http://localhost/images/featured/Image6.jpg'></div>
                    <div><img width='100%' style='margin: 0 auto;' src='http://localhost/images/featured/Image7.jpg'></div>
            </div>
        </div>
        <?php endif; ?>
    </section>
    <div class='footer'></div>
</body>
</html>
