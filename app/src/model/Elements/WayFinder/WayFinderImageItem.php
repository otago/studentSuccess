<?php

namespace OP\studentsuccess;
use SilverStripe\Assets\Image;





class WayFinderImageItem extends WayFinderItem {

	private static $has_one = array(
		'Image'			=> Image::class
	);

} 