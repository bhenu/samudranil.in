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
    <script src="http://localhost/scripts/swipe.js"></script>
    <script>
    $(function(){

        var bullets = document.getElementById('position').getElementsByTagName('li');
        var slider = Swipe(document.getElementById('slider'), {
            auto: 3000,
            continuous: true,
            callback: function(pos) {
                    var i = bullets.length;
                    while (i--) {
                    bullets[i].className = ' ';
                    }
                    bullets[pos].className = 'on';
            }
        });

        window.albumSlide = new Swipe(document.getElementById('album-swipe'), {
                              startSlide: 2,
                              speed: 400,
                              auto: 3000,
                              continuous: true,
                              disableScroll: false,
                              stopPropagation: true
                              });

        window.recentSlide = new Swipe(document.getElementById('recent-swipe'), {
                              startSlide: 2,
                              speed: 400,
                              auto: 3000,
                              continuous: true,
                              disableScroll: false,
                              stopPropagation: true
                              });



    })

    </script>
<?php endif; ?>

<script type='text/javascript'>

</script>
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
      <div id="slide">
        <?php
        ##
        ## retreive the featured images from picasa
        ##
        //$photos = array_slice($Picasa->getAlbumPhotos('5632182463740846529', '800', '1', '7'), 2);
        //foreach ($photos as $entry) {
            //echo "<li><img style='margin: 0 auto;' src=\"" .
            //$entry['url'] . "\"/></li>";
            //}
        ?>
      </div>
    </section>
    <div class='footer'></div>


</body>
</html>
