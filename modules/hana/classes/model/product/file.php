<?php defined('SYSPATH') or die('No direct script access.');


class Model_Product_File extends ORM_Language
{
    public $join_on_routes=false;
    protected $_belongs_to = array('product' => array());

   
}
?>