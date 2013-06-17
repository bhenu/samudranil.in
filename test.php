<!DOCTYPE html>
<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script>
			$(function(){
				var SROY = {
					'url' :'ajax.php',
					'sendRequest' : function(){
						$.getJSON(this.url, this.sendData, function(data){
							$("#container").html("<pre>"+ data.url + "</pre>");
							})
						},
					'sendData' : {
						'type' : 'photo',
						'photoid' : '5890319400538265762'
						}					
					};
				
				SROY.sendRequest();
				
				});
		</script>
	</head>
	<body>
		<p id='container'>content goes here..</p>
	</body>


</html>
