<?php
require_once "handle_picasa.php";
require_once "handle_tumblr.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title> Samudranil Roy -- Photography</title>
<meta charset="UTF-8" />
<meta name='description' content='Samudranil Roy is a  hobby photographer. This website contains some of his works and also his blogs.'>
<meta name='keywords' content='Samudranil Roy, Samudranil, Photography, Nature Photography, photos'>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" href="http://samudranil-in.herokuapp.com/css/normalize.css" />
<link rel="stylesheet" href="http://samudranil-in.herokuapp.com/css/main.css" />
<link rel="stylesheet" href="http://samudranil-in.herokuapp.com/css/computer.css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300' rel='stylesheet' type='text/css'>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="jhttp://samudranil-in.herokuapp.com/scripts/jquery.easing.1.3.js"></script>
<script src="http://samudranil-in.herokuapp.com/scripts/jquery.animate-enhanced.min.js"></script>
<script src="http://samudranil-in.herokuapp.com/scripts/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(function() {
      $('#slides').superslides({
        hashchange: true
      });

      $('#slides').on('mouseenter', function() {
        $(this).superslides('stop');
        console.log('Stopped')
      });
      $('#slides').on('mouseleave', function() {
        $(this).superslides('start');
        console.log('Started')
      });
    });
</script>
</head>
<body>
  <div id="slides">
    <div class="slides-container">
        <?php
        ##
        ## retreive the featured images from picasa
        ##
        $photos = array_slice($Picasa->getAlbumPhotos('5632182463740846529', '1024', '1', '7'), 2);
        foreach ($photos as $entry) {
            echo "<img width=\"1024\" height=\"768\" alt=\"featured image\" src=\"" .
            $entry['url'] . "\"/>";
            }
        ?>
    </div>

    <nav class="slides-navigation">
      <a href="#" class="next">Next</a>
      <a href="#" class="prev">Previous</a>
    </nav>
  </div>

<aside class='navbar'>
    <div id="logo"><img src="http://samudranil-in.herokuapp.com/images/logo_l.png" alt="logo"></div>
    <div id="links">
        <ul>
            <li>portfolio</li>
            <li>blog</li>
            <li>about</li>
            <li>contacts</li>
        </ul>
    </div>

    <div class="credit"> Designed by Binayak &amp; Bishakh</div>
</aside>
</body>
</html>
