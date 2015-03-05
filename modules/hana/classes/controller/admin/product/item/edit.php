<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace produktu - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Item_Edit extends Controller_Hana_Edit
{
    protected $with_route=true;
    protected $image_dir;
    
    protected $subject;
    protected $subject_col_id_name;
    protected $subject_files_name;
    protected $item_name_property=array("nazev"=>"s názvem");
    
    public function before() {
        $this->orm=new Model_Product();
        $this->action_buttons=array_merge($this->action_buttons,array("odeslat_2"=>array("name"=>"odeslat_na_dalsi","value"=>"odeslat a editovat další"),"odeslat_3"=>array("name"=>"odeslat_3","value"=>"odeslat a editovat galerii","hrefid"=>"product/item/gallery/")));
        parent::before();
        // automaticky generovany image-dir - bude stejny pro vsechny moduly ve vychozim stavu
        $this->image_dir=$this->module_key."/".$this->submodule_key."/";
        $this->subject=strtolower($this->orm->class_name);
        $this->subject_col_id_name=$this->subject."_id";
        $this->subject_files_name=$this->subject."_file";
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
        $this->auto_edit_table->row("k_prodeji")->type("checkbox")->label("Produkt je určen k prodeji")->set();
        $this->auto_edit_table->row("code")->type("edit")->label("Kód produktu")->set();
        //$this->auto_edit_table->row("rok_vyroby")->type("edit")->label("Rok výroby")->set();
        //$this->auto_edit_table->row("pocet_na_sklade")->type("edit")->label("Počet na skladě")->set();
        //$this->auto_edit_table->row("puvodni_cena")->type("edit")->label("Původní cena")->set();
        $this->auto_edit_table->row("product_category_id")->type("selectbox")->label("Kategorie")->item_settings(array("HTML"=>array("multiple"=>"multiple","style"=>"height: 200px")))->data_src(array("related_table_1"=>"product_categories","column_name"=>"nazev","orm_tree"=>true,"multiple"=>true))->set();
        //$this->auto_edit_table->row("manufacturer_id")->type("selectbox")->label("Výrobce")->data_src(array("related_table_1"=>"manufacturer","column_name"=>"nazev","condition"=>array("zobrazit","=",1),"orm_tree"=>false))->set();
        
        $this->auto_edit_table->row("nazev_seo")->type("edit")->data_src(array("related_table_1"=>"route"))->label("Název SEO")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        $this->auto_edit_table->row("description")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("keywords")->type("edit")->label("Klíčová slova")->set();
        $this->auto_edit_table->row("vykon")->type("edit")->label("Výkon")->set();
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->default_value(1)->label("Zobrazit")->set();
        
        $this->auto_edit_table->row("zobrazit_carousel")->type("checkbox")->label("Zobrazit v carouselu")->set();
        $this->auto_edit_table->row("main_image_src")->type("filebrowser")->label("Zdroj obrázku")->set();
        $this->auto_edit_table->row("main_image")->type("image")->item_settings(array("dir"=>$this->image_dir,"suffix"=>"at","ext"=>"jpg","delete_link"=>true))->label("Náhled obrázku")->set();
        
        
        $this->auto_edit_table->row("gift")->css_class("giftCheckbox")->type("checkbox")->label("Produkt je dárek")/*->condition("(Dárek bude nabídnut k nákupu zdarma, překročí-li hodnota zboží v košíku mez nastavenou v \"nastavení eshopu\")")*/->set();
        
        $this->auto_edit_table->row("gift_threshold_price")->type("edit")->css_class("giftPrice")->label("Dárek - minimální hodnota nákupu")->set();
        
//        $this->auto_edit_table->row("L2")->variant("one_col")->value("Soubory připojené k produktu")->type("label")->set();
//        if($this->orm->id)
//        {
//            $this->auto_edit_table->row("product_file")->item_settings(array("orm"=>$this->orm,"title"=>"Soubor","item"=>"nazev","description"=>"","value"=>array("product_file_data.nazev","phodnota"),"files_order_by"=>array("nazev"=>"asc")))->value("Seznam souborů")->type("microeditfile")->set();
//        }
//        else
//        {
//            $this->auto_edit_table->row("L12")->value("Před přidáváním souborů musí být produkt nejprve uložen")->type("text")->set();
//        }

        $this->auto_edit_table->row("L1")->variant("one_col")->value("Seznam cen")->css_class("prices")->type("label")->set();
      
        if($this->orm->id)
        {
            $this->auto_edit_table->row("price_category")->css_class("prices")->item_settings(array("orm"=>$this->orm,"title"=>"Cenová skupina","item"=>"kod","description"=>"popis","value"=>array("price_categories_products.hodnota","phodnota"),"parameters_order_by"=>array("kod"=>"asc")))->value("Seznam cen")->type("innerpriceeditparam")->set();
        }
        else
        {
            $this->auto_edit_table->row("L11")->value("Před přidáváním cen musí být produkt nejprve uložen")->type("text")->css_class("prices")->set();
        }

        $this->auto_edit_table->row("tax_id")->type("selectbox")->label("Daň %")->css_class("prices")->default_value(3)->data_src(array("related_table_1"=>"tax","column_name"=>"hodnota","order_by"=>array("id","desc"),"orm_tree"=>false))->set();
        $this->auto_edit_table->row("jednotka")->type("selectbox")->label("Jednotka")->data_src(array("data_array"=>array("ks"=>"ks","bm"=>"bm")))->set();
        $this->auto_edit_table->row("availability")->type("selectbox")->label("Dostupnost")->data_src(array("data_array"=>array("Není skladem"=>"Není skladem","Skladem"=>"Skladem","Do týdne"=>"Do týdne","Do měsíce"=>"Do měsíce")))->set();

        //$this->auto_edit_table->row("prices")->value("")->type("microedit")->label("Editace cen")->set();

//        $this->auto_edit_table->row("L2")->variant("one_col")->value("Seznam parametrů")->type("label")->set();
//
//        if($this->orm->id)
//        {
//            $this->auto_edit_table->row("product_parameter")->item_settings(array("orm"=>$this->orm,"title"=>"Parametr","item"=>"nazev","description"=>"","value"=>array("product_parameters_products_data.hodnota","phodnota"),"join"=>"product_parameters_products_data","on"=>array("product_parameters_products.id","=","product_parameters_products_data.product_parameters_products_id"),"parameters_order_by"=>array("nazev"=>"asc")))->value("Seznam parametrů")->type("microeditparam")->set();
//        }
//        else
//        {
//            $this->auto_edit_table->row("L12")->value("Před přidáváním parametrů musí být produkt nejprve uložen")->type("text")->set();
//        }
        $this->auto_edit_table->row("L2")->variant("one_col")->value("Popis produktu")->type("label")->set();
        
        $this->auto_edit_table->row("uvodni_popis")->type("editor")->label("Úvodní text")->set();
        $this->auto_edit_table->row("popis")->type("editor")->label("Text")->set();
        $this->auto_edit_table->row("odborne_informace")->type("editor")->label("Odborné informace")->set();
        
        $this->auto_edit_table->row("L3")->variant("one_col")->value("Akce svázaná s produktem")->type("label")->set();
        
        // pozor: klice akci nemenit, jsou svazany s kodem!!
        $this->auto_edit_table->row("product_action_type")->type("selectbox")->data_src(array("data_array"=>array(0=>"--žádná--",1=>"akce",2=>"novinka",3=>"dárek")))->label("Typ akce")->set();
        $this->auto_edit_table->row("akce_text")->type("editor")->label("Text akce")->set();
        
        
        $jquery='
            $(document).ready(function(){
                if($("#item_gift input").is(":checked")){
                    $(".giftPrice").show();
                    $(".prices").hide();
                }else{
                    $(".prices").show();
                    $(".giftPrice").hide();
                }

                $("#item_gift").change(function(){
                    if($("#item_gift input").is(":checked")){
                        $(".giftPrice").show();
                        $(".prices").hide();
                    }else{
                        $(".prices").show();
                        $(".giftPrice").hide();
                    }
                });
            });
        
        ';
        $this->auto_edit_table->add_script($jquery);
        
    }

    protected function _form_action_main_prevalidate($data) {

        parent::_form_action_main_prevalidate($data);
        // specificka priprava dat, validace nedatabazovych zdroju (pripony obrazku apod.)
        if(!$data["title"] && $data["nazev"]){$data["title"]=$data["nazev"];}
        
        if(!$data["nazev_seo"] && $data["nazev"]){
            $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev"]); $data["nazev_seo"]=$data["nazev_seo"];
        }elseif($data["nazev_seo"]){
            $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev_seo"]);
        }

        
        // defaultni akce v routes
        $data["module_action"]="detail";
        $data["module_id"]=orm::factory("module")->where("kod","=","product")->find()->id;


        // jednoduche ocheckovani formatu zadanych cen
        $prices_check=true;
        if(isset($data["price_category"]))
        foreach($data["price_category"] as $pcat=>$pcatval)
        {
            $pcatval = str_replace(",", ".", $pcatval);
            if($pcatval=="") $pcatval=0;
            if(!is_numeric($pcatval)) $prices_check=false;
        }

        if(!$prices_check)
        {
            $this->data_processing_errors["L1"]="U některé z cen nebylo zadáno číslo ($pcatval), byla ponechána původní hodnota."; $this->data_saved=false;
        }

        return $data;
    }

    protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);
       // ulozim k produktu reference na vybrane kategorie
       $this->module_service->bind_categories($data['product_category_id'],'product_category','product_categories');

       
