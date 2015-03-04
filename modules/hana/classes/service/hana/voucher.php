<?php defined('SYSPATH') or die('No direct script access.');


/**
 *
 *
 * @author     Pavel Herink
 * @copyright  (c) 2011 Pavel Herink
 */
class Service_Hana_Voucher
{
    /**
     * Ulozi slevovy voucher do sesny
     * @param type $voucher_code
     */
    public static function pre_use_voucher($voucher_code)
    {
        if($voucher_code) Session::instance()->set("vchc", $voucher_code); 
        
        $voucher=static::get_voucher();
        
        return (is_object($voucher) && $voucher->id)?true:false;
    }
    
    /**
     * Pouzije zpracuje kupon pri odeslani objednavky.
     */
    public static function use_voucher($voucher_id)
    {
        //$voucher=static::get_voucher($voucher_code, $shopper_id); 
       $voucher=orm::factory("voucher")->where("id","=",$voucher_id)->where("enabled","=",1)->find();

       if(is_object($voucher) && $voucher->id)
       {
           if($voucher->one_off)
           {
               $voucher->enabled=0;
           }
           
           $curr_us=$voucher->used;
           $voucher->used=$curr_us+1;
           $voucher->save();
           Session::instance()->delete("vchc");
           return $voucher; 
       }
       else
       {
           return false;
       }
    }
    
    /**
     * Nacte orm voucheru - bud podle kodu, nebo ulozeneho v sesne. 
     * @param type $voucher_code 
     */
    public static function get_voucher($voucher_code="", $shopper_id=0)
    {
        if(!$voucher_code) $voucher_code=Session::instance()->get("vchc", false);

        if($voucher_code)
        {
            $voucher=orm::factory("voucher")->where("code","=",$voucher_code)->where("enabled","=",1);
            if($shopper_id)
            {
               $voucher->where("shopper_id","=",$shopper_id); 
            }
            
            $voucher=$voucher->find();
            
            if($voucher->id) return $voucher;
        }
        
        return false;
    }
    
    public static function is_voucher_inserted()
    {
        return static::get_voucher();
    }
    
    public static function remove_voucher()
    {
        Session::instance()->set("vchc", null); 
    }
}

?>
