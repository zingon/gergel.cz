<?php defined('SYSPATH') or die('No direct script access.');

class Model_Email_Type extends ORM
{

    protected $_has_many = array('email_receivers' => array('through' => 'email_types_receivers'));

    protected $_rules = array(
		'nazev' => array(
			'not_empty'  => NULL,
		),
                'code' => array(
			'not_empty'  => NULL,
		),
                
	);
}

?>
