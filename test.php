<?php
require_once "handle_tumblr.php";
require_once "handle_picasa.php";
echo "<pre>";
$photos = $Tumblr->getSinglePost('53442472180');
print_r($photos);
echo "</pre>";
?>
