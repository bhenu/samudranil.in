<?php
require_once "handle_picasa.php";
echo "<pre>";
$photos = $Picasa->getAlbumPhotos('5628911678017020657', '244', '1', '1000');
print_r($photos);
echo "</pre>";
?>
