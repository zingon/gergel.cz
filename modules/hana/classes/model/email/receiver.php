<?php defined('SYSPATH') or die('No direct script access.');

class Model_Email_Receiver extends ORM
{
    protected $_has_many = array('email_types' => array('through' => 'email_types_receivers'));

    protected $_rules = array(
		'nazev' => array(
			'not_empty'  => NULL,
		),
                'email' => array(
			'not_empty'  => NULL,
		),
	);
}

?>
