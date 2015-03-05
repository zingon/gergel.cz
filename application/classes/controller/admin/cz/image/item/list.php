<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Administrace clanku - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Image_Item_List extends Controller_Hana_List
{
    public function before() {
        $this->orm=new Model_Image();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(50)->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->filterable()->sequenceable()->width(300)->set();
        $this->auto_list_table->column("title")->label("Titulek")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        if(Kohana::config("languages")->get("enabled"))
            $this->auto_list_table->column("available_languages")->type("languages")->item_settings(array("hrefid"=>$this->base_path_to_edit))->width(58)->set();
        $this->auto_list_table->column("zobrazit")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->label("")->width(32)->set();

        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->exportable(false)->printable(false)->set();
    }
}
?>
