<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 *
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Service_Hana_Payment
{
    public static function get_selected_payment_id()
    {
        return Session::instance()->get("payment_id",false);
    }
    
    public static function set_payment_id($payment_id)
    {
        Session::instance()->set("payment_id", $payment_id);
    }
    
    public static function get_selected_payment_orm()
    {
        $payment_id = self::get_selected_payment_id();
        
        if($payment_id)
        {
            return orm::factory("payment",$payment_id);
        }
        else
        {
            return array();
        }
        
    }
    
    /**
     * Vrati vsechny dostupne zpusoby platby, automaticky ulozi do sesny vybranou hodnotu. <br />
     * Automaticky vybere pouze platne varianty dle zvolene dopravy.
     * @param int $selected_payment_id
     * @return array
     */
    public static function get_shipping_payment_types()
    {  
        $selected_payment_id=self::get_selected_payment_id();
        
        // ziskani zvolene dopravy
        $selected_shipping_id = Service_Shipping::get_selected_shipping_id();

        //$payments=orm::factory("payment")->where("zobrazit","=",1)->order_by("poradi","asc")->find_all();
        $shipping=orm::factory("shipping", $selected_shipping_id);
        $payments=$shipping->payments->where("payment_data.zobrazit","=",1)->find_all();

        $result_array=array();
        $x=1;
        foreach($payments as $item)
        {
            $result_array[$x]=$item->as_array();
            
            $shipping_price=Service_Order::get_populated_order()->order_shipping_price; // aktualni cena dopravy
            
            if(($item->cena + $shipping_price)<=0) $result_array[$x]["cena"]=0;
            
            if($item->id==$selected_payment_id || (!$selected_payment_id && $x==1))
            {
                if(!$selected_payment_id) self::set_payment_id($item->id); // pokud jeste nebyla zvolena doprava, vezmu tu prvni
                $result_array[$x]["checked"]=true;
            }
            else
            {
                $result_array[$x]["checked"]=false;
            }
            $x++;
        }
        return $result_array;
    }
}
?>
