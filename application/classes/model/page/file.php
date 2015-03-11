<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Page_File extends ORM_Language {
    protected $_join_on_routes=false;

    protected $_belongs_to = array(
    	'page' => array(),
    );
}