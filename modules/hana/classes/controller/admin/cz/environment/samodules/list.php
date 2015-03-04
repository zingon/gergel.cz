<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace stranek - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Environment_Samodules_List extends Controller_Hana_List
{

    public function before() {
        $this->orm=new Model_Admin_Structure();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("module_code")->label("Kód modulu")->css_class("txtLeft")->filterable()->sequenceable()->width(110)->set();
        $this->auto_list_table->column("submodule_code")->label("Kód submodulu")->css_class("txtLeft")->filterable()->sequenceable()->width(115)->set();
        $this->auto_list_table->column("module_controller")->label("Kontroler")->css_class("txtLeft")->filterable()->sequenceable()->width(110)->set();

        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit,"orm_tree_level_indicator"=>true))->css_class("txtLeft")->filterable()->sequenceable()->width(150)->set();
        $this->auto_list_table->column("popis")->label("Popis")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        if(Kohana::config("languages")->get("enabled"))
            $this->auto_list_table->column("available_languages")->type("languages")->item_settings(array("hrefid"=>$this->base_path_to_edit))->width(60)->set();

        $this->auto_list_table->column("poradi")->type("changeOrderShifts")->label("")->sequenceable()->width(30)->set();

        $this->auto_list_table->column("zobrazit")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable()->label("")->width(30)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->set();
    }
    
    protected function _form_action_default($data) {
        parent::_form_action_default($data);
        
        
    }



}
?>