// vlozim o obrazek
       if(isset($_FILES["main_image_src"]) && $_FILES["main_image_src"]["name"])
       {
           // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
           $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo");
           $this->module_service->insert_image("main_image_src", $this->image_dir, $image_settings, $this->orm->route->nazev_seo);
       }
       if(isset($_FILES["mainpage_image_src"]) && $_FILES["mainpage_image_src"]["name"])
       {
           // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
           $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo-mainpage");
           $this->module_service->insert_image("mainpage_image_src", $this->subject_dir."/mainpage/", $image_settings, $this->orm->route->nazev_seo."-mainpage", true, "jpg", "photo_mainpage_src");
       }
       
       // pokusim se vlozit cenove skupiny
       if(isset($data["price_category"]))
       {
           foreach($data["price_category"] as $pcat=>$pcatval)
           {
                $price_add_result=$this->module_service->insert_price_category($pcat,$pcatval);
           }
       }
    }

    /**
     * Akce na smazani obrazku !
     * @param <type> $data
     */
    protected function _form_action_main_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], $this->image_dir);
    }

    /**
     * Akce na pridani ceny
     * @param <type> $data
     */
    protected function _form_action_microedit_product_parameter_add($data)
    {
        if($data["microedit_param_item_id"]) $this->module_service->insert_product_parameter($data["microedit_param_item_id"],$data["microedit_param_value"],$data["microedit_param_edit_id"]);
        $this->data_saved=true;

    }

     protected function _form_action_microedit_product_parameter_delete($data)
    {
        
        if($data["microedit_param_delete_id"]) $this->module_service->delete_product_parameter($data["microedit_param_delete_id"]);
    }
   
    protected function _form_action_mainpage_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], $this->subject_dir."/mainpage/",false,false,false,"photo_mainpage_src");
    }

