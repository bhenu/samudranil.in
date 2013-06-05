<?php 

	/*******************************************************************
 	
	This file provides some functions to access public picasa photos
	
	$picasa = new Picasa();

	List of functions:
		
		$picasa->getAlbums(thumbsize);  //thumbsize must be a string and add c if you want cropped. 
										//example: "144" for uncropped and "144c" for cropped
										//list of uncropped sizes permitted: 94, 110, 128, 200, 220, 288, 320, 400, 512, 576, 640, 720, 800, 912, 1024, 1152, 1280, 1440, 1600	
		
			returns an array with albumids, thumbnail image url, and title of the albumid
			
			Output:
				Array{
					  [0] => Array{
									[albumid] => "5632182463740846529",
									[thumbnail] => "https://lh6.googleusercontent.com/-yldVqKAJzFw/Th3pWRBAovE/AAAAAAAACnw/9rQKiaPvs1Q/s630-c/ProfilePhotos.jpg",
									[title] => "Profile Pictures"
								   },
					  [1] => Array{
									[albumid] => "5632182463740849945",
									[thumbnail] => "https://lh6.googleusercontent.com/-yldVqKAJzFw/Th3pWRBAovE/AAAAAAAACnw/9rQKiaPvs1Q/s630-c/ProfilePhotos.jpg",
									[title] => "Featured"
								  }
					 }
			
					 
	********************************************************************/

class Picasa{        
        private $userid = '114527766546168509668';
        private $albumid = '5632182463740846529';
        
        // take thumsize as argument and return list of all albums in an array
        public function getAlbums($thumbsize){
			$Albums = array();			
			$feedURL = "https://picasaweb.google.com/data/feed/api/user/"
						.$this->userid
						."?kind=album&access=public&v=2&imgmax="
						.$thumbsize;
			$sxml = simplexml_load_file($feedURL);
			foreach ($sxml->entry as $entry) {      
				$albumid = $entry->children('http://schemas.google.com/photos/2007')->id;
	            $title = $entry->title;
	            $media = $entry->children('http://search.yahoo.com/mrss/');
		        $content = $media->group->content;
		        $imgurl = $content->attributes()->{'url'};
		        $Albums[] = array(
								  'albumid' => $albumid,
								  'thumbnail' => $imgurl,
								  'title' => $title,
								  ); 
				}
			return $Albums;
			}
			
			
			
