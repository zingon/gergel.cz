<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Modelova entita reprezentujici objednavku. 
 * K ziskani na frontendu pouzivejte metodu "instance()" at je zarucena unikatnost objektu objednavky uzivatele napric aplikaci. 
 * K naplneni cenovych udaju slouzi servisa Order.
 * 
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 * 
 * @property float $order_price_no_vat
 * @property float $order_price_lower_vat
 * @property float $order_price_higher_vat
 * @property float $order_lower_vat
 * @property float $order_higher_vat
 * @property float $order_total_without_vat
 * @property float $order_total_with_vat
 * @property float $order_discount
 * @property float $order_total_with_discount
 * @property float $order_shipping_price
 * @property float $order_payment_price
 * @property float $order_total
 * @property float $order_correction
 * @property int $order_total_CZK
 * @property int $order_shipping_id
 * @property string $order_shipping_nazev
 * @property string $order_shipping_popis
 * @property int $order_payment_id
 * @property string $order_payment_nazev
 * @property string $order_payment_popis
 */
class Model_Order extends ORM
{
    /**
     *
     * @var Model_Order 
     */
    protected static $instance; 
    protected $_prices_generated=false;
    /**
     *
     * @var Model_Cart reference na nakupni kosik na ktery se vazou generovane ceny
     */
    protected $shopping_cart; 
    
    protected $_has_many = array('items' => array('model'=>'order_item'));
    protected $_belongs_to = array(
        'order_state' => array('through' => 'order_states'),
        'shipping' => array("foreign_key"=>"order_shipping_id"),
        'payment' => array("foreign_key"=>"order_payment_id"),
        'shopper' => array("foreign_key"=>"order_shopper_id"),
    );
    
    protected $_ignored_columns=array("order_total_with_discount","order_shipping_nazev","order_shipping_popis","order_payment_nazev","order_payment_popis");
    
    /**
     * Mel by existovat jen jeden objekt objednavky napric aplikaci.
     * @return Model_Order 
     */
    public static function instance()
    { 
            if (self::$instance === NULL) {
                self::$instance=new Model_Order();
            }
            return self::$instance;
    }
    
    public function are_prices_generated()
    {
        return $this->_prices_generated;
    }
    
    /**
     * Vyplni cenove hodnoty objednavky.
     * @param type $order_price_array pole cen (musi souhlasit s nazvy DB sloupcu)
     */
    public function populate_prices($order_price_array, $shopping_cart=null, $force_populate=false)
    {
        if(!$this->_prices_generated || $force_populate)
        {
            $this->values($order_price_array);
            $this->_prices_generated=true;
            $this->shopping_cart=$shopping_cart;
        }
    }
    
    /**
     * Vrati referenci na kosik kteremu odpovidaji generovane ceny.
     * 
     * @return Model_Cart
     */
    public function get_cart()
    {
        return $this->shopping_cart;
    }
    
    
    
}

?>
