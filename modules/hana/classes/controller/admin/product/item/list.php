<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace produktu - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Item_List extends Controller_Hana_List
{
    protected $with_route=true;
    //protected $save_button="uložit změny";

    public function before() {
        $this->orm=new Model_Product();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->filterable(array("col_name"=>"products.id"))->set();
        //$this->auto_list_table->column("controller")->label("Typ stránek")->data_src(array("related_table_1"=>"route","related_table_2"=>"page_type","column_name"=>"nazev"))->css_class("txtLeft")->width(120)->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->width(200)->sequenceable("product_data.nazev")->filterable()->set();
        $this->auto_list_table->column("product_category")->label("Kategorie")->data_src(array(/*"column_name"=>"pcd_nazev"*/"related_table_1"=>"product_categories","column_name"=>"nazev","order_by"=>array("product_category_data.nazev","asc"),"orm_tree"=>false,"multiple"=>true))->width(250)->sequenceable("product_category_data.nazev")->filterable(array("col_name"=>"product_categories.id"))->set();
        //$this->auto_list_table->column("vyrobce")->label("Výrobce")->data_src(array("related_table_1"=>"manufacturer","column_name"=>"nazev"))->css_class("txtLeft")->sequenceable("vyrobce")->width(80)->filterable()->set();
        //$this->auto_list_table->column("cena")->label("Cena")->type("edit")->data_src(array("related_table_1"=>"price_categories","select"=>array("price_categories_products.hodnota","d0_hodnota"),"column_name"=>"d0_hodnota","condition"=>array("kod","=","D0"),"multiple"=>true))->item_settings(array("HTML"=>array("style"=>"width: 60px")))->width(65)->set();
        //$this->auto_list_table->column("pocet_na_sklade")->label("Sklad")->type("edit")->item_settings(array("HTML"=>array("style"=>"width: 70px")))->css_class("txtLeft")->width(80)->sequenceable()->set();
        $this->auto_list_table->column("uvodni_popis")->label("Popis")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->set();
        if(Kohana::config("languages")->get("enabled")) 
        $this->auto_list_table->column("available_languages")->type("languages")->item_settings(array("hrefid"=>$this->base_path_to_edit))->width(58)->set();
        $this->auto_list_table->column("fotogalerie")->type("relatedDetail")->label("Galerie")->data_src(array("db_query"=>db::select(array(db::expr("count(id)"),"count"))->from(strtolower($this->orm->class_name)."_photos"),"db_query_where_colid"=>"product_id"))->item_settings(array("hrefid"=>$this->base_path_to_gallery,"alt"=>"editovat fotogalerii","alt_empty"=>"vložit nové fotky do fotogalerie","image"=>"images.png","image_empty"=>"images_empty.png"))->width(40)->set();
        
        $this->auto_list_table->column("poradi")->type("changeOrderShifts")->label("")->sequenceable()->width(32)->exportable(false)->printable(false)->set();
        $this->auto_list_table->column("zobrazit")->type("switch")->data_src(array("related_table_1"=>"route"))->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"routes.zobrazit"))->label("")->width(32)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->item_settings(array("readonly"=>"route"))->width(30)->exportable(false)->printable(false)->set();
    }

    protected function _orm_setup()
    {
        $this->orm->join("product_categories_products","left")->on("products.id","=","product_categories_products.product_id");
        $this->orm->join("product_categories","left")->on("product_categories.id","=","product_categories_products.product_category_id");
        $this->orm->join("product_category_data","left")->on("product_categories_products.product_category_id","=","product_category_data.product_category_id");
        // $this->orm->select(array("product_category_data.nazev","pcd_nazev"));
        $this->orm->join("manufacturers","left")->on("products.manufacturer_id","=","manufacturers.id");
        $this->orm->join("manufacturer_data","left")->on("products.manufacturer_id","=","manufacturer_data.manufacturer_id");
        $this->orm->join("routes")->on("product_data.route_id","=","routes.id");
        //$this->orm->join("price_categories_products","left")->on("products.id","=","price_categories_products.product_id");
        //$this->orm->join("price_categories","left")->on("price_categories_products.price_category_id","=","price_categories.id");
        //$this->orm->where("price_categories.kod","=","D0");
        $this->orm->distinct(array("product_data.nazev","nazev"));
        $this->orm->select(array("manufacturer_data.nazev","vyrobce"));//->select(array("price_categories_products.hodnota","cena"));
    }

    // dodatecna definice akce na ulozeni

    protected function _form_action_save($data)
    {
        // ulozeni cen D0 k produktum
        $default_price_category_id=orm::factory("price_category")->where("kod","=","D0")->find()->id;
        foreach($data["cena"] as $item_id=>$value)
        {
            if($value!="")
            {
                $value=str_replace(",", ".", $value);
                if(is_numeric($value))
                {
                    $product_price = orm::factory("price_categories_product")->join("price_categories")->on("price_categories_products.price_category_id","=","price_categories.id")->where("product_id","=",$item_id)->where("kod","=","D0")->find();
                    //die(print_r($product_price));
                    $product_price->price_category_id = $default_price_category_id;
                    $product_price->product_id=$item_id;
                    $product_price->hodnota=$value;
                    $product_price->save();
                }
                else
                {
                    $this->error_rows[$item_id]=$item_id;
                }
            }
        }

        // ulozeni poctu na sklade
        foreach($data["pocet_na_sklade"] as $item_id=>$value)
        {
            if($value!="")
            {
                
                if(true/*!strpos(".",$value) && is_numeric($value)*/)
                {
                    $product=orm::factory("product",$item_id);
                    $product->pocet_na_sklade=$value;
                    $product->save();
                }
                else
                {
                    $this->error_rows[$item_id]=$item_id;
                }
            }
        }

        $this->data_saved=true;
    }

    

}
?>