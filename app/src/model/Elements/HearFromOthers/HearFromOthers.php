<?php

namespace OP\Studentsuccess;


use SilverStripe\Assets\Image;
use DNADesign\Elemental\Models\BaseElement;
use OP\Studentsuccess\StringUtils;
use SilverStripe\ORM\FieldType\DBField;


class HearFromOthers extends BaseElement
{
    private static $table_name = 'HearFromOthers';
    private static $singular_name = "Hear From Others";
    private static string $icon = 'font-icon-happy';
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

    private static $owns = [
        'Image'
    ];

    private static $field_labels = [
        'DisplayTitle' => 'Heading',
        'TestimonyContent' => 'Testimonial Content',
        'Testimony' => 'Testimonial name',
        'YoutubeVideo' => 'Youtube Video ID (e.g DgVmXfcVGxI)'
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function VideoURL()
    {
        if ($this->ExternalURL) {
            return $this->ExternalURL;
        } else {
            return 'http://www.youtube.com/watch?v=' . StringUtils::YouTubeVideoIDFromURL($this->YoutubeVideo);
        }
    }


    protected function provideBlockSchema()
    {
        $myType = "[" . $this->getType() . "] ";
        $myType .= $this->TestimonyContent . " ";
        $myType .= DBField::create_field('HTMLText', $this->Testimony)->Summary(20);

        $blockSchema = parent::provideBlockSchema();

        $blockSchema['content'] = $myType;
        if ($this->Image() && $this->Image()->exists()) {
            $blockSchema['fileURL'] = $this->Image()->CMSThumbnail()->getURL();
        }
        return $blockSchema;
    }


}
