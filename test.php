<?php
require_once "handle_picasa.php";
echo "<pre>";
$photos = $Picasa->getPhoto('5888327605693791650', '640');
print_r($photos);
echo "</pre>";
?>
