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
<link rel="stylesheet" href="../css/main.css" />
<link rel="stylesheet" href="../css/smartphone.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<?php if (!isset($_GET['page'])): ?>
    <script src="../scripts/swipe.js"></script>
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

</head>
<body>
  <div class="header">
    <a href="../index.php"><div id="logo"><img src="../images/logo_m.png" /></div></a>
    <div id="menu"></div>
  </div>
  <div class="menu-list">
        <a href="../about/">about</a>
        <a href="../blog/">blog</a>
        <a href="../albums/">albums</a>
  </div>
  <div class="content-area">
    <?php if(!isset($_GET['page'])): ?>
    <div class="photo-slider">
     <div id='slider' class='swipe'>
      <div class='swipe-wrap'>
        <?php
        ##
        ## retreive the featured images from picasa
        ##
        $photos = array_slice($Picasa->getAlbumPhotos('5632182463740846529', '640', '1', '7'), 2);
        foreach ($photos as $entry) {
            echo "<div><img style='margin: 0 auto;' src=\"" .
            $entry['url'] . "\"/></div>";
            }
        ?>
      </div>
     </div>
     <nav>

    <ul id='position'>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>

    </nav>
    </div>


    <div class="recent">
    <h2>Recent Clix</h2>
        <div id="recent-swipe" class="swipe">
            <div class='swipe-wrap'>
            <?php
                ##
                ## get the recently uploaded pics from picasa
                ##
                $photos = $Picasa->getRecentPhotos('244c', '12');
                $elem_counter = 0;
                echo "<div>";
                foreach ($photos as $entry){
                        if($elem_counter!= 0 && $elem_counter%4 == 0){
                            echo "</div><div>";
                            }
                        echo "<div class='recent-element'><img class='pics' alt='". $entry['title'] . "' src='" . $entry['url'] . "'/></div>";
                        $elem_counter += 1;
                        }
                echo "</div>";

            ?>
            </div>
        </div>
    </div>

    <div class="albums">
        <h2> Albums</h2>
        <div id="album-swipe" class="swipe">
        <div class='swipe-wrap'>
        <?php
            ##
            ##this piece of php retrieves the list of albums from picasa
            ##
            $albums = $Picasa->getAlbums('244');
            $elem_counter = 0;
            echo "<div>";
            foreach ($albums as $entry) {
                if($elem_counter != 0 && $elem_counter%2 == 0){
                    echo "</div><div>";
                }
                echo "<div class='album-elements'>";
                echo "<img alt='" . $entry['title'] . "' class='pics' src=\"" .
                $entry['url'] . "\"/>";



                echo "<p class='albumtitle'>" . $entry['title'] . "</p></div>";
                $elem_counter += 1;
                }
                echo "</div>";
        ?>
            </div>
          </div>
        </div>
    <div class="blog-posts">
        <h2> Posts </h2>
        <?php

        ##
        ## get the latest posts from tumblr
        ##
        $blog_url = "http://api.tumblr.com/v2/blog/ghoshbinayak.tumblr.com/posts/text?api_key=upraHHL2RL1JwKyg9LXX1TGyeJ8d0wZcFOus3xBf7x47pX1xyw";
        $json = file_get_contents($blog_url);
        $json_parsed = json_decode($json);

        foreach($json_parsed->response->posts as $post){
            $post_title = $post->title;
            $post_body = $post->body;
            echo "<div class='blog-post'>";
            echo "<h3>$post_title</h3>";
            echo $post_body;
            echo "</div>";
        }

        ?>
    </div>
    <?php elseif(isset($_GET['page']) && $_GET['page'] == 'albums' && !isset($_GET['id'])) : ?>
        <div class="albums only">
        <h2> Albums</h2>
        <?php
            ##
            ##this piece of php retrieves the list of albums from picasa
            ##
            $albums = $Picasa->getAlbums('320c');
            $elem_counter = 0;
            echo "<div class=\"elements-wrapper\">";
            foreach ($albums as $entry) {
                if($elem_counter != 0 && $elem_counter%2 == 0){
                    echo "</div><div class=\"elements-wrapper\">";
                }
                echo "<div class='album-elements'>";
                echo "<img alt='" . $entry['title'] . "' class='pics' src=\"" .
                $entry['url'] . "\"/>";



                echo "<p class='albumtitle'>" . $entry['title'] . "</p></div>";
                $elem_counter += 1;
                }
                echo "</div>";
        ?>
        </div>
    <?php elseif(isset($_GET['page']) && isset($_GET['id']) && $_GET['page'] == 'albums'): ?>
        <div class="photos only">
            <?php
            ##
            ## get the photos in an album from picasa
            ##
            $photos = $Picasa->getAlbumPhotos($_GET['id'], '244c', '1', '1000');
            echo "<h2>" . $photos['albumtitle'] . "</h2>";
            $photos = array_slice($photos, 2);
            $elem_counter = 0;
            echo "<div class='element-wrapper'>";
            foreach ($photos as $entry){
                    if($elem_counter!= 0 && $elem_counter%2 == 0){
                        echo "</div><div class='element-wrapper'>";
                        }
                    echo "<div class='photo-element'><img class='pics' alt='". $entry['title'] . "' src='" . $entry['url'] . "'/></div>";
                    $elem_counter += 1;
                    }
            echo "</div>";
            ?>

        </div>
    <?php endif; ?>
  </div>
</body>

</html>
