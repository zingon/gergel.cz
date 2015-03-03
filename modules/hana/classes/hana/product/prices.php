<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Centrální třída pro vypočítávání cen produktů a objednávek, včetně slev.
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Hana_Product_Prices
{
    private static $instance;
    private $default_price_code="D0";
    
    private $price_rules=array();
    
    /**
     *
     * @return Hana_Navigation
     */
    public static function instance()
    { 
            if (self::$instance === NULL) {
                self::$instance=new Hana_Product_Prices();
            }
            
            return self::$instance;
    }
    
    public function add_product_discount($price_rule)
    {
        
    }
    
}

?>
