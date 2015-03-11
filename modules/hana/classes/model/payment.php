<?php defined('SYSPATH') or die('No direct script access.');

class Model_Payment extends ORM_Language
{
  
    protected $_has_many = array('shippings' => array('through' => 'payments_shippings'));
}
?>
