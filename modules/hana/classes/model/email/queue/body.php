<?php defined('SYSPATH') or die('No direct script access.');

class Model_Email_Queue_Body extends ORM
{
    protected $_has_many = array('email_queues' => array());
}

?>
