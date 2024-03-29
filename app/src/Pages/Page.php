<?php
namespace {

    use SilverStripe\Assets\Image;
    use OP\Studentsuccess\RelatedPage;
    use OP\Studentsuccess\RelatedPageBox;
    use SilverStripe\Forms\CheckboxField;
    use SilverStripe\Forms\GridField\GridField;
    use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
    use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
    use SilverStripe\Forms\TextField;
    use SilverStripe\Forms\TextareaField;
    use SilverStripe\AssetAdmin\Forms\UploadField;
    use SilverStripe\Forms\LiteralField;
    use SilverStripe\Forms\DropdownField;
    use SilverStripe\Forms\TreeDropdownField;
    use SilverStripe\Forms\GridField\GridFieldDeleteAction;
    use OP\Studentsuccess\FormUtils;
    use SilverStripe\Forms\HeaderField;
    use SilverStripe\Control\Email\Email;
    use OP\Studentsuccess\SearchPage;
    use SilverStripe\ORM\ArrayList;
    use SilverStripe\CMS\Model\SiteTree;
    use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


    class Page extends SiteTree
    {

        private static $db = [
            'MetaTitle' => 'Varchar(255)',
            'Intro' => 'Text',
            'ShowInTopMenu' => 'Boolean',
            'AlignRightTopMenu' => 'Boolean',
            'HighlightInMenu' => 'Boolean',

            // drop down menu contents
            'DropDownMenuTitle' => 'Varchar(300)',
            'DropDownCol1' => 'HTMLText',
            'DropDownCol2' => 'HTMLText',
            'DropDownCol3' => 'HTMLText',
            'DropDownLink' => 'Varchar(200)',
            'DropDownImageText' => 'Varchar(200)',
            'DropDownTarget' => 'Varchar',
            'HelpfulCounterYes' => 'Int',
            'HelpfulCounterNo' => 'Int',

            'RelatedTopicsTitle' => 'Varchar(200)',
            'ShowRelatedTopicsContacts' => 'Boolean'
        ];

        private static $casting = [
            'FeedBackLite' => 'HTMLFragment'
        ];


        private static $has_one = [
            'DropDownImage' => Image::class,
            'DropDownPage' => 'Page',
            'HeroImage' => Image::class,
        ];

        private static $owns = [
            'DropDownImage',
            'HeroImage',
        ];

        private static $has_many = [
            'RelatedPages' => RelatedPage::class,
            'RelatedBoxes' => RelatedPageBox::class
        ];

        public function getSettingsFields()
        {
            $fields = parent::getSettingsFields();

            $fields->addFieldsToTab("Root.Settings", [
                CheckboxField::create('ShowInTopMenu'),
                CheckboxField::create('AlignRightTopMenu'),
                CheckboxField::create('HighlightInMenu'),
            ], 'ShowInSearch');

            return $fields;
        }


