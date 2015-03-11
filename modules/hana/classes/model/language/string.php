<?php defined('SYSPATH') or die('No direct script access.');

class Model_Language_String extends ORM_Language
{
    protected $_join_on_routes=false;
    
    
    // Validation rules
    protected $_rules = array(
            'string' => array(
            'not_empty'  => NULL,
            ),
    );

}
?>

