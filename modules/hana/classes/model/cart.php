<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Model reprezentujici nakupni kosik, bez vlastni databazove tabulky.
 * Slouzi k uchovavani poctu produktu k danemu id a variante (volitelne).
 * data v sesne a interni promenne se ukladaji ve formatu $cart_products[$product_id][$variety_id]=$pocet;
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 * 
 * @property-read int $total_items
 * @property-read float $total_cart_price_no_tax 
 * @property-read float $total_cart_price_lower_tax 
 * @property-read float $total_cart_price_higher_tax
 * @property-read float $total_lower_tax_value
 * @property-read float $total_higher_tax_value
 * @property-read float $total_cart_price_without_tax
 * @property-read float $total_cart_price_with_tax
 * @property-read float $total_cart_voucher_discount
 */
class Model_Cart{
    
    protected $cart_name="cart";
    
    protected static $instance;
    protected $session;
    
    // interni nastaveni
    protected $incermental_adding=true; // pri pridavani stejneho zbozi bud zada nove mnozstvi, nebo pripocte ke stavajicimu

    protected $cart_products = array();
    
    // vypoctene ceny kosiku
    protected $full_prices=array();
    protected $full_products=array();
    protected $total_items;
    

    // promenna ukladajici zpravy o vysledku operaci
    private $messages;
    
    /**
     *
     * @return Model_Cart
     */
    public static function instance()
    {
            if (static::$instance === NULL) {
                static::$instance=new static();
            }
            return static::$instance;
    }
    
    protected function __construct() {
       $this->session = Session::instance();
       $this->cart_products = $this->session->get($this->cart_name."_products");
            
//        if(empty($this->cart_products)) $this->cart_products = $this->session->get("cart_products");

    }


/////////////////// metody pro manipulaci s obsahem kosiku :
    
    public function get_item($product_id=false, $variety_id=false)
    {
        if(empty($this->cart_products)) $this->cart_products = $this->session->get($this->cart_name."_products");
        if(!$product_id) return $this->cart_products;
        if(!$variety_id)
        {
            if(isset($this->cart_products[$product_id])) return $this->cart_products[$product_id];
        }
        else
        {
            if(isset( $this->cart_products[$product_id][$variety_id])) return $this->cart_products[$product_id][$variety_id];
        }
        return 0;
    }

    public function get_all_items()
    {
        return $this->get_item();
    }

    public function remove_item($product_id, $variety_id=false)
    {
        if(!$variety_id)
        {
            if(isset($_SESSION[$this->cart_name."_products"][$product_id])) unset($_SESSION[$this->cart_name."_products"][$product_id]);
        }
        else
        {
            if(isset($_SESSION[$this->cart_name."_products"][$product_id][$variety_id])) unset($_SESSION[$this->cart_name."_products"][$product_id][$variety_id]);
        }
        $this->cart_products = $this->session->get($this->cart_name."_products");
        $this->populate_cart();
        
        $this->messages=array(Hana_Response::MSG_PROCESSED=>__("Zboží bylo odebráno z košíku"));
        
        return true;
    }

    /**
     * Vlozi do kosiku dane mnozstvi produktu s nastavenymi pripadnymi dalsimi volbami.
     * @param int $product_id id produktu
     * @param int $quantity mnozstvi
     * @param mixed $variety varianta produktu - volitelne
     */
    public function set_item($product_id, $quantity=false, $variety=false, $update=false, $new_variety=false)
    {
        if(!$new_variety)
        {    
            // validace vstupnich dat
            $validation_error=array();

            // 1. validace zadaneho formatu dat TODO: pridat volbu na desetinne cislo do databaze
            if(!is_numeric($quantity)) $validation_error[]="Zadané množství musí být celé číslo";
            if(strpos($quantity, ".") || strpos($quantity, "-")) $validation_error[]="Zadané množství musí být celé číslo";

            // 2. validace mnozstvi na sklade
    //        $product=orm::factory("product",$product_id);
    //        if($product->pocet_na_sklade < $quantity) $validation_error="Zadali jste větší množství než máme momentálně na skladě";

            if(empty($validation_error))
            {
                $this->cart_products=$this->session->get($this->cart_name."_products");

                if(!$variety)
                {
                    if($this->incermental_adding && !$update) $quantity=$this->get_item($product_id)+$quantity;
                    $this->cart_products[$product_id]=$quantity;
                }
                else
                {
                    if($this->incermental_adding && !$update) $quantity=$this->get_item($product_id, $variety)+$quantity;
                    $this->cart_products[$product_id][$variety]=$quantity;
                }
                //die(print_r($this->cart_products));
                $this->session->set($this->cart_name."_products", $this->cart_products);
                
                // po vlozeni prepocitat kosik
                $this->populate_cart();

                $this->messages=array(Hana_Response::MSG_PROCESSED=>__("Zboží bylo vloženo do košíku"));
                return true;
            }
            else
            {
                
                $this->messages=$validation_error;
                return false;
            }
        }
        elseif($variety && $new_variety)
        {
            // upravujeme pouze variantu produktu
            $this->cart_products=$this->session->get($this->cart_name."_products");
            if(!($quantity && is_numeric($quantity) && !(strpos($quantity, ".") || strpos($quantity, "-")))) $quantity=$this->cart_products[$product_id][$variety];
            if($variety!=$new_variety) unset($this->cart_products[$product_id][$variety]);
            $this->cart_products[$product_id][$new_variety]=$quantity;
            
            $this->session->set($this->cart_name."_products", $this->cart_products);
            
            //$this->populate_cart();
            $this->messages=array(Hana_Response::MSG_PROCESSED=>__("Varianta byla upravena")); // TODO jazykova tabulka
            return true;    
        }
    }
    
