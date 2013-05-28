<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title> Samudranil Roy -- Photography</title>
<meta charset="UTF-8" />
<meta nam='description' content='Samudranil Roy is a  hobby photographer. This website contains some of his works and also his blogs.'>
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
    <div id="albums">
    <h2>Albums</h2>
    <?php     
        $feedURL = "http://picasaweb.google.com/data/feed/base/user/$userid?kind=album&access=public";
        $sxml = simplexml_load_file($feedURL);
        
        foreach ($sxml->entry as $entry) {
	        $id = $entry->id;
	        $oldword = "http://picasaweb.google.com/data/entry/base/user/114527766546168509668/albumid/";
	        $newword = "";
	        $id = str_replace($oldword , $newword , $id);
	        $oldword = "?hl=en_US";
	        $newword = "";
	        $id = str_replace($oldword , $newword , $id);
	        $title = $entry->title;
	
	        echo "<div class='album-elements'>";
	        $media = $entry->children('http://search.yahoo.com/mrss/');
		    $thumbnail = $media->group->thumbnail;
		    $imgurl = $thumbnail->attributes()->{'url'};
		    echo "<div><img alt='$title' class='pics' src=\"" . 
	        $imgurl . "\"/></div>";
	        
	

	        echo "<div class='albumtitle'>" . $title . "</div></div>";
            }
    ?>
    </div>
    <div class="blog-posts"></div>
  </div>
</body>

</html>
