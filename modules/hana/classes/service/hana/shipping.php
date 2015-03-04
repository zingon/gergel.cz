<?php defined('SYSPATH') or die('No direct script access.');


/**
 *
 *
 * @author     Pavel Herink
 * @copyright  (c) 2011 Pavel Herink
 */
class Service_Hana_Shipping
{
    
    public static function get_selected_shipping_id()
    {
        $shipping_id = Session::instance()->get("shipping_id",false);
        
        if(!$shipping_id)
        {
            // neni-li v sesne jeste zadna doprava ulozena, vybereme prvni
            $shipping_id=db::select(array("shippings.id","id"))->from("shippings")->join("shipping_data")->on("shippings.id","=","shipping_data.shipping_id")->where("zobrazit","=",1)->order_by("poradi","ASC")->limit(1)->execute()->get("id"); 
        }
        
        return $shipping_id;
    }
    
    public static function set_shipping_id($shipping_id)
    {
        if(self::get_selected_shipping_id()!==$shipping_id)
            {
                Service_Payment::set_payment_id(0); // po zmene dopravy vynuluju platbu
            }

        Session::instance()->set("shipping_id", $shipping_id);
    }
    
    public static function get_shipping_name($shipping_id)
    {
        
    }
    
    /**
     * Vrati vsechny dostupne zpusoby dopravy, automaticky ulozi do sesny vybranou hodnotu.
     * @param int $selected_shipping_id
     * @return array
     */
    public static function get_shipping_types($selected_shipping_id=false, $cena_kosiku_s_dph=0)
    {
        if(!$selected_shipping_id)
        {
            $selected_shipping_id=self::get_selected_shipping_id();
        }

        $shippings=orm::factory("shipping")->where("zobrazit","=",1)->order_by("class","asc")->order_by("poradi","asc")->find_all();
        $result_array=array();
        $x=1;
        foreach($shippings as $item)
        {
            $result_array[$x]=$item->as_array();

            if($cena_kosiku_s_dph > 0)
            {
                $result_pricelevel=db::select("value")->from("shipping_pricelevels")->where("shipping_id","=",$item->id)->where("level",">=",$cena_kosiku_s_dph)->order_by("level","ASC")->limit(1)->as_object()->execute()->current();
                if(is_object($result_pricelevel))
                {
                    $result_array[$x]["cena"]=$result_pricelevel->value;
                }
            }
            
            if($item->id==$selected_shipping_id || (!$selected_shipping_id && $x==1))
            {
                if(!$selected_shipping_id) self::set_shipping_id($item->id); // pokud jeste nebyla zvolena doprava, vezmu tu prvni
                $result_array[$x]["checked"]=true;
            }
            else
            {
                $result_array[$x]["checked"]=false;
            }
            $x++;
        }
        //die(print_r($result_array));
        return $result_array;
    }
    
    public static function remove_price_levels($shipping_id)
    {
       db::delete("shipping_pricelevels")->where("shipping_id","=",$shipping_id)->execute();
    }
    
    public static function add_price_levels($shipping_id, $data)
    {
        foreach($data as $item)
        {
            db::insert("shipping_pricelevels",array("shipping_id","level","value"))->values(array($shipping_id,$item["level"],$item["value"]))->execute();
        }
    }
    
    public static function insert_update_levels($shipping_id, $data)
    {
        $ids=array();
        $ids[]=0;
        foreach($data as $row)
        {
            $item=orm::factory("shipping_pricelevel")->where("shipping_id","=",$shipping_id)->where("level","=",$row["level"])/*->where("value","=",$row["value"])*/->find();
            if(!$item->id || $item->value!=$row["value"])
            {
                $item->shipping_id=$shipping_id;
                $item->level=$row["level"];
                $item->value=$row["value"];
                $item->save();
            }
            $ids[]=$item->id;      
        }

        db::delete("shipping_pricelevels")->where("shipping_id","=",$shipping_id)->where("id","NOT IN", db::expr("(".implode(",", $ids).")"))->execute();
    }
    
    public static function get_level_price($shipping_id, $cena_kosiku_s_dph)
    {
        $result=db::select("value")->from("shipping_pricelevels")->where("shipping_id","=",$shipping_id)->where("level",">=",$cena_kosiku_s_dph)->order_by("level","ASC")->limit(1)->as_object()->execute()->current();
        return is_object($result)?$result->value:false;
    }

}
?>
