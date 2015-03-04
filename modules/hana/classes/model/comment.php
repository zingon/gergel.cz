<?php defined('SYSPATH') or die('No direct script access.');

class Model_Comment extends ORM
{
    
    protected $_belongs_to = array(
        "product"=>array(),
    );
    
   // Validation rules
    protected $_filters = array(TRUE => array('strip_tags' => NULL));

    
    protected $_rules = array(
            'author' => array(
            'not_empty'  => NULL
            ),
            'text_question' => array(
            'not_empty'  => NULL,
            ),
    );

}
?>
