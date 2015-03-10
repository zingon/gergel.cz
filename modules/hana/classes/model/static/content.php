<?php defined('SYSPATH') or die('No direct script access.');

class Model_Static_Content extends ORM_Language
{
    public $join_on_routes=false;
    
    protected $_table_name="static_content";
    // Validation rules
    protected $_rules = array(
            'kod' => array(
                    'not_empty'  => NULL,
            ),
    );
}
?>