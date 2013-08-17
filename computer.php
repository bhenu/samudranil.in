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
<link rel="stylesheet" href="http://localhost/css/normalize.css"  type="text/css"/>
<link rel="stylesheet" href="http://localhost/css/main.css"  type="text/css"/>
<link rel="stylesheet" href="http://localhost/css/computer.css"  type="text/css"/>
<link rel="stylesheet" href="http://localhost/css/jquery.mCustomScrollbar.css" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="http://localhost/scripts/jquery.easing.1.3.js"></script>
<script src="http://localhost/scripts/jquery.animate-enhanced.min.js"></script>
<script src="http://localhost/scripts/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://localhost/scripts/jquery.mCustomScrollbar.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://localhost/scripts/history.adapter.jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="http://localhost/scripts/history.js" type="text/javascript" charset="utf-8"></script>

<script>
    $(function() {
        $("#content-area").mCustomScrollbar({
                                            mouseWheel: true,
                                            mouseWheelPixels: 'auto',
                                            autoHideScrollbar:true,
                                            advanced:{updateOnContentResize: true}
                                            });

        $('#slides').superslides({
        hashchange: true,
        animation: 'fade',
        play: 2000,
        hashchange: false
        });

        $('#links').click(function(){
            $("#slides").fadeOut('200', function(){
                $("#content-area").fadeIn().mCustomScrollbar("update");
            });
        });

        $("#logo").click(function(){
            $("#content-area").fadeOut('200', function(){
                $("#slides").fadeIn();
            })
        })

        // history handling --------------------------------------------
        History.Adapter.bind(window,'statechange',function(){
            var State = History.getState();
            ajax_load(State.url);
            console.log("stateChanged!" + State.url);
        });

        // ajax prevent links from opening -----------------------------
        $('a').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            History.pushState(null, null, url);
            console.log("link clicked" + url);
        });

        // ajax loading function ---------------------------------------
        var ajax_load = function(url){
            console.log(url + url.search('blog'));
            if(url.search('blog/([0-9]+)?$') != -1){
                $('#content-area').html("blog + id!");
            }
            else if (url.search('blog?$')){
                $("#content-area").html("<div class='loading'>loading..</div>");
                $.getJSON("http://localhost/ajax.php?type=post",
                        function(data){
                            console.dir(data);
                            $("#content-area").empty();
                            $.each(data, function(index, post){
                                var container = $("<div class='post'></div>").hide();
                                $("<h2>" + post.title + "</h2>").appendTo(container);
                                var time = new Date(parseInt(post.time, 10) * 1000);
                                $("<p class='date'>"+ time.toDateString+"</p>").appendTo(container);
                                $("<p class='body'>"+ post.body+"</p>").appendTo(container);
                                container.appendTo("#content-area").show();
                            });
                            $("#content-area").mCustomScrollbar({
                                                                    mouseWheel: true,
                                                                    mouseWheelPixels: 'auto',
                                                                    autoHideScrollbar:true,
                                                                    advanced:{updateOnContentResize: true},
                                                                    scrollButtons:{enable: true}
                                                                    });
                            console.log("update scroll bar");
                        });
            }
            else if(url.search('about?$') != -1){
                $('#content-area').html("about");
            }
            else if(url.search('contacts?$') != -1){
                $('#content-area').html("contacts");
            }
            else if(url.search('portfolio?$') != -1){
                $('#content-area').html("portfolio");
            }
            else{
                $('#content-area').html("default");
            }
        }
    });
</script>
</head>
<body>

<!-- fullscreen slides ------------------------------------------------>
  <div id="slides">
    <div class="slides-container">
        <?php
        ##
        ## retreive the featured images from picasa
        ##
        $photos = array_slice($Picasa->getAlbumPhotos('5632182463740846529', '1600', '1', '4'), 2);
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

<!-- sidebar ---------------------------------------------------------->
<aside class='navbar'>
    <div id="logo"><a href="../"><img src="http://localhost/images/logo_l.png" alt="logo"></a></div>
    <div id="links">
        <ul>
            <a href="http://localhost/portfolio"><li>portfolio</li></a>
            <a href="http://localhost/blog"><li>blog</li></a>
            <a href="http://localhost/about"><li>about</li></a>
            <a href="http://localhost/contacts"><li>contacts</li></a>
        </ul>
    </div>

    <div class="credit"> Designed by Binayak &amp; Bishakh</div>
</aside>

<!-- content area ----------------------------------------------------->
<section id='content-area'>
    <div style='height: 1000px;'>hi</div>
</section>


</body>
</html>
