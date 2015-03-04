<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Shopper extends Model_Shauth_Shopper {

        public $check_password=true;

        // pokud jsou k uzivateli pripojeny pobocky
        protected $_has_many = array("shopper_branches"=>array());
        protected $_belongs_to = array("price_category"=>array());
        protected $_ignored_columns=array("obchodni_podminky","password_confirm");
        protected $_filters = array(TRUE => array('strip_tags' => NULL));

	// Validation rules
	public $_rules = array(
//		'username' => array(
//			'not_empty'  => NULL,
//			'min_length' => array(4),
//			//'max_length' => array(32),
//			//'regex'      => array('/^[-\pL\pN_.]++$/uD'),
//		),
		'password' => array(
			'not_empty'  => NULL,
			'min_length' => array(5),
			//'max_length' => array(42),
		),
		'password_confirm' => array(
			'matches'    => array('password'),
		),
		'email' => array(
			'not_empty'  => NULL,
			//'min_length' => array(4),
			//'max_length' => array(127),
			'email'      => NULL,
		),
                'nazev' => array(
			'not_empty'  => NULL,

		),
                'ulice' => array(
			'not_empty'  => NULL,

		),
                'mesto' => array(
			'not_empty'  => NULL,

		),
                'psc' => array(
			'not_empty'  => NULL,

		),
                'telefon' => array(
			'not_empty'  => NULL,

		),
                'obchodni_podminky' => array(
			'not_empty'  => NULL,

		),
	);

        // Validation callbacks
	public $_callbacks = array(
//		'username' => array('username_available'),
		'email' => array('email_available'),
	);
        
    public function temporarily_store()
    {
        $session=session::instance();
        $session->set("shopper",$this->_object);

    }

    public function temporarily_load()
    {
        $session=session::instance();
        $this->_object=$session->get("shopper");
    }

    public function destroy_temporarily_data()
    {
        unset($_SESSION["shopper"]);
    }
    
    public function check() {
        if(!$this->check_password)
        {
            $this->_rules["password"]=array();
            $this->_rules["password_confirm"]=array();
        }

        return parent::check();
    }


} // End User Model