<?php

namespace OP\studentsuccess;
use SilverStripe\Assets\Image;




/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 9:24 AM
 * To change this template use File | Settings | File Templates.
 */

class MasonryImageTile extends MasonryTile {

	private static $db = array(
		'HideTitle'		=> 'Boolean'
	);

	private static $has_one = array(
		'Image'			=> Image::class
	);

} 