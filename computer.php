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
<link rel="stylesheet" href="http://localhost/css/superslides.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<?php if (!isset($_GET['page'])): ?>
    <script src="http://localhost/scripts/jquery.easing.1.3.js"></script>
    <script src="http://localhost/scripts/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>
    <script>
        $('#slides').superslides({
                                  animation: 'fade'
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

    <!-- Featured slides -->

    <div id="slides">
      <ul class="slides-container">
        <li>
          <img src="http://localhost/images/featured/Image1.jpg" alt="image1">
          <div class="container">
            Slide one
          </div>
        </li>
        <li>
          <img src="http://localhost/images/featured/Image2.jpg" alt="">
          <div class="container">
            Slide two
          </div>
        </li>
        <li>
          <img src="http://localhost/images/featured/Image3.jpg" alt="">
          <div class="container">
            Slide three
          </div>
        </li>
        <li>
          <img src="http://localhost/images/featured/Image4.jpg" alt="">
          <div class="container">
            Slide four
          </div>
        </li>
        <li>
          <img src="http://localhost/images/featured/Image5.jpg" alt="">
          <div class="container">
            Slide five
          </div>
        </li>
        <li>
          <img src="http://localhost/images/featured/Image6.jpg" alt="">
          <div class="container">
            Slide six
          </div>
        </li>
        <li>
          <img src="http://localhost/images/featured/Image7.jpg" alt="">
          <div class="container">
            Slide seven
          </div>
        </li>
      </ul>
      <nav class="slides-navigation">
        <a href="#" class="next">}</a>
        <a href="#" class="prev">{</a>
      </nav>
    </div>

    <div class='footer'></div>
</body>
</html>
