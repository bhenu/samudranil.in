<?php 
include_once 'handle_picasa.php';

//$albums = $picasa->getAlbums("600c");

//foreach ($albums as $element){
	//echo "<h1>". $element['title'] . "</h1><br />";
	//echo "id: ". $element['id'] . "<br />";
	//echo "thumbnail: <img src=\"". $element['thumbnail'] . "\" /><br />";
//};
?>
<pre>
	<?php
		//print_r($picasa->getAlbumPhotos("5632182463740846529", "300c", "1", "1"));
		print_r($picasa->getPhoto("5763182500453685954", "1600"));
	?>
</pre>

