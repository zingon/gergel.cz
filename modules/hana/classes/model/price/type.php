<?php defined('SYSPATH') or die('No direct script access.');

class Model_Price_Type extends ORM
{
    protected $_has_many = array('price_categories' => array());

}
?>
