<?php

namespace OP\studentsuccess;







use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Core\Config\Config;
use OP\studentsuccess\ImageExtension;
use SilverStripe\ORM\DataObject;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Assets\Image;
use SilverStripe\View\ArrayData;
use SilverStripe\View\ViewableData;
use SilverStripe\ORM\DataExtension;


/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 4/6/15
 * Time: 8:58 AM
 * To change this template use File | Settings | File Templates.
 */

class ImageExtension extends DataExtension {

	private static $exclude_classes = array();
	private static $sizes = array();

	/**
	 * @return int
	 */
	private static function DefaultHeight(){
		$siteConfig = SiteConfig::current_site_config();
		return $siteConfig->DefaultHeight ? : 300;
	}


	/**
	 * @return int
	 */
	private static function DefaultWidth(){
		$siteConfig = SiteConfig::current_site_config();
		return $siteConfig->DefaultWidth ? : 300;
	}


	/**
	 * ImageSizes
	 * read image sizes and update the has_one's of the data object to support all the
	 * image sizes.
	 */
	public static function ImageSizes(){
		$sizes = Config::inst()->get(ImageExtension::class, 'sizes');
		$exclude_classes = Config::inst()->get(ImageExtension::class, 'exclude_classes');
		$classes = ClassInfo::subclassesFor(DataObject::class);
		if($sizes && count($sizes)){
			foreach($classes as $class){
				$bAdd = true;
				if(is_array($exclude_classes) && in_array($class, $exclude_classes)){
					$bAdd = false;
				}

				if(!$bAdd)
					continue;

				$has_one = Config::inst()->get($class, 'has_one', Config::UNINHERITED);
				$arrImageFields = array();
				if($has_one) foreach($has_one as $name => $type){
					if($type == Image::class){
						foreach($sizes as $size)
							$has_one[$name . '_' . $size] = $type;

						$arrImageFields[] = $name;

					}
				}

				if(count($arrImageFields))
					Object::add_extension($class, 'ImageExtensionHelper(\'' .  implode(',', $arrImageFields) . '\')');

				Config::inst()->update($class, 'has_one', $has_one);


			}
		}

	}

	/**
	 * @param int $iWidth
	 * @param int $iHeight
	 * @param string $altText
	 * @param string $strClass
	 * @param string $strID
	 * @return HTMLText
	 *
	 * add a cropped version of the image to the size
	 */
	public function Add($iWidth = 0, $iHeight = 0, $altText = '', $strClass = '', $strID = ''){

		if(!$iWidth) $iWidth = ImageExtension::DefaultWidth();
		if(!$iHeight) $iHeight = ImageExtension::DefaultHeight();

		$image = null;
		if($this->owner->ID && file_exists($this->owner->getFullPath())){
			$image = $this->owner;
		}
		else if(SiteConfig::current_site_config()->ImagePlaceHolderID){
			$image = SiteConfig::current_site_config()->ImagePlaceHolder();
		}

		if($image && file_exists($image->getFullPath())){

			$cachedImage = $image->CroppedImage($iWidth, $iHeight);
			if($cachedImage){
				$arrRet = array(
					'URLWithSuffix'	=> $cachedImage->getURLWithSuffix(),
					'CSSClass'		=> $strClass,
					'Width'			=> $iWidth,
					'Height'		=> $iHeight,
					'ID'			=> $strID,
					'Alt'			=> !empty($altText) ? $altText : $image->getTitle(),
					'Sizes'			=> $image->Sizes
				);
				$ad = new ArrayData($arrRet);
				$vd = new ViewableData();
				return $vd->customise($ad)->renderWith('ImageHTML');
			}

		}

	}


	/**
	 * @param int $iWidth
	 * @param int $iHeight
	 * @param string $altText
	 * @param string $strClass
	 * @param string $strID
	 * @return HTMLText
	 */
	public function AddFluid($iWidth = 0, $iHeight = 0, $altText = '', $strClass = '', $strID = ''){
		$strClass = !empty($strClass) ? $strClass . ' fluid' : 'fluid';
		return $this->Add($iWidth, $iHeight, $altText, $strClass, $strID);
	}


	/**
	 * @param string $altText
	 * @param string $strClass
	 * @param string $strID
	 * @return HTMLText
	 * add the image as it is to the system
	 */
	public function Pure($altText = '', $strClass = '', $strID = ''){
		$owner = $this->owner;
		return $this->Add($owner->getWidth(), $owner->getHeight(), $altText, $strClass, $strID);
	}


	/**
	 * @param string $altText
	 * @param string $strClass
	 * @param string $strID
	 * @return HTMLText
	 */
	public function PureFluid($altText = '', $strClass = '', $strID = ''){
		$strClass = !empty($strClass) ? $strClass . ' fluid' : 'fluid';
		return $this->Pure($altText, $strClass, $strID);
	}


	/**
	 * @return string
	 */
	public function getURLWithSuffix(){
		$strRet = $this->owner->getURL();
		if(file_exists($this->owner->getFullPath())){
			if($time = filemtime($this->owner->getFullPath()))
				$strRet .= '?m=' . $time;
		}
		return $strRet;
	}

} 