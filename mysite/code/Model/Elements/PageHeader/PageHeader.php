<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 1:55 PM
 * To change this template use File | Settings | File Templates.
 */

class PageHeader extends BaseElement {

	private static $title = "Page Header";
	private static $description = "Page header, which can be used on the top of the page to show a header section";

	private static $db = array(
		'DisplayTitle'		=> 'Varchar(300)',
		'Intro'				=> 'Text',
		'LeftAlign'			=> 'Boolean'
	);

} 