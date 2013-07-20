<?php
require_once 'handle_picasa.php';
require_once 'handle_tumblr.php';

$max_photo_size = "1600";

if($_GET['type'] == 'photo'){
        $response = $Picasa->getPhoto($_GET['photoid'], $max_photo_size);
        $json = json_encode($response);
}
elseif($_GET['type'] == 'albums'){
        $response = $Picasa->getAlbums($_GET['thumbsize']);
        $json = json_encode($response);
    }
elseif($_GET['type'] == 'albumPhotos'){
        $response = $Picasa->getAlbumPhotos($_GET['albumid'], $_GET['thumbsize'], $_GET['offset'], $_GET['maxresult']);
        $json = json_encode($response);
    }
header('Content-type: application/json');
exit($json);

?>
