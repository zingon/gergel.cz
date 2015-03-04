<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Samostatna servisa k vypoctu cen do produktoveho katalogu (E-shopu)
 * - obsahuje hlavni metodu pro vypocet ceny a slevy primo na produktu
 * 
 */
class Service_Hana_Product_Price
{
    public static $price_code="D0";
    
    /**
     * Hlavni metoda pro generovani cen produktu.
     * @param type $product_orm
     * @param type $price_code
     * @return type 
     */
    public static function generate_product_prices($product_orm, $price_code, $voucher_distount=false)
    {
        if(!$price_code) $price_code=  Service_Product_Price::$price_code;
        $response=array();
        //echo("db-");
        // poradi prioritni cenova skupiny predana hodnota, hodnota v sesne, defaultni hodnota
 
        //die($price_code);
        // ignorovani slevy dane skupinou (pokud je action, nebo sale_off, bude se brat vzdy D0)
        if($product_orm->action==1 || $product_orm->sale_off==1)
        {
            $price_code="D0";
        }

        $price_category=$product_orm->price_categories->join("price_types")->on("price_categories.price_type_id","=","price_types.id")->select(array("price_types.kod","price_type_kod"))->select(array("price_categories_products.cena","value"))->where("price_categories.kod","=",$price_code)->find_all();
        $price_data=$price_category->current();

        if(!is_object($price_data))
        {
   
            // cena je dana procentem z D0 - neni tudiz pripojena ke konkretnim produktum, ale pocita se automaticky ke vsem
            $price_category=orm::factory("price_category")->join("price_types")->on("price_categories.price_type_id","=","price_types.id")->select(array("price_types.kod","price_type_kod"))->select(array("price_categories.hodnota","value"))->where("price_categories.kod","=",$price_code)->find_all();
            $price_data=$price_category->current();
            //$response["price_bez_dph=0; $response["price_s_dph=0; $response["price=0; return;
        }

        $price_type_kod=$price_data->price_type_kod;

        $product_tax=$product_orm->tax->hodnota;
        $response["tax_code"]=$product_orm->tax->code;

        $response["price"]=$price_data->value; 

//            //
//            if($voucher_discount_calculate && $product_orm->action==0 && $product_orm->sale_off==0)
//            {
//                $voucher_discount_value=Service_User::instance()->getVoucherPercentualValue();
//                //die("x".$price_data->hodnota." - pozadovana sleva:".$voucher_discount_value);
//            }
//            else
//            {
//                $voucher_discount_value=0;
//            }  
//            
//            if($raw_product_discount_calculate)
//            {    
//                $product_discount=$product_orm->percentage_discount;
//            }
//            else
//            {
//                $product_discount=0;
//            }
        // vypocteni ceny na zaklade typu ceny
        
        $price_data_D0=null;
  
        switch ($price_type_kod) {
            case "hodnota_s_dph":
//                $response["price_s_dph_bez_slevy"]=$price_data->value;
//                if($product_discount>0)$price_data->value=$price_data->value*(1-$product_discount/100);
                $response["price_bez_dph"]=(isset($price_data->value))?$price_data->value/(1+($product_tax/100)):0;
                $response["price_s_dph"]=(isset($price_data->value))?$price_data->value:0;
                break;
            case "hodnota_bez_dph":
                $response["price_bez_dph"]=(isset($price_data->value))?$price_data->value:0;
                $response["price_s_dph"]=(isset($price_data->value))?$price_data->value*(1+($product_tax/100)):0;
                break;
            case "sleva_procentem":
                // musim ziskat hodnotu D0 a zjistit zda je vyplnena s dani, nebo bez
                $price_category_D0=$product_orm->price_categories->join("price_types")->on("price_categories.price_type_id","=","price_types.id")->select(array("price_types.kod","price_type_kod"))->select(array("price_categories_products.cena","value"))->where("price_categories.kod","=","D0")->find_all();
                $price_data_D0=$price_category_D0->current();
                if(!is_object($price_data_D0)) return false;
                $price_type_kod_D0=$price_data_D0->price_type_kod;
                
                if(!isset($price_data_D0->value) || !isset($price_data->value) || !$price_data_D0->value || !$price_data->value) return false;

                
                if($price_type_kod_D0=="hodnota_s_dph")
                {

//                    $response["price_s_dph_bez_slevy"]=($price_data_D0->value)*(1-($price_data->value/100));
//                    if($price_data->value < $product_discount) $price_data->value=$product_discount; // pokud okamzita sleva je nizsi nez seleva ve skupine, poocita se s vyssi slevou
                    $response["price_bez_dph"]=($price_data_D0->value/(1+($product_tax/100)))*(1-($price_data->value/100));
                    $response["price_s_dph"]=($price_data_D0->value)*(1-($price_data->value/100));
                }
                elseif($price_type_kod_D0=="hodnota_bez_dph")
                {
//                    $response["price_s_dph_bez_slevy"]=($price_data_D0->value*(1+($product_tax/100)))*(1-($price_data->value/100));
//                    if($price_data->value < $product_discount) $price_data->value=$product_discount; // pokud okamzita sleva je nizsi nez seleva ve skupine, poocita se s vyssi slevou
                    
                    throw new Kohana_Exception("nutno upravit algoritmus vypoctu slevoveho kuponu (voucheru), nebo ho deaktivovat");
                    
                    $response["price_bez_dph"]=($price_data_D0->value)*(1-($price_data->value/100));
                    $response["price_s_dph"]=($price_data_D0->value*(1+($product_tax/100)))*(1-($price_data->value/100));
                }
                else
                {
                    throw new Kohana_Exception("Základní cena D0 nelze zadat procentem!");
                }
                break;
            default:
                    //throw new Kohana_Exception("Neznámý typ ceny");
                break;

            }
            
            //echo($response["voucher_dph_discount."<br />");
            
            // zapocteni slev TODO
            
            // sleva kuponem
            
            $response["price_s_dph_voucher_discount_value"]=0;
   
            if($voucher_distount)
            {
            
                // ziskame hodnotu D0, pokud jiz nebylo generovano
                if(!$price_data_D0)
                {
                    if($price_data->kod=="D0")
                    {
                        $price_data_D0=$price_data;
                    }
                    else
                    {
                        $price_category_D0=$product_orm->price_categories->join("price_types")->on("price_categories.price_type_id","=","price_types.id")->select(array("price_types.kod","price_type_kod"))->select(array("price_categories_products.cena","value"))->where("price_categories.kod","=","D0")->find_all();
                        $price_data_D0=$price_category_D0->current();
                    }
                }

                // vypocet slevy % z D0 ( pozor - bere se za to ze D0 je s dani TODO)  - pokud bude mensi nez cenova skupina - neuplatni se
                $response["voucher_price_s_dph"]=($price_data_D0->value)*(1-($voucher_distount->discount_value/100));//($price_data_D0->value*(1+($product_tax/100)))*(1-($voucher_distount->discount_value/100));
              
                if($response["price_s_dph"] > $response["voucher_price_s_dph"])
                {
                    
                    $response["price_s_dph_voucher_discount_value"]=$response["price_s_dph"] - $response["voucher_price_s_dph"];
                    
                    $response["price_s_dph"]=$response["voucher_price_s_dph"]; 
                    $response["price_bez_dph"]=($price_data_D0->value/(1+($product_tax/100)))*(1-($voucher_distount->discount_value/100));
                    $response["voucher_calculated"]=true;
                }
                else
                {
                    $response["voucher_calculated"]=false;
                }
                
            }else{$response["voucher_calculated"]=false;}
            
            $response["price_dph_value"]=$response["price_s_dph"]-$response["price_bez_dph"];
            
            
            $response["total_price_bez_dph"]=$response["price_bez_dph"];
            $response["total_price_s_dph"]=$response["price_s_dph"];
    
        return $response;
    }
    
