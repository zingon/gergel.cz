<?php defined('SYSPATH') or die('No direct script access.');

class Model_Newsletter_Recipient extends ORM
{
  
    // Validation rules
    protected $_rules = array(
            'email' => array(
                    'not_empty'  => NULL,
                    'email'=>array(),
            )

    );
}
?>

