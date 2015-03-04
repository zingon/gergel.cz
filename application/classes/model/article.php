<?php defined('SYSPATH') or die('No direct script access.');

class Model_Article extends ORM_Language
{
    protected $_join_on_routes=true;
    
    protected $_has_many = array(
        'article_photos' => array(),
        'downloads'     => array('through' => 'article_downloads_articles'),
    );

    protected $_belongs_to = array(
        "gallery" => array()
    );


    // Validation rules
    protected $_rules = array(
            'nazev' => array(
            'not_empty'  => NULL,
            ),
    );

}
?>
