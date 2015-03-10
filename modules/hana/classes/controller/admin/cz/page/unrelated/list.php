<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace nezarazenych stranek - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller_Admin_Page_Unrelated_List extends Controller_Admin_Page_Item_List
{
    protected $page_category_id=2;
    protected $order_mode=false;

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("controller")->label("Typ stránek")->data_src(array("related_table_1"=>"route","related_table_2"=>"module","column_name"=>"nazev"))->css_class("txtLeft")->sequenceable()->filterable()->width(120)->set();
        
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit,"orm_tree_level_indicator"=>true))->css_class("txtLeft")->filterable()->sequenceable()->width(200)->set();
        $this->auto_list_table->column("popis")->label("Popis")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        $this->auto_list_table->column("available_languages")->type("languages")->item_settings(array("hrefid"=>$this->base_path_to_edit))->width(60)->set();
        $this->auto_list_table->column("zobrazit")->type("switch")->data_src(array("related_table_1"=>"route"))->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"routes.zobrazit"))->label("")->width(32)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->item_settings(array("readonly"=>"route"))->width(30)->exportable(false)->printable(false)->set();
    }

}
?>