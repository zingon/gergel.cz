<?php

/**
 * Objektove rozhranni pro tvogbu GA vcetne Ecommerce Tracking 
 */
class Googleanalytics
{ 
    private static $instance;
    
    private $template;
    
    private $ET_data=null;
    
    
    
    /**
     *
     * @param type $ga_account_code Ucet GA ve tvaru UA-XXXXX-X
     */
    public static function getCode($ga_account_code)
    {
        if(!$ga_account_code) return;
        if(empty(self::$instance)) self::$instance=new Googleanalytics;
        $instance=self::$instance;
        
        $instance->template=new View("googleanalytics");
        $instance->template->ga_account_code=$ga_account_code;
        if(!empty($instance->ET_data) && !empty($instance->ET_data["order_items"]))
        {
            $instance->template->ET_data=$instance->ET_data;
        }
        return $instance->template->render();
    }
    
    /**
     * Vytvori novou transakci.
     * 
     * @param type $orderId
     * @param type $total
     * @param type $affiliation
     * @param type $tax
     * @param type $shipping
     * @param type $city
     * @param type $state
     * @param type $country 
     */
    public static function createTransaction($orderId, $total, $affiliation="", $tax="", $shipping="", $city="", $state="", $country="")
    {
        if(empty(self::$instance)) self::$instance=new Googleanalytics;
        $instance=self::$instance;
        
        $instance->ET_data=array();
        $instance->ET_data["orderId"]=$orderId;
        $instance->ET_data["total"]=$total;
        $instance->ET_data["affiliation"]=$affiliation;
        $instance->ET_data["tax"]=$tax;
        $instance->ET_data["shipping"]=$shipping;
        $instance->ET_data["city"]=$city;
        $instance->ET_data["state"]=$state;
        $instance->ET_data["country"]=$country;
        $instance->ET_data["order_items"]=array();
        
    }
    
    /**
     * Prida polozku k vytvorene transakci.
     * 
     * @param type $product_code
     * @param type $name
     * @param type $category
     * @param type $price
     * @param type $quantity
     * @param type $orderId 
     */
    public static function addItem($product_code, $name, $category, $price, $quantity, $orderId=false)
    {
        if(empty(self::$instance)) self::$instance=new Googleanalytics;
        $instance=self::$instance;
        
        if(!$orderId && isset($instance->ET_data["orderId"]))
        {
            $orderId=$instance->ET_data["orderId"];
        }
        else
        {
            return false;
        }
        
        $instance->ET_data["order_items"][]=array(
            "orderId"=>$orderId,
            "sku"=>$product_code,
            "name"=>$name,
            "category"=>$category,
            "price"=>$price,
            "quantity"=>(int) $quantity
            
        );
        
    }
    
}

?>