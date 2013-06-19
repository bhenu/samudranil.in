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
        $status = $response->response->blog->description;
        $Posts = array(
                'status' => $status,
                );
        foreach($response->response->posts as $entry){
            $posttitle = $entry->title;
            $postid = $entry->id;
            $timestamp = $entry->timestamp;
            $body = $entry->body;
            $Posts[] = array(
                        'title' => $posttitle,
                        'id' => $postid,
                        'time' => $timestamp,
                        'body' => $body);
            };
        return $Posts;
    }
    public function getPostsShort($offset, $maxresult){
        $response = array_slice($this->getPosts($offset, $maxresult), 1);
        foreach($response as &$entry){
            $shortpost = preg_split("|<!--\smore\s-->|", $entry['body'], 2);
            $entry['body'] = $shortpost['0'];
        }
        return $response;
    }


}

$Tumblr = new Tumblr();
?>
