<?php defined('SYSPATH') or die('No direct script access.');

class Model_Shipping extends ORM_Language
{
    
    protected $_has_many = array('payments' => array('through' => 'payments_shippings'));
}
?>
