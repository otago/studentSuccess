<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 12:16 PM
 * To change this template use File | Settings | File Templates.
 */

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

	function VideoURL(){
		if($this->YoutubeVideo){
			return 'http://www.youtube.com/watch?v=' . StringUtils::YouTubeVideoIDFromURL($this->YoutubeVideo);
		}
	}


} 