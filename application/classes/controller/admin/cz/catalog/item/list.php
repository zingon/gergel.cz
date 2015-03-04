<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace jednoducheho produktoveho katalogu - list.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2013 Pavel Herink
 */

class Controller_Admin_Cz_Catalog_Item_List extends Controller_Hana_List
{
    protected $with_route=true;

    protected $default_order_by = "poradi";
    protected $default_order_direction= "asc";

    public function before() {
        $this->orm=new Model_Catalog();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(50)->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->width(200)->sequenceable("product_data.nazev")->filterable()->set();
        //$this->auto_list_table->column("product_category")->label("Kategorie")->data_src(array(/*"column_name"=>"pcd_nazev"*/"related_table_1"=>"product_categories","column_name"=>"nazev","order_by"=>array("product_category_data.nazev","asc"),"orm_tree"=>false,"multiple"=>true,"condition"=>array("language_id","=",1)))->width(250)->sequenceable("product_category_data.nazev")->filterable(array("col_name"=>"product_categories.id"))->set();
        //$this->auto_list_table->column("vyrobce")->label("Výrobce")->data_src(array("related_table_1"=>"manufacturer","column_name"=>"nazev"))->css_class("txtLeft")->sequenceable("vyrobce")->width(80)->filterable()->set();
        
        $this->auto_list_table->column("popis")->label("Text")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        $this->auto_list_table->column("fotogalerie")->type("relatedDetail")->label("Galerie")->data_src(array("db_query"=>db::select(array(db::expr("count(id)"),"count"))->from(strtolower($this->orm->class_name)."_photos"),"db_query_where_colid"=>"product_id"))->item_settings(array("hrefid"=>$this->base_path_to_gallery,"alt"=>"editovat fotogalerii","alt_empty"=>"vložit nové fotky do fotogalerie","image"=>"images.png","image_empty"=>"images_empty.png"))->width(40)->set();
        $this->auto_list_table->column("poradi")->type("changeOrderShifts")->label("")->sequenceable()->width(32)->exportable(false)->printable(false)->set();
        
        if(Kohana::config("languages")->get("enabled"))
        $this->auto_list_table->column("available_languages")->type("languages")->item_settings(array("hrefid"=>$this->base_path_to_edit))->width(58)->set();
        $this->auto_list_table->column("zobrazit")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"routes.zobrazit"))->label("")->width(32)->set();
        
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->exportable(false)->printable(false)->set();
    }
    
    protected function _orm_setup()
    {
        $this->orm->join("product_categories_products","left")->on("products.id","=","product_categories_products.product_id");
        $this->orm->join("product_categories","left")->on("product_categories.id","=","product_categories_products.product_category_id");
        $this->orm->join("product_category_data","left")->on("product_categories_products.product_category_id","=","product_category_data.product_category_id");
        // $this->orm->select(array("product_category_data.nazev","pcd_nazev"));
        //$this->orm->join("manufacturers","left")->on("products.manufacturer_id","=","manufacturers.id");
        //$this->orm->join("manufacturer_data","left")->on("products.manufacturer_id","=","manufacturer_data.manufacturer_id");
        $this->orm->join("routes")->on("product_data.route_id","=","routes.id");
        //$this->orm->join("price_categories_products","left")->on("products.id","=","price_categories_products.product_id");
        //$this->orm->join("price_categories","left")->on("price_categories_products.price_category_id","=","price_categories.id");
        //$this->orm->where("price_categories.kod","=","D0");
        $this->orm->distinct(array("product_data.nazev","nazev"));
        //$this->orm->select(array("manufacturer_data.nazev","vyrobce"));//->select(array("price_categories_products.hodnota","cena"));
    }

}
?>
