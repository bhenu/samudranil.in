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
<link rel="stylesheet" href="http://samudranil-in.heroku.com/css/main.css" />
<link rel="stylesheet" href="http://samudranil-in.heroku.com/css/smartphone.css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300' rel='stylesheet' type='text/css'>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<?php if (!isset($_GET['page'])): ?>
    <script src="http://samudranil-in.heroku.com/scripts/swipe.js"></script>
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
<script>
    $(function(){
        //menu slide
        $('div.menu-list').hide();
        $("#menu").click(function(){
                   $('div.menu-list').slideToggle();
        });
    });

 </script>
</head>
<body>
  <div class="header">
    <a href="http://samudranil-in.heroku.com/index.php"><div id="logo"><img src="http://samudranil-in.heroku.com/images/logo_s.png" /></div></a>
    <div id="menu"></div>
  </div>
  <div class="menu-list">
        <a href="http://samudranil-in.heroku.com/">home</a>
        <a href="http://samudranil-in.heroku.com/albums/">albums</a>
        <a href="http://samudranil-in.heroku.com/blog/">blog</a>
        <a href="http://samudranil-in.heroku.com/about/">about</a>
  </div>
  <div class="content-area">
    <!-- home page-->
    <?php if(!isset($_GET['page'])):?>
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
                        echo "<a href='http://samudranil-in.heroku.com/photo/".$entry['photoid']."'><div class='recent-element'><img class='pics' alt='". $entry['title'] . "' src='" . $entry['url'] . "'/></div></a>";
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
            $albums = $Picasa->getAlbums('244c');
            $elem_counter = 0;
            echo "<div>";
            foreach ($albums as $entry) {
                if($elem_counter != 0 && $elem_counter%2 == 0){
                    echo "</div><div>";
                }
                echo "<a href=\"http://samudranil-in.heroku.com/albums/".$entry['albumid']."\"><div class='album-elements'>";
                echo "<img alt='" . $entry['title'] . "' class='pics' src=\"" . $entry['url'] . "\"/>";
                echo "<p class='albumtitle'>" . $entry['title'] . "</p></div></a>";
                $elem_counter += 1;
                }
                echo "</div>";
        ?>
            </div>
          </div>
        </div>
    <div class="blog-posts">
        <h2> Recent posts </h2>
        <?php
        ##
        ## get the latest posts from tumblr
        ##

        $Posts = array_slice($Tumblr->getPostsShort('0', '7'), 2);
        $date = new DateTime();
        foreach($Posts as $entry){
            echo "<div class='blog-post'>";
            echo "<h3><a href='http://samudranil-in.heroku.com/blog/".$entry['id']."'>".$entry['title']."</a></h3>";
            $date->setTimestamp($entry['time']);
            echo "<span style='font-size: 0.8em; font-style: italic; display: block; text-align: center'>".$date->format('jS F\, Y \a\t g:ia')."</span>";
            echo $entry['body'];
            echo "<a href='http://samudranil-in.heroku.com/blog/".$entry['id']."'><span style='font-weight: bold; display: block; text-align: right'>read on ..</span></a>";
            echo "</div>";
            }
            echo "<a href='http://samudranil-in.heroku.com/blog/'><h3 style='text-align: center'>visit the blog</h3></a>";

        ?>
    </div>
    <!-- albums page -->
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
                echo "<a href='http://samudranil-in.heroku.com/albums/".$entry['albumid']."'><div class='album-elements'>";
                echo "<img alt='" . $entry['title'] . "' class='pics' src=\"" .
                $entry['url'] . "\"/>";



                echo "<p class='albumtitle'>" . $entry['title'] . "</p></div></a>";
                $elem_counter += 1;
                }
                echo "</div>";
        ?>
        </div>
    <!-- album photos page -->
    <?php elseif(isset($_GET['page']) && isset($_GET['id']) && $_GET['page'] == 'albums'): ?>
        <div class="photos only">
            <?php
            ##
            ## get the photos in an album from picasa
            ##
            $photos = $Picasa->getAlbumPhotos($_GET['id'], '244c', '1', '1000');
            echo "<a href='http://samudranil-in.heroku.com/albums/'><h3>← all aubums</h3></a>";
            echo "<h2>" . $photos['albumtitle'] . "</h2>";
            $photos = array_slice($photos, 2);
            $elem_counter = 0;
            echo "<div class='element-wrapper'>";
            foreach ($photos as $entry){
                    if($elem_counter!= 0 && $elem_counter%2 == 0){
                        echo "</div><div class='element-wrapper'>";
                        }
                    echo "<div class='photo-element'><a href='http://samudranil-in.heroku.com/photo/".$entry['photoid']."'><img class='pics' alt='". $entry['title'] . "' src='" . $entry['url'] . "'/></div></a>";
                    $elem_counter += 1;
                    }
            echo "</div>";
            ?>

        </div>
    <!-- photo viewer page -->
    <?php elseif(isset($_GET['page']) && $_GET['page'] == 'photo' && isset($_GET['id'])): ?>
    <div class='photo-container'>
        <?php
            $photo = $Picasa->getPhoto($_GET['id'], '640');
            echo "<a href='http://samudranil-in.heroku.com/albums/".$photo['albumid']."'><h3>← albums / " . $photo['albumtitle'] . "</h3></a>";
            echo "<img class=\"pics\" src=\"" . $photo['url'] . "\"/>";
            echo "<h2>".$photo['title']."</h2>";
            if($photo['prev']['id'] != null){
                echo "<a href='http://samudranil-in.heroku.com/photo/".$photo['prev']['id']."'><h3 style='float: left; margin-left: 5%'>← previous</h3></a>";
            }
            if($photo['next']['id'] != null){
                echo "<a href='http://samudranil-in.heroku.com/photo/".$photo['next']['id']."'><h3 style='float: right; margin-right: 5%'>next →</h3></a>";
            }
        ?>
    </div>
    <!-- blog main page -->
    <?php elseif(isset($_GET['page']) && $_GET['page'] == 'blog' && !isset($_GET['id'])): ?>
    <div class='blog-container'>
        <?php
        if (isset($_GET['offset'])){
            $offset = $_GET['offset'];
            $Posts = $Tumblr->getPosts(($offset*10 -1), '10');
        }
        else {
            $Posts = $Tumblr->getPosts('0', '10');
            $offset = 0;
        }
        $summary = $Posts['status'];
        $total_posts = $Posts['total_post'];
        echo "<h2>“ " . $summary . " ”</h2>";
        $Posts = array_slice($Posts, 2);
        $date = new DateTime();
        foreach($Posts as $entry){
            echo "<div class='blog-post'>";
            echo "<h3><a href='http://samudranil-in.heroku.com/blog/".$entry['id']."'>".$entry['title']."</a></h3>";
            $date->setTimestamp($entry['time']);
            echo "<span style='font-size: 0.8em; font-style: italic; display: block; text-align: center'>".$date->format('jS F\, Y \a\t g:ia')."</span>";
            echo $entry['body'];
            echo "</div>";
        }

        if($offset > 0){
            echo "<a href='http://samudranil-in.heroku.com/blog/page/".($offset - 1)."'><h3 style='float: left; margin-left: 5%'>← previous</h3></a>";
            }
        if(($total_posts - ($offset +1)*10) > 0){
            echo "<a href='http://samudranil-in.heroku.com/blog/page/".($offset +1)."'><h3 style='float: right; margin-right: 5%'>next →</h3></a>";
        }
        ?>
    </div>
    <?php endif; ?>
  </div>
</body>

</html>
