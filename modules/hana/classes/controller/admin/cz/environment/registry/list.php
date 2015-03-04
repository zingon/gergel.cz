<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace modulovych registru - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller_Admin_Environment_Registry_List extends Controller_Hana_List
{
    protected $with_route=false;

    public function before() {
        $this->orm=new Model_Setting();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("module_code")->label("Kód modulu")->css_class("txtLeft")->filterable()->sequenceable()->width(110)->set();
        $this->auto_list_table->column("submodule_code")->label("Kód submodulu")->css_class("txtLeft")->filterable()->sequenceable()->width(115)->set();
        $this->auto_list_table->column("value_code")->label("Kód hodnoty")->css_class("txtLeft")->filterable()->sequenceable()->width(110)->set();
        $this->auto_list_table->column("value_subcode_1")->label("1. subkód hodnoty")->css_class("txtLeft")->filterable()->sequenceable()->width(110)->set();
        $this->auto_list_table->column("value_subcode_2")->label("2. subkód hodnoty")->css_class("txtLeft")->filterable()->sequenceable()->width(110)->set();
        $this->auto_list_table->column("value")->label("Hodnota")->css_class("txtLeft")->filterable()->sequenceable()->set();
        
        $this->auto_list_table->column("nazev")->type("link")->label("")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->value("změnit")->width(100)->set();
        $this->auto_list_table->column("description")->label("Popis")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        $this->auto_list_table->column("poradi")->type("changeOrderShifts")->label("")->sequenceable()->width(30)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->set();
    }
    
    protected function _form_action_default($data) {
        parent::_form_action_default($data);
        
        
    }



}
?>