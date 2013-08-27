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
<link rel="stylesheet" href="https://samudranil-in.herokuapp.com/css/normalize.css"  type="text/css"/>
<link rel="stylesheet" href="https://samudranil-in.herokuapp.com/css/main.css"  type="text/css"/>
<link rel="stylesheet" href="https://samudranil-in.herokuapp.com/css/computer.css"  type="text/css"/>
<link rel="stylesheet" href="https://samudranil-in.herokuapp.com/css/jquery.mCustomScrollbar.css" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Ubuntu:300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="https://samudranil-in.herokuapp.com/scripts/jquery.easing.1.3.js"></script>
<script src="https://samudranil-in.herokuapp.com/scripts/jquery.animate-enhanced.min.js"></script>
<script src="https://samudranil-in.herokuapp.com/scripts/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://samudranil-in.herokuapp.com/scripts/jquery.mCustomScrollbar.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://samudranil-in.herokuapp.com/scripts/history.adapter.jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="https://samudranil-in.herokuapp.com/scripts/history.js" type="text/javascript" charset="utf-8"></script>

<script>
    $(function() {
        $("#content-area").mCustomScrollbar({
                                            mouseWheel: true,
                                            mouseWheelPixels: 500,
                                            autoHideScrollbar:true,
                                            advanced:{updateOnContentResize: true,
                                                      normalizeMouseWheelDelta: true}
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

        // history handling --------------------------------------------
        History.Adapter.bind(window,'statechange',function(){
            console.log
            var State = History.getState();
            ajax_load(State.url);
        });

        // ajax prevent links from opening -----------------------------
        $(document).on('click', 'a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            console.log('called url: ' +url);
            History.pushState({}, "", url);
            console.log("history.push");
        });

        // create scroll bar -------------------------------------------
        var generate_sBar = function(){
            $("#content-area").mCustomScrollbar({
                                                mouseWheel: true,
                                                mouseWheelPixels: 300,
                                                autoHideScrollbar:true,
                                                advanced:{updateOnContentResize: true,
                                                          normalizeMouseWheelDelta: false
                                                          },
                                                scrollButtons:{enable: true}
                                                });
            };

        // keyboard handling for scroll bar ----------------------------
        $("#content-area").hover(function(){
                                    $(document).data({"keyboard-input":"enabled"});
                                    $(this).addClass("keyboard-input");
                                    }
                                ,function(){
                                    $(document).data({"keyboard-input":"disabled"});
                                    $(this).removeClass("keyboard-input");
                                    });


        $(document).keydown(function(e){
                    if($(this).data("keyboard-input")==="enabled"){
                        var activeElem=$(".keyboard-input"),
                            activeElemPos=Math.abs($(".keyboard-input .mCSB_container").position().top),
                            pixelsToScroll=60;
                        if(e.which===38){ //scroll up
                            e.preventDefault();
                            if(pixelsToScroll>activeElemPos){
                                activeElem.mCustomScrollbar("scrollTo","top");
                            }else{
                                activeElem.mCustomScrollbar("scrollTo",(activeElemPos-pixelsToScroll),{scrollInertia:400,scrollEasing:"easeOutCirc"});
                            }
                        }else if(e.which===40){ //scroll down
                            e.preventDefault();
                            activeElem.mCustomScrollbar("scrollTo",(activeElemPos+pixelsToScroll),{scrollInertia:400,scrollEasing:"easeOutCirc"});
                        }
                    }
                });

        // css to align the caption ------------------------------------
        $(".post img").parent("p").css({"text-align":"center"});

        // ajax loading function ---------------------------------------
        var ajax_load = function(url){

            // blog: single post ---------------------------------------
            if(url.search('blog/([0-9]+)/?$') != -1){
                $("#content-area").html("<div class='loading'>loading..</div>");

                var found = url.match('blog/([0-9]+)/?$');
                $.getJSON("https://samudranil-in.herokuapp.com/ajax.php?type=post&id='"+found[1]+"'",
                        function(data){
                            var time = new Date(parseInt(data.time)*1000);
                            var blog_post = "<h2>" + data.title + "</h2>"
                                            + "<p class='date'>"
                                            + time.toDateString()
                                            + "</p>"
                                            + "<p class='body'>"+data.body+"</p>";
                            $("#content-area").empty();
                            $("<div class='post'></div>").appendTo("#content-area")
                                              .hide()
                                              .html(blog_post)
                                              .fadeIn();
                            generate_sBar();
                        });
            }

            //blog: all posts ------------------------------------------
            else if (url.search('blog/?$') != -1){
                $("#content-area").html("<div class='loading'>loading..</div>");
                $.getJSON("https://samudranil-in.herokuapp.com/ajax.php?type=blog",
                        function(data){
                            var blog_posts = [];
                            var i = 0;
                            $("#content-area").empty();
                            $.each(data, function(index, post){
                                var time = new Date(parseInt(post.time)*1000);
                                blog_posts[i++] = "<div class='post-gist'>";
                                blog_posts[i++] = "<a href='https://samudranil-in.herokuapp.com/blog/"
                                                    + post.id +
                                                    "/'><h2>" + post.title + "</h2></a>";
                                blog_posts[i++] = "<p class='date'>"
                                                    + time.toDateString()
                                                    + "</p>";
                                blog_posts[i++] = "<p class='body'>"+post.body+"</p>";
                                blog_posts[i++] = "<a href='https://samudranil-in.herokuapp.com/blog/"
                                                    + post.id +
                                                    "/'><p class='more'>read on...</p></a>";
                                blog_posts[i++] = "</div>";
                            });
                            $("<div class='blog_container'></div>").appendTo("#content-area")
                                              .hide()
                                              .html(blog_posts.join(''))
                                              .fadeIn('200', function(){
                                                  $(".post img").parent("p").css({"text-align":"center"});
                                                  });
                            generate_sBar();
                        });
            }

            // about page ----------------------------------------------
            else if(url.search('about/?$') != -1){
                $('#content-area').html("about");
            }

            // contacts page -------------------------------------------
            else if(url.search('contacts/?$') != -1){
                $('#content-area').html("contacts");
            }

            // portfolio page ------------------------------------------
            else if(url.search('portfolio/?$') != -1){
                $("#content-area").html("<div class='loading'>loading..</div>");
                $.getJSON("https://samudranil-in.herokuapp.com/ajax.php?type=albums&thumbsize=400c",
                    function (data){
                         $("<div class='blog_container'></div>").appendTo("#content-area")
                                              .hide()
                                              .html("<pre>"+data+"</pre>")
                                              .fadeIn();
                    }
                )
            }

            // home page -----------------------------------------------
            else{
                $("#content-area").fadeOut('200', function(){
                    $("#slides").fadeIn();
                    $('#slides').superslides('start');
                }).empty();
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
    <div id="logo"><a href="../"><img src="https://samudranil-in.herokuapp.com/images/logo_l.png" alt="logo"></a></div>
    <div id="links">
        <ul>
            <a href="https://samudranil-in.herokuapp.com/portfolio"><li>portfolio</li></a>
            <a href="https://samudranil-in.herokuapp.com/blog"><li>blog</li></a>
            <a href="https://samudranil-in.herokuapp.com/about"><li>about</li></a>
            <a href="https://samudranil-in.herokuapp.com/contacts"><li>contacts</li></a>
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
