<?php defined('SYSPATH') or die('No direct script access.');


class Model_Product_Parameter extends ORM_Language
{
    public $join_on_routes=false;
    protected $_has_many = array('products' => array('through' => 'product_parameters_products'));
    protected $_belongs_to = array('product_parameters_type' => array());

    protected $_rules = array(
            'nazev' => array(
                    'not_empty'  => NULL,
            ),
    );

}
?>
