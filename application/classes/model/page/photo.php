<?php defined('SYSPATH') or die('No direct script access.');


class Model_Page_Photo extends ORM_Language
{
    public $join_on_routes=false;
    protected $_belongs_to = array('page' => array());

}
?>
