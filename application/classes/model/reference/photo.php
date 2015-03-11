<?php defined('SYSPATH') or die('No direct script access.');

class Model_Reference_Photo extends ORM_Language
{
    protected $_join_on_routes=false;
    
    protected $_belongs_to = array(
        'reference' => array(),
    );
}
