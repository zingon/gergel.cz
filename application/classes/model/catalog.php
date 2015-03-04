<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Zjednoduseny model pro produkty katalogu. E-shop pouziva Model_Product. 
 */
class Model_Catalog extends ORM_Language
{
    public $_class_name="Product";

    protected $_join_on_routes=true;

    protected $_has_many = array(
        'product_categories' => array('through' => 'product_categories_products','foreign_key' => 'product_id'),
        'product_photos' => array('foreign_key' => 'product_id'),
    );

    protected $_belongs_to = array(
        "product_category"=>array(),
        "manufacturer"=>array(),
    );

    // Validation rules
    protected $_rules = array(
        'nazev' => array(
            'not_empty'  => NULL,
        ),
    );

}
?>

