<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace clanku - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Comments_Item_List extends Controller_Hana_List
{
   
    protected $default_order_by = "title";
    protected $default_order_direction= "asc";

    public function before() {
        $this->orm=new Model_Comment();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("datetime")->type("text")->label("Datum")->item_settings(array("special_format"=>"cz_date"))->css_class("txtLeft")->sequenceable()->filterable(array("type"=>"daterangepicker"))->width(150)->set();
        //$this->auto_list_table->column("title")->type("text")->label("Název")->css_class("txtLeft")->filterable()->sequenceable()->set();
        $this->auto_list_table->column("author")->label("Autor")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        $this->auto_list_table->column("email")->label("E-mail")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        $this->auto_list_table->column("produkt")->label("Produkt")->data_src(array("related_table_1"=>"product","column_name"=>"nazev"))->css_class("txtLeft")->sequenceable("produkt")->width(80)->filterable()->set();
        
        $this->auto_list_table->column("text_question")->label("Text dotazu")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        //$this->auto_list_table->column("text_response")->label("Text")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        
        $this->auto_list_table->column("nazev")->type("link")->label("")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->value("odpovědět")->width(100)->set();
        
        $this->auto_list_table->column("authorized")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable()->label("")->width(32)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->exportable(false)->printable(false)->set();
    }
    
    protected function _orm_setup()
    {
        $this->orm->join("products","left")->on("comments.product_id","=","products.id");
        $this->orm->join("product_data","left")->on("products.id","=","product_data.product_id");
        $this->orm->select(array("product_data.nazev","produkt"));//->select(array("price_categories_products.hodnota","cena"));
    }

}
?>