    /**
     * Vrati hodnotu dane na zaklade jejiho kodu.
     * @param string $tax_code 
     */
    public static function get_tax_value($tax_code)
    {
        return DB::select("hodnota")->from("taxes")->where("code","=",$tax_code)->execute()->get('hodnota');
    }
    
    /**
     * Vrati kod cenove skupiny
     * @param string $price_category_orm
     * @param string $default
     * @return string 
     */
    public static function get_price_category_code($price_category_orm, $default="D0")
    {
        //if(isset($_SESSION["shopper_price_code"]) && $_SESSION["shopper_price_code"]) $price_code=$_SESSION["shopper_price_code"];
//        $user=Service_User::instance()->get_user();
//        if($user && $user->price_category_id)
//        {
//            $price_code=$user->price_category->kod;
//        }
        
        $price_code=$price_category_orm->kod;
        
        if(!$price_code) $price_code=$default;

        return $price_code;
    }
    
    /**
     * Vrati procentualni hodnotu cenove skupiny
     * @param type $price_category_orm
     * @return int 
     */
    public static function get_price_category_percentual_value($price_category_orm, $default=0)
    {
        $price_category_value=$price_category_orm->hodnota;
        
        if(!$price_category_value) $price_category_value=$default;

        return $price_category_value;
    }
    
    
    
}
?>
