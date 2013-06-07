<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title> Samudranil Roy -- Photography</title>
<meta charset="UTF-8" />
<meta name='description' content='Samudranil Roy is a  hobby photographer. This website contains some of his works and also his blogs.'>
<meta name='keywords' content='Samudranil Roy, Samudranil, Photography, Nature Photography, photos'>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/smartphone.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="scripts/swipe.js"></script>
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

    //menu slide
    $('div.menu-list').hide();
    $("#menu").click(function(){
               $('div.menu-list').slideToggle(); 
    });

})

</script>

</head>
<body>
  <div class="header">
    <a href="index.php"><div id="logo"><img src="images/logo_m.png" /></div></a>
    <div id="menu"></div>
  </div>
  <div class="menu-list">
        <a href="#about">about</a>
        <a href="#blog">blog</a>
        <a href="#albums">albums</a>
  </div>
  <div class="content-area">
    <div class="photo-slider">
     <div id='slider' class='swipe'>
      <div class='swipe-wrap'>
        <?php
        
        ##
        ## retreive the featured images from picasa
        ##
        
        $userid = '114527766546168509668';
        $albumid = '5632182463740846529';
        $feedURL = "http://picasaweb.google.com/data/feed/base/user/$userid/albumid/$albumid?kind=photo&access=public&max-results=7";
        $sxml = simplexml_load_file($feedURL);
		foreach ($sxml->entry as $entry) {      
        	$media = $entry->children('http://search.yahoo.com/mrss/');
	        $thumbnail = $media->group->thumbnail[1];
        	$imgurl = $thumbnail->attributes()->{'url'};
        	$oldword = "s144";
        	$newword = "s640";
	        $imgurl = str_replace($oldword , $newword , $imgurl);

        	echo "<div><img style='margin: 0 auto;' src=\"" . 
        	$imgurl . "\"/></div>";
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
	            
	            $feedURL = "http://picasaweb.google.com/data/feed/base/user/$userid?kind=photo&access=public&max-results=12&imgmax=244c";
	            $sxml = simplexml_load_file($feedURL);
	            $elem_counter = 0;
	            echo "<div>";
	            foreach ($sxml->entry as $entry){
	                	$content = $entry->content;	                    	                    
        	            $imgurl = $content->attributes()->{'src'};
	                    if($elem_counter!= 0 && $elem_counter%4 == 0){
	                        echo "</div><div>";
	                        }
	                    echo "<div class='recent-element'><img class='pic' alt='$title' src='$imgurl'/></div>";
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
                 
            $feedURL = "http://picasaweb.google.com/data/feed/base/user/$userid?kind=album&access=public";
            $sxml = simplexml_load_file($feedURL);
            $elem_counter = 0;
            echo "<div>";
            foreach ($sxml->entry as $entry) {
	            $id = $entry->id;
	            $oldword = "http://picasaweb.google.com/data/entry/base/user/114527766546168509668/albumid/";
	            $newword = "";
	            $id = str_replace($oldword , $newword , $id);
	            $oldword = "?hl=en_US";
	            $newword = "";
	            $id = str_replace($oldword , $newword , $id);
	            $title = $entry->title;
                if($elem_counter != 0 && $elem_counter%2 == 0){
                    echo "</div><div>";
                }	
	            echo "<div class='album-elements'>";
	            $media = $entry->children('http://search.yahoo.com/mrss/');
		        $thumbnail = $media->group->thumbnail;
		        $imgurl = $thumbnail->attributes()->{'url'};
		        echo "<img alt='$title' class='pics' src=\"" . 
	            $imgurl . "\"/>";
	            
	

	            echo "<p class='albumtitle'>" . $title . "</p></div>";
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
            #echo "<div class='comments'>0</div><div class='time'>2050</div>";
            echo "</div>";
        }
        
        ?>
        </div>
  </div>
</body>

</html>
