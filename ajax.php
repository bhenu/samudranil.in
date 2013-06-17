<?php
require_once 'handle_picasa.php';
require_once 'handle_tumblr.php';

$max_photo_size = "1600";

if($_GET['type'] == 'photo'){
		$response = $Picasa->getPhoto($_GET['photoid'], $max_photo_size);
		$json = json_encode($response);
}
exit($json);

?>
