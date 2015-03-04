<?php defined('SYSPATH') or die('No direct script access.');

class Model_Unrelated_Page extends ORM_Language
{
    public $join_on_routes=true;

    // Validation rules
    protected $_rules = array(
            'nazev' => array(
                    'not_empty'  => NULL,
            ),
    );
}
?>