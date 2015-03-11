<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace stranek - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller_Admin_Cz_Reference_Item_List extends Controller_Hana_List
{
    
    public function before() {
        $this->orm=new Model_Reference();
        parent::before();
    }


    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(50)->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit,"orm_tree_level_indicator"=>true))->css_class("txtLeft")->filterable()->sequenceable()->width(250)->set();
        $this->auto_list_table->column("popis")->label("Popis")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        $this->auto_list_table->column("fotogalerie")->type("relatedDetail")->label("Galerie")->data_src(array("db_query"=>db::select(array(db::expr("count(id)"),"count"))->from(strtolower($this->orm->class_name)."_photos"),"db_query_where_colid"=>"reference_id"))->item_settings(array("hrefid"=>$this->base_path_to_gallery,"alt"=>"editovat fotogalerii","alt_empty"=>"vložit nové fotky do fotogalerie","image"=>"images.png","image_empty"=>"images_empty.png"))->width(40)->exportable(false)->set();
        if(Kohana::config("languages")->get("enabled"))
        $this->auto_list_table->column("available_languages")->type("languages")->item_settings(array("hrefid"=>$this->base_path_to_edit))->width(60)->set();
        $this->auto_list_table->column("zobrazit")->type("switch")->data_src(array("related_table_1"=>"route"))->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"routes.zobrazit"))->label("")->width(32)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->item_settings(array("readonly"=>"route"))->width(30)->exportable(false)->printable(false)->set();
    }

    protected function _orm_setup()
    {
        $this->orm->join("routes")->on("reference_data.route_id","=","routes.id");
    }
    

    

}
