<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace clanku - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_banner_Item_List extends Controller_Hana_List
{
    protected $with_route=false;

    
    public function before() {
        $this->orm=new Model_Banner();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("url")->type("text")->label("Adresa")->css_class("txtLeft")->filterable()->sequenceable()->set();
        //$this->auto_list_table->column("popis")->label("Text")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        //$this->auto_list_table->column("fotogalerie")->type("relatedDetail")->label("Galerie")->data_src(array("db_query"=>db::select(array(db::expr("count(id)"),"count"))->from(strtolower($this->orm->class_name)."_photos"),"db_query_where_colid"=>"banner_id"))->item_settings(array("hrefid"=>$this->base_path_to_gallery,"alt"=>"editovat fotogalerii","alt_empty"=>"vložit nové fotky do fotogalerie","image"=>"images.png","image_empty"=>"images_empty.png"))->width(40)->set();
        $this->auto_list_table->column("editovat")->type("link")->label("")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->value("editovat")->width(100)->set();
        $this->auto_list_table->column("poradi")->type("changeOrderShifts")->label("")->sequenceable()->width(32)->exportable(false)->printable(false)->set();
        $this->auto_list_table->column("zobrazit")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"routes.zobrazit"))->label("")->width(32)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->exportable(false)->printable(false)->set();
    }
    
   
}
?>
