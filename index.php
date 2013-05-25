<<<<<<< HEAD
<?php
include 'scripts/Mobile_Detect.php';
$detect = new Mobile_Detect();
=======
<!DOCTYPE html>
<html>
<head>
<title>
Samudranil Roy --Photography
</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
    var $featured_album_feed = $.parseXML($.get('https://picasaweb.google.com/data/feed/api/user/114527766546168509668/albumid/5632182463740846529?kind=photo&access=public&max-results=7'));
    
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
     $("body").html($($featured_album_feed));
    }
    else{
        $("body").html("not ready for the silver screen yet.. check out the site from your mobile.");
    }
})
</script>
<head>
<body>
</body>
</html>
>>>>>>> 0f344456b76c86d931e4c498e86fde58b0b618d7

if (($detect->isAndroidOS() || $detect->isiPhone() || $detect-> isPalmOS() || $detect->isWindowsPhoneOS() || $detect->isBlackBerryOS()) && !$detect-> isOpera()) {
    include 'smartphone.php';
}
else if($detect->isTablet()){
    include 'tabelt.php';
}
else if(!$detect->isTablet() && !$detect->isMobile()){
    include 'computer.php';
}
else {
    include 'default.php';
}

?>
