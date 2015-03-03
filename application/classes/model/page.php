<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Page extends ORM_Language {
    protected $_join_on_routes=true;

//    protected $_created_column = array('column' => 'date_created', 'format' => 'Y-m-d H:i:s');
//    protected $_updated_column = array('column' => 'date_modified', 'format' => 'Y-m-d H:i:s');

protected $_has_many = array(
      'page_photos' => array(),
      'page_slideshows' => array(),
  );

    // Validation rules
	protected $_rules = array(
		'nazev' => array(
			'not_empty'  => NULL,
		),
	);

//	// Relationships
//	protected $_has_many = array(
//		'user_tokens' => array('model' => 'user_token'),
//		'roles'       => array('model' => 'role', 'through' => 'roles_users'),
//	);
//


//
//	// Validation rules
//	protected $_rules = array(
//		'username' => array(
//			'not_empty'  => NULL,
//			'min_length' => array(4),
//			'max_length' => array(32),
//			'regex'      => array('/^[-\pL\pN_.]++$/uD'),
//		),
//		'password' => array(
//			'not_empty'  => NULL,
//			'min_length' => array(5),
//			'max_length' => array(42),
//		),
//		'password_confirm' => array(
//			'matches'    => array('password'),
//		),
//		'email' => array(
//			'not_empty'  => NULL,
//			'min_length' => array(4),
//			'max_length' => array(127),
//			'email'      => NULL,
//		),
//	);
//
//	// Validation callbacks
//	protected $_callbacks = array(
//		'username' => array('username_available'),
//		'email' => array('email_available'),
//	);
//
//	// Field labels
//	protected $_labels = array(
//		'username'         => 'username',
//		'email'            => 'email address',
//		'password'         => 'password',
//		'password_confirm' => 'password confirmation',
//	);


}
?>
