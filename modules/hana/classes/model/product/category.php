<?php defined('SYSPATH') or die('No direct script access.');


class Model_Product_Category extends ORM_Language
{
    protected $_join_on_routes=true;
    protected $_has_many = array(
        'products' => array('through' => 'product_categories_products'),
        'product_categories' => array('through' => 'product_categories')
    );

}
?>