//    protected function _form_action_microedit_price_category_add($data)
//    {
//        if($data["microedit_param_item_id"]) $this->module_service->insert_price_category($data["microedit_param_item_id"],$data["microedit_param_value"],$data["microedit_param_edit_id"]);
//    }

//    protected function _form_action_microedit_price_category_delete($data)
//    {
//
//        if($data["microedit_param_delete_id"]) $this->module_service->delete_price_category($data["microedit_param_delete_id"]);
//    }

    protected function _form_action_microedit_product_file_add($data)
    {
        $errors="";
        // primitivni predvalidovani dat
        //if(!$data["nazev"]) $errors["nazev"]="musí být zadán název";
        if(!$data["file_id"])
        {
            // prvni zadavani - musi byt zdroj obrazku a pokud neni nazev, vytvori se z tohoto zdroje
            if(!$_FILES['microedit_file_src']["name"]) $errors["src"]="musí být vybrán soubor obrázku";
            if(empty($errors) && !$data["nazev"]) $data["nazev"]=Service_Hana_File::get_raw_file_name($_FILES['microedit_file_src']['name']);
        }
        else
        {
            // editace - nemusi byt zdroj obrazku

            if(!$_FILES['microedit_file_src']["name"])
            {
                // 1) neni obrazek - musi byt nazev
                if(!$data["nazev"]) $errors["nazev"]="název obrázku musí být zadán";
            }
            else
            {
                // 2) je obrazek - pokud neni nazev - pouziju opet nazev z obrazku
                if(!$data["nazev"]) $data["nazev"]=Service_Hana_File::get_raw_file_name($_FILES['microedit_file_src']['name']);
            }

        }
        // validace probehly, data jsou predzpracovana, prejdu k procesu jejich ulozeni

        // vlastni zpracovani dat
        if(empty($errors))
        {
            
            // ziskani vychoziho ormka v zavislosti na tom, zda jde o editaci nebo novou polozku
            if($data["file_id"])
            {
                $subject_files=orm::factory($this->subject_files_name)->language($this->orm->selected_language_id)->where($this->subject."_files.id","=",$data["file_id"])->find();
               
            }
            else
            {
                $subject_files=orm::factory($this->subject_files_name)->language($this->orm->selected_language_id);
            }

            // predam data ke zpracovani a ulozeni modulove servise
            $result=$this->module_service->insert_file($subject_files, $this->subject_col_id_name, $this->item_id, "microedit_file_src", $this->subject_dir, $data);
        }

        // pokud servisa vrati chybu, pridam ji do chyb
        if(isset($result) && $result !== true) $errors=$result;

        // zhodnoceni vysledku
        if($errors)
        {
            // neuspesne zpracovani dat
            $this->data_processing_errors=$errors; // nastaveni chyby
            $data["action"]="main_gallery_editphoto"; // toto nastaveni zpusobi, ze se otevre znovu dialogove okno
            return($data);

        }
        else
        {
            // uspesne zpracovani dat
            $this->data_saved=true;
        }
    }

    protected function _form_action_microedit_product_file_delete($data)
    {
        $orm=orm::factory($this->subject_files_name);
        $this->module_service->delete_file($data["delete_file_id"], $this->subject_dir, $orm, $this->subject_col_id_name);
        $this->data_saved=true;
    }
}