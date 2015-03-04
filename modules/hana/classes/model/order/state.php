<?php defined('SYSPATH') or die('No direct script access.');

class Model_Order_State extends ORM_Language
{
    public $join_on_routes=false;
    protected $_has_many = array('orders' => array('through' => 'order_states'));
}

?>

