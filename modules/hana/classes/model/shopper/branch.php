<?php defined('SYSPATH') or die('No direct script access.');


class Model_Shopper_Branch extends ORM
{
    protected $_belongs_to = array(
        'shopper' => array(),
    );
    protected $_filters = array(TRUE => array('strip_tags' => NULL));
    protected $_ignored_columns=array("branch_enabled");
    
    public $_rules = array(

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

	);

    
    public function temporarily_store()
    {
        $session=session::instance();
        $session->set("shopper_branch",$this->_object);

    }

    public function temporarily_load()
    {
        $session=session::instance();
        //$this->_object=$session->get("shopper_branch");
        $branch_data=$session->get("shopper_branch");
        if(!empty($branch_data))
        {
            $this->values($branch_data);
        }
        
        return $this;
    }

    public function destroy_temporarily_data()
    {
        unset($_SESSION["shopper_branch"]);
    }
}
?>
