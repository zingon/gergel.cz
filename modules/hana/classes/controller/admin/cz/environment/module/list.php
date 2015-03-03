<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Admin_Cz_Environment_Module_List extends Controller_Hana_List
{
    
    public function before() {
        $this->orm=new Model_Module();
        $this->default_buttons[]=array("type"=>"submit","nazev"=>"Aktivovat","action"=>"save","onclick"=>"Aktivovat moduly? (vyvolá metodu module_setup() v servisní třídě modulů)");
        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("kod")->label("Kód")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->filterable()->sequenceable()->width(300)->set();
        $this->auto_list_table->column("popis")->label("Text")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        
        $this->auto_list_table->column("poradi")->type("changeOrderShifts")->label("")->sequenceable()->width(32)->exportable(false)->printable(false)->set();
        $this->auto_list_table->column("available")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"cancel.png","label"=>"neaktivní"),1=>array("image"=>"accept.png","label"=>"aktivní"))))->sequenceable()->filterable()->label("Povoleno")->width(80)->css_class("txtCenter")->set();
        $this->auto_list_table->column("admin_zobrazit")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"admin_zobrazit"))->css_class("txtCenter")->label("Zobrazit")->width(80)->set();
        $this->auto_list_table->column("selitem")->type("checkbox")->value(0)->label("")->width(30)->exportable(false)->printable(false)->set();
    }
    
    protected function _form_action_delete($data)
    {
        if($this->module_service->delete($data["selitem"],$this->with_route))
        {
            $this->data_saved="deleted";
            return true;
        }   
    }
    
    protected function _form_action_save($data)
    {
       die(print_r($data["selitem"]));
        
    }

}
?>
