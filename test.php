<?php
require_once "handle_tumblr.php";
echo "<pre>";
$photos = $Tumblr->getPostsShort('1', '4');
echo "</pre>";
?>
