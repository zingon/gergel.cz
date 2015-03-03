<?php defined('SYSPATH') or die('No direct script access.');

class Model_Shipping_Pricelevel extends ORM
{
    public $join_on_routes=false;
    protected $_belongs_to = array('shipping' => array());
}
?>