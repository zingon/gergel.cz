<?php defined('SYSPATH') or die('No direct script access.');

class Model_Admin_Structure extends ORM_Language
{
    protected $_table_name="admin_structure";
    protected $_table_columns = array("id"=>array(),"available_languages"=>array(),"module_code"=>array(),"submodule_code"=>array(),"module_controller"=>array(),"admin_menu_section_id"=>array(),"poradi"=>array(),"parent_id"=>array(),"zobrazit"=>array(),"global_access_level"=>array());
    protected $_language_columns = array("id"=>array(),"admin_structure_id"=>array(),"language_id"=>array(),"nazev"=>array(),"nadpis"=>array(),"title"=>array(),"description"=>array(),"keywords"=>array(),"popis"=>array());
    
    
    protected $_rules = array(
		'nazev' => array(
			'not_empty'  => NULL,
		),
                'module_code' => array(
			'not_empty'  => NULL,
		),
                'submodule_code' => array(
			'not_empty'  => NULL,
		),
                'module_controller' => array(
			'not_empty'  => NULL,
		),
	);

}
?>
