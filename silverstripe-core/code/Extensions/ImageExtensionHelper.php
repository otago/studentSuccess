<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 4/6/15
 * Time: 11:13 AM
 * To change this template use File | Settings | File Templates.
 */

class ImageExtensionHelper extends DataExtension {

	private $image_fields = null;

	public function __construct($image_fields){
		$this->image_fields = explode(',', $image_fields);
		parent::__construct();

	}

	/**
	 * @param FieldList $fields
	 */
	function updateCMSFieldsForImages(FieldList $fields){

		$has_one = $this->owner->has_one();
		$sizes = Config::inst()->get('ImageExtension', 'sizes');
		$exclude_classes = Config::inst()->get('ImageExtension', 'exclude_classes');
		if(is_array($exclude_classes) && in_array(get_class($this->owner), $exclude_classes)){
			return;
		}

		if($has_one && $sizes && count($sizes)) foreach($has_one as $name => $type){

			if($type == 'Image'){
				$arrParts = explode('_', $name);
				$strLast = count($arrParts) > 1 ? $arrParts[count($arrParts) - 1] : '';
				if(!in_array($strLast, $sizes)){
					if($imageField = $fields->dataFieldByName($name)){
						foreach($sizes as $size)
							$fields->insertAfter(
								UploadField::create($name . '_' . $size)->setTitle($imageField->Title() . ' (' . $size . ' px)'),
								$name);
					}
				}

			}
		}

	}


	public function SizedImage($strName){
		$owner = $this->owner;
		if($image = Image::get()->byID($owner->getField($strName . 'ID'))){
			$image->Sizes = new ArrayList();
			if($sizes = Config::inst()->get('ImageExtension', 'sizes')) foreach($sizes as $size){
				if($sizedImage = Image::get()->byId($owner->getField($strName . '_' . $size . 'ID')))
					$image->Sizes->push(new ArrayData(array(
						'Image'		=> $sizedImage,
						'Size'		=> $size
					)));
			}

			return $image;
		}
	}




} 