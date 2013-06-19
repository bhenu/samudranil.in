<?php
require_once "handle_tumblr.php";
require_once "handle_picasa.php";
echo "<pre>";
$photos = $Tumblr->getPostsShort('0', '5');
print_r($photos);
echo "</pre>";
?>
