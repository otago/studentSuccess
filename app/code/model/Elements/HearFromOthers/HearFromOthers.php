<?php

class HearFromOthers extends BaseElement {

	private static $title = "Hear From Others";

	private static $description = "Hear from others section";

	private static $db = array(
		'DisplayTitle'		=> 'Varchar(255)',
		'TestimonyContent'	=> 'Text',
		'Testimony'			=> 'Varchar(255)',
		'YoutubeVideo'		=> 'Varchar(300)'
	);

	private static $has_one = array(
		'Image'				=> 'Image'
	);

	private static $field_labels = array(
		'DisplayTitle' => 'Heading',
		'TestimonyContent' => 'Testimonial Content',
		'Testimony' => 'Testimonial name'
	);

	function VideoURL() {
		if($this->YoutubeVideo){
			return 'http://www.youtube.com/watch?v=' . StringUtils::YouTubeVideoIDFromURL($this->YoutubeVideo);
		}
	}


} 