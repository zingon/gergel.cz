<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Servisni trida pro implementaci nakupniho kosiku.
 * Rozsireni katalogu o nákupní košík -> e-shop.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Service_Hana_ShoppingCart extends Service_Hana_Module_Base{

    static $navigation_module="page";
///////////////////////////////////////////////////////////// delegujici metody pro obsluhu nakupniho kosiku
    
    public static function add_to_cart($product_id, $quantity, $variety=false, $update=false, $new_variety=false)
    {
        $cart=Model_Cart::instance();
        return $cart->set_item($product_id, $quantity, $variety, $update, $new_variety);
    }

    public static function update_quantity($product_id, $quantity, $variety=false)
    {
        return self::add_to_cart($product_id, $quantity, $variety, true);
    }
    
    public static function change_variety($product_id, $old_variety, $new_variety, $amount)
    {
        return self::add_to_cart($product_id, $amount, $old_variety, true, $new_variety);
    }

    public static function remove_from_cart($product_id, $variety=false)
    {
        $cart=Model_Cart::instance();
        return $cart->remove_item($product_id, $variety);
    }

    public static function flush_cart()
    {
        $cart=Model_Cart::instance();
        $cart->flush();
        return true;
    }
    
    public static function get_cart()
    {
        return Model_Cart::instance();
    }

//////////////////////////////////////////////////////////////
    /**
     * 
     * @param type $cart_products
     * @param type $order_products
     * @return int 
     */
    
    public static function generate_cart_content_with_prices($cart_products, $order_products=array())
    {
        if(count($cart_products))
        {//die(print_r($cart_products));
            // prosty soucet cen produktu v kosiku bez slev
            $raw_cart_price_no_tax=0;       // soucet cen produktu s nulovou dani
            $raw_cart_price_lower_tax=0;    // soucet cen produktu s nizsi dani (cena s dani) 
            $raw_cart_price_higher_tax=0;   // soucet cen produktu s vyssi dani (cena s dani)

            $raw_cart_price_without_tax=0;  // soucet cen bez dane vsech produktu
            $raw_cart_price_with_tax=0;     // soucet cen s dani vsech produktu
            
            $product_voucher_discount=0;

            // soucty dani
            $raw_cart_lower_tax_value=0;    // soucty vsech hodnot nizsich dani
            $raw_cart_higher_tax_value=0;   // soucty vsech hodnot vyssich dani

            // viz predchozi skupina, se zapocitanim slev - polozky analogicky
            $total_cart_price_no_tax=0;
            $total_cart_price_lower_tax=0;  
            $total_cart_price_higher_tax=0;  

            $total_cart_price_without_tax=0;  
            $total_cart_price_with_tax=0;     

            $total_lower_tax_value=0;
            $total_higher_tax_value=0;
            
            $cena_celkem_bez_dph=0;
            $cena_celkem_s_dph=0;
            $celkem_polozek=0;
            $cart_products_full=array();

            foreach($cart_products as $cart_item_id=>$variety_amount)
            {
                if(!empty($order_products) && isset($order_products[$cart_item_id]) && $order_products[$cart_item_id])
                {
                    $product_model_name="order_item";
                    $cart_item_id=$order_products[$cart_item_id];
                }
                else
                {
                    $product_model_name="product";
                }

                $product_orm=orm::factory($product_model_name,$cart_item_id);
                if($product_model_name=="order_item")
                {
                    $tax_code=$product_orm->tax_code; 
                }
                else
                {
                    $tax_code=$product_orm->tax->code;
                }
                
                
                if($product_orm->gift) $variety_amount=1;
                        
                $amount=0;
                if(is_array($variety_amount))
                {
                    // mnozstvi, pokud jsou varianty (stejna cena za variantu)
                    foreach($variety_amount as $vty=>$variety_item_amount)
                    {
                        $amount+=$variety_item_amount;
                    }
                }
                else
                {
                    $amount=$variety_amount;
                }

                if($amount==0) continue; // pokud je mnozstvi 0 nema cenu pokracovat 

                
                
                
                // TODO - dodelat zjisteni kombinace variant k id
                $variety_array=array();    
                
                /* @var $product_prices Model_Product_Priceholder */
                $product_prices=$product_orm->prices(false,Service_Voucher::get_voucher()); // ziskame cenovy objekt produktu
                
                $cena_bez_dph=$product_prices->get_total_price_without_tax();
                $cena_s_dph=$product_prices->get_total_price_with_tax();
                
                // vypocet vyslednych cenovych hodnot jednoho produktu v kosiku - bez aplikace slevy v kosiku
                
                if($cena_s_dph>0)
                {
                    // darky s nulovou hodnotou se nezapocitavaji
                    $celkem_polozek+=$amount;
                }
                
                $cena_celkem_bez_dph+=(($cena_bez_dph) * $amount);
                
                $cena_polozek_produktu_s_dph=(($cena_s_dph) * $amount);
                $cena_celkem_s_dph+=$cena_polozek_produktu_s_dph;
                
                // sleva na kupon x pocet produktu
                $product_voucher_discount += ($product_prices->get_voucher_with_tax_discount_value() * $amount);

                
                // na zaklade kodu danove skupiny vygeneruju cenu pro konkretni danovou skupinu
                switch ($tax_code) {
                    case "no_vat":
                        // ceny bez slevy
                        $raw_cart_price_no_tax+=$cena_polozek_produktu_s_dph; // pro jistotu beru cenu s dani (mela by byt nulova)
                        break;

                    case "lower_vat":
                        // ceny bez slevy
                        $raw_cart_price_lower_tax+=$cena_polozek_produktu_s_dph;
                        $raw_cart_lower_tax_value+=$product_prices->get_total_tax_value() * $amount;
                        break;

                    case "higher_vat":
                        // ceny bez slevy
                        $raw_cart_price_higher_tax+=$cena_polozek_produktu_s_dph;
                        $raw_cart_higher_tax_value+=$product_prices->get_total_tax_value() * $amount;
                        break;
                }

                if(is_array($variety_amount))
                {
                   foreach($variety_amount as $variety_id=>$v_amount)
                   {
                       $cart_products_full[]=array(
                       "id"         =>($product_model_name=="product")?$product_orm->id:$product_orm->product_id,
                       "code"       =>$product_orm->code,
                       "varianta"=>!empty($variety_array[$variety_id])?$variety_array[$variety_id]:null,   
                       "nazev"      =>$product_orm->nazev,
                       "photo_src"      =>($product_model_name=="product")?$product_orm->photo_src:"",
                       "jednotka"   =>$product_orm->jednotka,
                       "percentage_discount"   =>($product_model_name=="product")?$product_orm->percentage_discount:0,
                       "hmotnost"           =>$product_orm->hmotnost,
                       "pocet_na_sklade"    =>($product_model_name=="product")?$product_orm->pocet_na_sklade:0,
                       "min_order_quantity" =>($product_model_name=="product")?$product_orm->min_order_quantity:0,
                       "tax_code"           =>$tax_code,
                       "nazev_seo"  =>($product_model_name=="product")?$product_orm->route->nazev_seo:"",
                       "mnozstvi"   =>$v_amount,
                       "cena_s_dph" =>$cena_s_dph,
                       "cena_bez_dph"=>$cena_bez_dph,
                       "cena_celkem_s_dph" =>$cena_s_dph * $v_amount,
                       "cena_celkem_bez_dph" =>$cena_bez_dph * $v_amount,
                    );
                   }    

                }
                else
                {
                    $cart_products_full[]=array(
                       "id"         =>($product_model_name=="product")?$product_orm->id:$product_orm->product_id,
                       "code"       =>$product_orm->code,
                       "varianta"   =>"N/A",
                       "nazev"      =>$product_orm->nazev,
                       "photo_src"      =>($product_model_name=="product")?$product_orm->photo_src:"",
                       "jednotka"   =>$product_orm->jednotka,
                       "percentage_discount"   =>($product_model_name=="product")?$product_orm->percentage_discount:0,
                       "hmotnost"           =>$product_orm->hmotnost,
                       "pocet_na_sklade"    =>($product_model_name=="product")?$product_orm->pocet_na_sklade:0,
                       "min_order_quantity" =>($product_model_name=="product")?$product_orm->min_order_quantity:0,
                       "tax_code"           =>$tax_code,
                       "nazev_seo"  =>($product_model_name=="product")?$product_orm->route->nazev_seo:"",
                       "mnozstvi"   =>$amount,
                       "cena_s_dph" =>$cena_s_dph,
                       "cena_bez_dph"=>$cena_bez_dph,
                       "cena_celkem_s_dph" =>$cena_s_dph * $amount,
                        "cena_celkem_bez_dph" => $cena_bez_dph * $amount,

                    );
                }   
            }
        

            $raw_cart_price_without_tax=$cena_celkem_bez_dph;  
            $raw_cart_price_with_tax=$cena_celkem_s_dph;     
            
            $result_data=array();
            $result_data["cart_prices"]   = compact(
                    "raw_cart_price_no_tax",
                    "raw_cart_price_lower_tax",
                    "raw_cart_price_higher_tax",
                    "raw_cart_lower_tax_value",
                    "raw_cart_higher_tax_value",
                    "raw_cart_price_without_tax",
                    "raw_cart_price_with_tax"
                    );
            
            ///////////////// zapocitani slev
            
            
            
            $result_data["cart_prices"] = self::calculate_cart_discount($result_data["cart_prices"]);
            
            // secteni slev na voucheru
            $result_data["cart_prices"]["total_cart_voucher_discount"]=$product_voucher_discount;
            

            //////////////////////////////////////////////////////////////
            
            // POZN: "raw" hodnoty jsou bez aplikovani slev "na kosiku" (slevy na produktu a slevy na objednavce se resi v prislusnych servisnich metodach)

            $result_data["cart_products"] = $cart_products_full;
            $result_data["total_items"]   = $celkem_polozek;

            //(print_r($result_data));
            return $result_data;
            
        }
    }
    
    
    protected static function calculate_cart_discount($cart_prices)
    {
        $cart_prices["total_cart_price_no_tax"]        =$cart_prices["raw_cart_price_no_tax"];
        $cart_prices["total_cart_price_lower_tax"]     =$cart_prices["raw_cart_price_lower_tax"];  
        $cart_prices["total_cart_price_higher_tax"]    =$cart_prices["raw_cart_price_higher_tax"];  

        $cart_prices["total_lower_tax_value"]          =$cart_prices["raw_cart_lower_tax_value"];
        $cart_prices["total_higher_tax_value"]         =$cart_prices["raw_cart_higher_tax_value"];

        $cart_prices["total_cart_price_without_tax"]   =$cart_prices["raw_cart_price_without_tax"];  
        $cart_prices["total_cart_price_with_tax"]      =$cart_prices["raw_cart_price_with_tax"];
        
        return $cart_prices;
    }
    
}
?>
