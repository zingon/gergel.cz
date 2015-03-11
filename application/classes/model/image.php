<?php defined('SYSPATH') or die('No direct script access.');

class Model_Image extends ORM_Language
{
    // Validation rules
    protected $_rules = array(
        'nazev' => array(
            'not_empty'  => NULL,
        ),
    );

}
?>