    /**
     * Vyprazdni kosik se vsim vsudy.
     * @return boolean 
     */
    public function flush()
    {
        unset($_SESSION[$this->cart_name."_products"]);
        $this->cart_products=array();
        $this->session->set("total_".$this->cart_name."_price_without_tax",null);
        $this->session->set("total_".$this->cart_name."_price_with_tax",null);
        $this->session->set("total_".$this->cart_name."_items",null);
        $this->session->set("selected_".$this->cart_name."_gift",null);
        Service_Voucher::remove_voucher();
        return true;
    }
    
    public function get_messages()
    {
        return $this->messages;
    }
    
////////////////////////////////////////////////// metody pro zjisteni a vypocet cen zbozi v kosiku
    
    /**
     * Ziskani cen a ostatnich generovanych popisnych atributu kosiku (tzn. krome pole produktu - samostatna metoda).
     * @param type $name 
     * 
     */
    public function __get($name)
    {
        // pokud jsou pozadovany zakladni data a kosik neni plne vygenerovan, pro usporu prostredku je vezmeme ze sesny
        if(empty($this->full_prices))
        {    
            if($name=="total_cart_price_without_tax") return $this->session->get ("total_".$this->cart_name."_price_without_tax", 0);
            if($name=="total_cart_price_with_tax") return $this->session->get ("total_".$this->cart_name."_price_with_tax", 0);
            if($name=="total_cart_items") return $this->session->get("total_".$this->cart_name."_items", 0);
        }
        // pokud jsou pozadovany specialni cenove atributy, je nutne pregenerovat kosik. 
        if(count($this->cart_products) > 0 && empty($this->full_prices))$this->populate_cart();
        
        if($name=="total_items") return $this->total_items;
        //die(count($this->cart_products)."-");
        //die(print_r($this->full_prices));
        
        
        if(key_exists($name, $this->full_prices))
        {
            return $this->full_prices[$name];
        }
        else
        {
            throw new Kohana_Exception("Chybný požadavek na cenu košíku - neexistující typ ceny:".$name, null, 500);
        }   
    }
    
    /**
     * Vrati pole produktu s veskerymi vygenerovanymi parametry. Vyzada si plne vygenerovani kosiku, pokud se tak uz nestalo.
     * @return array pole produktu 
     */
    public function get_cart_products()
    {
        if(count($this->cart_products) > 0 && empty($this->full_products)) $this->populate_cart();

        return $this->full_products;
    }
    
    
    /**
     * Interni metoda na doplneni dat kosiku (dat produktu a cen);
     */
    protected function populate_cart()
    {
       $result_array=Service_ShoppingCart::generate_cart_content_with_prices($this->cart_products);
       // zajisteni likvidace kosiku pri nulove hodnote
       if($result_array["cart_prices"]["total_cart_price_with_tax"]<=0) $this->flush();
       
       $this->full_products=$result_array["cart_products"];
       $this->full_prices=$result_array["cart_prices"];
       $this->total_items=$result_array["total_items"];
       $this->session->set("total_".$this->cart_name."_price_without_tax",$result_array["cart_prices"]["total_cart_price_without_tax"]);
       $this->session->set("total_".$this->cart_name."_price_with_tax",$result_array["cart_prices"]["total_cart_price_with_tax"]);
       $this->session->set("total_".$this->cart_name."_items",$result_array["total_items"]);

    }
    
    

}
?>
