<?php defined('SYSPATH') or die('No direct script access.');

class Model_Price_Category extends ORM
{
    protected $_has_many = array('products' => array('through' => 'price_categories_products'));
    protected $_belongs_to = array('price_type' => array());
}
?>
