<?php defined('SYSPATH') or die('No direct script access.');

class Model_Price_Categories_Product extends ORM
{
    protected $_belongs_to = array('price_category' => array(),'product' => array());

}
?>