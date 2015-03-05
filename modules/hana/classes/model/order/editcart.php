<?php defined('SYSPATH') or die('No direct script access.');

class Model_Order_Editcart extends Model_Cart
{
    protected static $instance2;
    protected $cart_name="editcart";
    protected $old_cart_products=array(); // produkty vlozene v objednavce - asoc. pole id=>amount/variety_am (pozor - id je id v tabulce order_items, nikoliv id produktu)
    
    public static function instance()
    { 
            if (static::$instance2 === NULL) {
                static::$instance2=new Model_Order_Editcart();
            }
            return static::$instance2;
    }
    
    /**
     * Poznamena ID puvodnich produktu v objednavce - ty se posleze budou pocitat podle starych cen platnych v den objednani
     * @param type $old_product_id 
     */
    public function set_old_product_id($old_product_id, $old_item_id)
    {
        $_SESSION["old_products_ids"][$old_product_id]=$old_item_id;
    }
    
    public function get_old_products()
    {
        return $this->session->get("old_products_ids",array());
    }
    
    /**
     * Pokud se stary produkt odstrani
     * @param type $old_product_id 
     */
    public function remove_old_product_id($old_product_id)
    {
        
    }
    
    /**
     * Interni metoda na doplneni dat kosiku (dat produktu a cen);
     */
    protected function populate_cart()
    {

       $result_array=Service_ShoppingCart::generate_cart_content_with_prices($this->cart_products, $this->get_old_products());
       // zajisteni likvidace kosiku pri nulove hodnote
       if($result_array["cart_prices"]["total_cart_price_with_tax"]<=0) $this->flush();
       
       $this->full_products=$result_array["cart_products"];
       $this->full_prices=$result_array["cart_prices"];
       $this->total_items=$result_array["total_items"];
       $this->session->set("total_".$this->cart_name."_price_without_tax",$result_array["cart_prices"]["total_cart_price_without_tax"]);
       $this->session->set("total_".$this->cart_name."_price_with_tax",$result_array["cart_prices"]["total_cart_price_with_tax"]);
       $this->session->set("total_".$this->cart_name."_items",$result_array["total_items"]);

    }
    
    public function flush()
    {
        parent::flush();
        $this->session->delete("old_products_ids");
    }
    
    
    
}

?>
