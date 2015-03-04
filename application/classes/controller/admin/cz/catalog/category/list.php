<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace produktu - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Catalog_Category_List extends Controller_Hana_List
{
    protected $with_route=true;

    public function before() {
        $this->orm=new Model_Catalog_Category();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(80)->css_class("txtCenter")->sequenceable()->filterable(array("col_name"=>"product_categories.id"))->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit,"orm_tree_level_indicator"=>true))->css_class("txtLeft")->width(150)->sequenceable()->filterable()->set();
        $this->auto_list_table->column("popis")->label("Popis")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->sequenceable()->filterable()->set();
        //$this->auto_list_table->column("gallery_id")->label("Připojená fotogalerie")->data_src(array("related_table_1"=>"gallery","column_name"=>"nazev"))->css_class("txtLeft")->sequenceable()->filterable()->width(200)->set();
        if(Kohana::config("languages")->get("enabled"))
        $this->auto_list_table->column("available_languages")->type("languages")->item_settings(array("hrefid"=>$this->base_path_to_edit))->width(58)->set();
        
        $this->auto_list_table->column("poradi")->type("changeOrderShifts")->label("")->sequenceable()->width(32)->exportable(false)->printable(false)->set();
        $this->auto_list_table->column("zobrazit")->type("switch")->data_src(array("related_table_1"=>"route"))->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"routes.zobrazit"))->label("")->width(32)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->item_settings(array("readonly"=>"route"))->width(30)->exportable(false)->printable(false)->set();
    }

    

}
?>