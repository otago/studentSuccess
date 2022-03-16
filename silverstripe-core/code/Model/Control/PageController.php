<?php
use OP\studentsuccess\ShortCodeUtils;
use SilverStripe\ORM\FieldType\DBDatetime;
use SilverStripe\Control\Cookie;
use SilverStripe\ORM\DB;
use SilverStripe\CMS\Controllers\ContentController;


class PageController extends ContentController {

private static $allowed_actions = array(
'helpfulyes',
'helpfulno',
'SearchResults'
);

public function Content() {
return ShortCodeUtils::ParseShortCodes($this->Content);
}

public function Year() {
return date('Y', strtotime(DBDatetime::now()));
}


public function helpfulyes() {
if(!Cookie::get('VotedYes'. $this->ID)) {
DB::query("UPDATE Page SET HelpfulCounterYes = (HelpfulCounterYes + 1)");
DB::query("UPDATE Page_Live SET HelpfulCounterYes = (HelpfulCounterYes + 1)");

Cookie::set('VotedYes'. $this->ID);
}

return $this->redirectBack();
}

public function helpfulno() {
if(!Cookie::get('VotedNo'. $this->ID)) {
DB::query("UPDATE Page SET HelpfulCounterNo = (HelpfulCounterNo + 1)");
DB::query("UPDATE Page_Live SET HelpfulCounterNo = (HelpfulCounterNo + 1)");

Cookie::set('VotedNo'. $this->ID);
}

return $this->redirectBack();
}

}