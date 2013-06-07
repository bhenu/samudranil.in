<?php

class Tumblr{
	private $userid = "ghoshbinayak.tumblr.com";
	private $apikey = "upraHHL2RL1JwKyg9LXX1TGyeJ8d0wZcFOus3xBf7x47pX1xyw";
	public function getPosts($offset, $maxresults){
		$feedURL = "http://api.tumblr.com/v2/blog/"
					.$this->userid
					."/posts/text?api_key="
					.$this->apikey
					."&limit="
					.$maxresult
					."&offset="
					.$offset;
		$response = json_decode(file_get_contents($feedURL));
		return $response;	
	}
	public function getPostsShort($offset, $maxresult){
		$posts = $this->getPosts($offset, $maxresult);
		foreach($posts->response->posts as $entry){
			$postid = $entry->id;
			$posturl = $entry->post_url;
			$timestamp = $entry -> timestamp;
			$posttitle = $entry -> title;
			$postbody = $entry->body;			
		}
	}


}

$Tumblr = new Tumblr();
?>
