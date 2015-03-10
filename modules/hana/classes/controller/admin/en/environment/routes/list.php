<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace rout - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller_Admin_Environment_Routes_List extends Controller_Hana_List
{
    protected $with_route=false;
    protected $default_order_by="nazev_seo";

    public function before() {
        $this->orm=new Model_Route();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(60)->css_class("txtLeft")->css_class(null)->sequenceable(array("col_name"=>"routes.id"))->filterable(array("col_name"=>"routes.id"))->set();
        
        $this->auto_list_table->column("nazev_seo")->type("link")->label("Název seo")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->sequenceable()->filterable()->set();
        $this->auto_list_table->column("modules")->label("Modul")/*->data_src(array("related_table_1"=>"module","column_name"=>"nazev"))*/->css_class("txtLeft")->sequenceable("modules.id")->width(80)->filterable()->set();
        
        $this->auto_list_table->column("module_action")->label("Akce")->css_class("txtLeft")->sequenceable()->filterable()->set();
        $this->auto_list_table->column("param_id1")->label("Parametr")->css_class("txtLeft")->sequenceable()->filterable()->set();
        
        $this->auto_list_table->column("baselang_route_id")->label("Baselang")->css_class("txtLeft")->sequenceable()->filterable()->set();
        $this->auto_list_table->column("language_id")->label("ID jazyku")->css_class("txtLeft")->sequenceable()->filterable()->set();
        
        
        $this->auto_list_table->column("read_only")->type("indicator")->label("Zapis.")->item_settings(array("states"=>array(0=>array("image"=>"accept.png","label"=>"zapisovatelná"),1=>array("image"=>"exclamation.png","label"=>"pro čtení"))))->css_class("txtCenter")->sequenceable()->filterable()->width(70)->set();
        $this->auto_list_table->column("internal")->type("indicator")->label("Veřejná")->item_settings(array("states"=>array(0=>array("image"=>"accept.png","label"=>"veřejná"),1=>array("image"=>"exclamation.png","label"=>"interní"))))->css_class("txtCenter")->sequenceable()->filterable()->width(70)->set();
        $this->auto_list_table->column("searcheable")->type("indicator")->label("Vyhled.")->item_settings(array("states"=>array(1=>array("image"=>"accept.png","label"=>"vyhledatelná"),0=>array("image"=>"exclamation.png","label"=>"nevyhledatelná"))))->css_class("txtCenter")->sequenceable()->filterable()->width(70)->set();
        $this->auto_list_table->column("deleted")->type("indicator")->label("Stav")->item_settings(array("states"=>array(0=>array("image"=>"accept.png","label"=>"aktivní"),1=>array("image"=>"exclamation.png","label"=>"smazáno"))))->css_class("txtCenter")->sequenceable()->filterable()->width(70)->set();
        
        $this->auto_list_table->column("nazev_seo_old")->label("Starý název seo")->css_class("txtLeft")->sequenceable()->filterable()->set();
        //$this->auto_list_table->column("deleted_date")->label("Datum smazání")->css_class("txtLeft")->sequenceable()->filterable()->set();
        
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->set();
    }
    
    protected function _orm_setup()
    {
        $this->orm->join("modules","left")->on("routes.module_id","=","modules.id");
        $this->orm->select(array("modules.nazev","modules"))->select("modules.id");//->select(array("price_categories_products.hodnota","cena"));
    }
    
    protected function _form_action_default($data) {
        parent::_form_action_default($data);
        
        
    }



}
?>