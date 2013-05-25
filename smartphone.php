<?php
$userid = '114527766546168509668';
$albumid = '5632182463740846529';
$feedURL = "http://picasaweb.google.com/data/feed/base/user/$userid/albumid/$albumid?kind=photo&access=public&max-results=7";
$sxml = simplexml_load_file($feedURL);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title> Samudranil Roy -- Photography</title>
<meta charset="UTF-8" />
<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0'/>
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/smartphone.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="scripts/swipe.js"></script>

</head>
<body>
  <div class="header">
    <div id="logo"><img src="images/logo.jpeg" /></div>
    <div id="menu"></div>
  </div>
  <div class="content-area">
    <div class="photo-slider">
     <div id='slider' class='swipe'>
      <div class='swipe-wrap'>
        <?php
			foreach ($sxml->entry as $entry) {      
        	$media = $entry->children('http://search.yahoo.com/mrss/');
	        $thumbnail = $media->group->thumbnail[1];
        	$imgurl = $thumbnail->attributes()->{'url'};
        	$oldword = "s144";
        	$newword = "s400";
	        $imgurl = str_replace($oldword , $newword , $imgurl);

        	echo "<div><img width='400' style='margin: 0 auto;' src=\"" . 
        	$imgurl . "\"/></div>";
            }

		?>
	  </div>
	 </div>
	</div>
    <div class="albums"></div>
    <div class="blog-posts"></div>
  </div>
  <div class="footer">
    <a>site credits</a>
  </div>
</body>
<script>

window.mySwipe = Swipe(document.getElementById('slider'),{
  startSlide: 2,
  speed: 400,
  auto: 3000,
  continuous: true,
  disableScroll: false,
  stopPropagation: false
});

</script>
</html>
