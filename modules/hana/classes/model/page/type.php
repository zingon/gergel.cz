<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Page_Type extends ORM
{
    protected $_has_many = array('routes' => array());

}
?>