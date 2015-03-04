<?php defined('SYSPATH') or die('No direct script access.');


class Model_Manufacturer extends ORM_Language
{
    protected $_join_on_routes=true;
    protected $_has_many = array(
        'products' => array(),
    );


}
?>