        public function getCMSFields()
        {
            $fields = parent::getCMSFields();

            $metaData = $fields->fieldByName('Root.Main.Metadata');

            if ($metaData) {
                $metaData->push(new TextField('MetaTitle', 'Meta title'));
            } else {
                $fields->addFieldToTab("Root.Main", new TextField('MetaTitle', 'Meta title'));
            }

            $fields->insertAfter(new TextareaField('Intro', 'Page Intro'), 'MenuTitle');

            // hero
            $fields->addFieldToTab('Root.Hero', UploadField::create('HeroImage'));

            $fields->addFieldsToTab('Root.Helpful', [
                LiteralField::create('WasThisHelpful', "<h4>Was this helpful ? {$this->HelpfulCounterYes} - YES | {$this->HelpfulCounterNo} - NO</h4>")
            ]);

            $fields->addFieldsToTab('Root.Dropdown', [
                TextField::create('DropDownMenuTitle')->setTitle('Title'),
                HtmlEditorField::create('DropDownCol1')->setTitle('Column 1 Content')->setRows(5),
                HtmlEditorField::create('DropDownCol2')->setTitle('Column 2 Content')->setRows(5),
                HtmlEditorField::create('DropDownCol3')->setTitle('Column 3 Content')->setRows(5),
                UploadField::create('DropDownImage'),
                TextField::create('DropDownImageText'),
                DropdownField::create('DropDownTarget')->setSource([
                    '_self' => 'Open in same window',
                    '_blank' => 'Open in a new window'
                ]),
                TreeDropdownField::create('DropDownPageID', 'Link to page', 'Page'),
                TextField::create('DropDownLink', '. or external link')
            ]);

            if ($elementalGridField = $fields->dataFieldByName('ElementArea')) {
                $configs = $elementalGridField->getConfig();
                $configs->removeComponentsByType(GridFieldDeleteAction::class);
            }

            $fields->removeByName('Contacts');

            $heroconf = GridFieldConfig_RelationEditor::create();
            $heroconf->addComponent(new GridFieldOrderableRows('SortOrder'));
            $herogridfield = GridField::create('RelatedPages', 'RelatedBoxes', $this->RelatedBoxes(), $heroconf);

            $fields->addFieldsToTab('Root.RelatedTopics', [
                TextField::create('RelatedTopicsTitle'),
                CheckboxField::create('ShowRelatedTopicsContacts')->setTitle('Show contacts'),
                GridField::create('RelatedPages', 'RelatedPages', $this->RelatedPages(), $heroconf),
                GridField::create('RelatedPages', 'RelatedPages', $this->RelatedBoxes(), $heroconf),



                HeaderField::create('ContactBox')->setTitle('Contact element details, if you dont wish to override these from the global settings, leave blank')->setHeadingLevel(4),
                /*TextField::create('ContactBoxTitle')->setTitle('Title'),
                TextareaField::create('ContactBoxContent')->setTitle('Content'),
                TextField::create('ContactBoxPhone')->setTitle('Phone'),
                TextField::create('ContactBoxEmail')->setTitle('Email'),*/
                //*****************************
                TextField::create('ContactBoxTitle')->setTitle('Title'),
                TextareaField::create('ContactBoxSubTitle')->setTitle('SubTitle'),


                //Contact 1
                HeaderField::create('ContactBox1')->setTitle('Contact 1'),

                HeaderField::create('ContactBox')->setTitle('Contact 1'),


                TextField::create('ContactBoxLocationName')->setTitle('LocationName'),
                TextareaField::create('ContactBoxContent')->setTitle('Location'),
                TextField::create('ContactBoxPhone')->setTitle('Phone'),
                TextField::create('ContactBoxEmail')->setTitle(Email::class),

                HeaderField::create('ContactBox2')->setTitle('Contact 2'),
                TextField::create('ContactBoxLocationName2')->setTitle('LocationName'),
                TextareaField::create('ContactBoxLocation2')->setTitle('Location'),
                TextField::create('ContactBoxPhone2')->setTitle('Phone 2'),
                TextField::create('ContactBoxEmail2')->setTitle('Email 2'),

                HeaderField::create('ContactBox3')->setTitle('Contact 3'),
                TextField::create('ContactBoxLocationName3')->setTitle('LocationName'),
                TextareaField::create('ContactBoxLocation3')->setTitle('Location'),
                TextField::create('ContactBoxPhone3')->setTitle('Phone 3'),
                TextField::create('ContactBoxEmail3')->setTitle('Email 3'),
            ]);

            $this->extend('updateCMSFieldsForImages', $fields);

            return $fields;
        }


        public function canView($member = null)
        {
            if ($this->URLSegment == SearchPage::class) {
                return true;
            }

            return parent::canView($member);
        }


        function canViewStage($stage = 'Live', $member = null)
        {
            if ($this->URLSegment == SearchPage::class)
                return true;

            return parent::canViewStage($stage, $member);
        }

        function HasRelatedTopics()
        {
            return $this->RelatedBoxes()->count() > 0 || $this->RelatedPages()->count() > 0;
        }


        function HasDropdownContents()
        {
            return $this->DropDownMenuTitle
                || $this->DropDownCol1
                || $this->DropDownCol2
                || $this->DropDownCol3
                || $this->DropDownImageID;
        }

        function BreadCrumbPages($maxDepth = 20, $unlinked = false, $stopAtPageType = false, $showHidden = false)
        {
            $page = $this;
            $pages = [];

            while (
                $page
                && (!$maxDepth || count($pages) < $maxDepth)
                && (!$stopAtPageType || $page->ClassName != $stopAtPageType)
            ) {
                if ($showHidden || $page->ShowInMenus || ($page->ID == $this->ID)) {
                    $pages[] = $page;
                }

                $page = $page->Parent;
            }

            $list = new ArrayList(array_reverse($pages));

            return $list;
        }

        /**
         * @return string
         */
        public function NavigationClass()
        {
            $classes = [
                'page'
            ];

            if ($this->HighlightInMenu) {
                // $classes[] = 'button';
            }


            if ($this->LinkOrSection() == 'section') {
                $classes[] = 'active';
            }

            return implode(' ', $classes);
        }


        public function HelpfulCounterPercentage()
        {
            $iTotal = $this->HelpfulCounterYes + $this->HelpfulCounterNo;

            return $iTotal == 0 ? 'N/A' : intval(($this->HelpfulCounterYes / $iTotal) * 100) . ' %';
        }

        public function getUseProductionAssets()
        {
            return false;
            // disabled due to issue with modals.
            // return (isset($_GET['production']) || Director::isLive());
        }

    }

}