<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace modulovych registru - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller_Admin_Cz_Environment_Registry_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    
    public function before() {
        $this->orm=new Model_Setting();
        parent::before();
        
    }

    protected function _column_definitions()
    {

        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("module_code")->type("edit")->label("Kód modulu")->set();
        $this->auto_edit_table->row("submodule_code")->type("edit")->label("Kód submodulu")->set();
        $this->auto_edit_table->row("value_code")->type("edit")->label("Kód hodnoty")->set();
        $this->auto_edit_table->row("value_subcode_1")->type("edit")->label("1. subkód hodnoty")->set();
        $this->auto_edit_table->row("value_subcode_2")->type("edit")->label("2. subkód hodnoty")->set();
        $this->auto_edit_table->row("value")->label("Hodnota")->type("edit")->css_class("txtLeft")->set();
        
        $this->auto_edit_table->row("description")->type("editor")->type("edit")->label("Text")->set();
        
    }

}