<?php
require_once "handle_picasa.php";
echo "<pre>";
$photos = $Picasa->getAlbums('244');
print_r($photos);
echo "</pre>";
phpinfo()
?>
