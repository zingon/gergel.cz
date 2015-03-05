<?php defined('SYSPATH') or die('No direct script access.');


class Model_Catalog_Category extends ORM_Language
{
    public $_class_name="Product_Category";

    protected $_join_on_routes=true;
    protected $_has_many = array(
        'products' => array('through' => 'product_categories_products'),
        'product_categories' => array('through' => 'product_categories'),
    );
    protected $_belongs_to = array(
        "gallery" => array()
    );


}
?>
