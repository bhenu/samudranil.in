<?php
require_once "handle_tumblr.php";
require_once "handle_picasa.php";
echo "<pre>";
$photos = $Tumblr->getPosts('0', '5');
print_r($photos);
echo "</pre>";
?>
