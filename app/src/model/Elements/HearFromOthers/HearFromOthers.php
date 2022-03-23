<?php

namespace OP\Studentsuccess;


use SilverStripe\Assets\Image;
use DNADesign\Elemental\Models\BaseElement;
use OP\Studentsuccess\StringUtils;


class HearFromOthers extends BaseElement
{
    private static $table_name = 'HearFromOthers';
    private static $title = "Hear From Others";

    private static $description = "Hear from others section";

    private static $db = [
        'DisplayTitle' => 'Varchar(255)',
        'TestimonyContent' => 'Text',
        'Testimony' => 'Varchar(255)',
        'YoutubeVideo' => 'Varchar(300)',
        'VideoTime' => 'Varchar(200)',
        'ExternalURL' => 'Varchar(200)'
    ];

    private static $has_one = [
        'Image' => Image::class
    ];

    private static $field_labels = [
        'DisplayTitle' => 'Heading',
        'TestimonyContent' => 'Testimonial Content',
        'Testimony' => 'Testimonial name',
        'YoutubeVideo' => 'Youtube Video ID (e.g DgVmXfcVGxI)'
    ];

    public function getType()
    {
        return 'Hear From Others';
    }

    public function VideoURL()
    {
        if ($this->ExternalURL) {
            return $this->ExternalURL;
        } else {
            return 'http://www.youtube.com/watch?v=' . StringUtils::YouTubeVideoIDFromURL($this->YoutubeVideo);
        }
    }


} 