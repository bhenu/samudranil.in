<?php

class Tumblr(){
	private $userid = "ghoshbinayak.tumblr.com";
	private $apikey = "upraHHL2RL1JwKyg9LXX1TGyeJ8d0wZcFOus3xBf7x47pX1xyw";
	public function getPosts($offset, $maxresults){
		$feedURL = "api.tumblr.com/v2/blog/"
					.$this->userid
					."/posts?api_key="
					.$this->apikey
					."&limit="
					.$maxresult
					."&offset="
					.$offset;
		$response = json_decode(file_get_contents($feedURL));
	
	}


}

$Tumblr = new Tumblr();
?>
