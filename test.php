<?php
require_once "handle_tumblr.php";
require_once "handle_picasa.php";
echo "<pre>";
$photos = $Picasa->getPhoto('5731638090534538930', '640');
print_r($photos);
echo "</pre>";
?>
