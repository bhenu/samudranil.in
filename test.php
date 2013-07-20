<!--<!DOCTYPE html>
<html>
	<head>
		<title>test ajax</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script>
			$(function(){
				var Samudranil = {
					"ajax_url" : "../ajax.php",
					"ajax_data": {},							//data to send in post/get request
					"ajax_success" : function(){
						$("#content").html("<pre>"+arguments[0]+"</pre>");
						},
					"get_content" : function(){				//requset handler
						$.getJSON(this.ajax_url, this.ajax_data, this.ajax_success());
						}
					};
					
				Samudranil.ajax_data = {type: 'photo', 
										photoid: '5890319400538265762'
									}
				Samudranil.get_content();
			});
		</script>
	</head>
	<body>
		<div id="content">
			<p>content goes here</p>
		</div>
	</body>
</html>

-->
<?php
require_once "handle_tumblr.php";
require_once "handle_picasa.php";
echo "<pre>";
$photos = $Tumblr->getSinglePost('53442472180');
print_r($photos);
echo "</pre>";
?>