			/***********************************************************
			  getAlbumPhotos(album id, thumbnail size, start index, max result)
			  
			  Gets photos list from album
			  
			  Output: returns an array::
			  	Array
			 		(
			 			[albumtitle] => SimpleXMLElement Object
			 				(
			 					[@attributes] => Array
			 						(
			 							[type] => text
			 						)
			 
			 					[0] => Featured
			 				)
			 
			 			[numphotos] => SimpleXMLElement Object
			 				(
			 					[0] => 40
			 				)
			 
			 			[0] => Array
			 				(
			 					[photoid] => SimpleXMLElement Object
									(
										[0] => 5770697284499307138
									)

								[title] => SimpleXMLElement Object
									(
										[@attributes] => Array
											(
												[type] => text
											)

										[0] => Gothic
									)

								[url] => SimpleXMLElement Object
									(
										[0] => https://lh5.googleusercontent.com/-9EbliOO-MzI/UBWimxTkeoI/AAAAAAAACDs/_jV_N7nRpF4/s300-c/Image31.jpg
									)

								[exif] => Array
									(
										[fstop] => SimpleXMLElement Object
											(
												[0] => 8.0
											)

										[make] => SimpleXMLElement Object
											(
												[0] => Panasonic
											)

										[model] => SimpleXMLElement Object
											(
												[0] => DMC-FZ28
											)

										[exposure] => SimpleXMLElement Object
											(
												[0] => 60.0
											)

										[flash] => SimpleXMLElement Object
											(
												[0] => false
											)

										[focullength] => SimpleXMLElement Object
											(
											)

										[iso] => SimpleXMLElement Object
											(
												[0] => 100
											)

									)

							)

					)
			************************************************************/
			
			
			public function getAlbumPhotos($albumid, $thumbsize, $offset, $maxresult){
	
				$feedURL = "https://picasaweb.google.com/data/feed/api/user/"
							.$this->userid
							."/albumid/"
							.$albumid
							."?kind=photo&access=public&v=2&imgmax="
							.$thumbsize
							."&start-index="
							. $offset
							."&max-results="
							.$maxresult;
				$sxml = simplexml_load_file($feedURL);
				$albumtitle = $sxml->title;
				$numphotos = $sxml->children('http://schemas.google.com/photos/2007')->numphotos;
				$Photos = array('albumtitle' => $albumtitle,
								'numphotos' => $numphotos,
								);
				foreach($sxml->entry as $entry){
					$photoid = $entry->children('http://schemas.google.com/photos/2007')->id;
					$title = $entry->summary;
					$url = $entry->content->attributes()->{'src'};
					$exiftag = $entry->children('http://schemas.google.com/photos/exif/2007');
					$exiftag = $exiftag->tags;
					$exif = array(
								'fstop' => $exiftag->fstop,
								'make' => $exiftag->make,
								'model' => $exiftag->model,
								'exposure' => $exiftag->exposure,
								'flash' => $exiftag->flash,
								'focallength' => $exiftag->focallength,
								'iso' => $exiftag->iso,
							);
					$Photos[] = array(
									'photoid' => $photoid,
									'title' => $title,
									'url' => $url,
									'exif' => $exif,
									);
					}
				return $Photos;
			}
			
			
			public function getPhoto($photoid, $size){
				$feedURL = "https://picasaweb.google.com/data/feed/api/user/"
							.$this->userid
							."/photoid/"
							.$photoid
							."?access=public&imgmax="
							.$size;
				$sxml = simplexml_load_file($feedURL);
				$title = $sxml->subtitle;
				$filename = $sxml->title;
				$url = $sxml->children('http://search.yahoo.com/mrss/')
							->group->content->attributes()->{'url'};
				$albumid = $sxml->children('http://schemas.google.com/photos/2007')
								->albumid;
				$exiftag = $sxml->children('http://schemas.google.com/photos/exif/2007')->tags;
				$exif = array(
							'fstop' => $exiftag->fstop,
							'make' => $exiftag->make,
							'model' => $exiftag->model,
							'exposure' => $exiftag->exposure,
							'flash' => $exiftag->flash,
							'focallength' => $exiftag->focallength,
							'iso' => $exiftag->iso,
							);
				$feedURL = "https://picasaweb.google.com/data/feed/api/user/"
							.$this->userid
							."/albumid/"
							.$albumid
							."?kind=photo&access=public&thumbnial=32";
				$sxml = simplexml_load_file($feedURL);
				foreach($sxml->entry as $entry){
					if($entry->children('http://schemas.google.com/photos/2007')->id == $photoid){
						$prev = array(
									'id' => $temp_id,
									'title' => $temp_title,
									'url' => $temp_url,
									);
					}
					if($temp_id == $photoid){
						$temp_id = $entry->children('http://schemas.google.com/photos/2007')
								->id;
						$temp_title = $entry->summary;
						$temp_url = $entry->content->attributes()->{'src'};
						$next = array(
									'id' => $temp_id,
									'title' => $temp_title,
									'url' => $temp_url,
									);
						continue;
					}
					$temp_id = $entry->children('http://schemas.google.com/photos/2007')
								->id;
					$temp_title = $entry->summary;
					$temp_url = $entry->content->attributes()->{'src'};
					echo "" . $temp_id . " | ". $photoid . "<br/>";
				}
				
				return $Photo = array(
									'id' => $photoid,
									'title' => $title,
									'url' => $url,
									'filename' => $filename,
									'albumid' => $albumid,
									'exif' => $exif,
									'prev' => $prev,
									'next' => $next,);
			}
		}
		
$Picasa = new Picasa();
?>
