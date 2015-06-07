<?php

class CarouselSlideWithUpperLetter extends CarouselTextSlide {
	
	private static $db = array(
		'UpperLetter' => 'Varchar(1)'
	);


	function Width() {
		$iCount = $this->Carousel()->Slides()->count();

		return $iCount == 0 ? $iCount : 100/$iCount;
	}

	function Left() {
		$iPos = 0;

		foreach($this->Carousel()->Slides() as $item) {
			if($item->ID != $this->ID) {
				$iPos += 1;
			}
			else {
				break;
			}
		}

		return $iPos * $this->Width();
	}

}
