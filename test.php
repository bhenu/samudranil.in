<?php
require_once "handle_tumblr.php";
require_once "handle_picasa.php";
echo "<pre>";
$photos = $Picasa->getAlbums("200");
print_r($photos);
echo "</pre>";
?>
