<?php

/**
 * priceholder
 *
 * @author Pavel
 */
class Model_Product_Priceholder extends Model
{
    
    private $raw_price_value;           // zakladni hodnota ceny - dle typu cenove skupiny (pripadne D0 u procentnich skupin) s dani, bez dane 
             
    private $raw_price_without_tax;   // zakladni hodnota ceny dle cenove skupiny bez DPH 
    private $raw_price_with_tax;      // zakladni hodnota ceny dle cenove skupiny s DPH
    
    
    private $total_price_without_tax;   // vysledna cena se zapoctenim vsech slev bez DPH
    private $total_price_with_tax;      // vysledna cena se zapoctenim vsech slev s DPH 
    
    private $total_tax_value;           // hodnota dane (cena s DPH - cena bez DPH) 
    
    private $voucher_with_tax_discount_value;
    
    private $applied_discounts_witout_tax=array(); // aplikovane slevy bez dane "nazev_slevy"=>hodnota 
    private $applied_discounts_with_tax=array();   // aplikovane slevy s dani
    
    public static $default_price_code=false;
    
    
    public function __construct($product,$price_code=false, $voucher=false)
    {
        parent::__construct();    
        $this->generate_prices($product,$price_code, $voucher);
    }
    
    public function generate_prices($product_orm, $price_code=false, $voucher_distount=false)
    {
        if($product_orm->gift==0)
        {
            if($product_orm instanceof Model_Order_Item)
            {
                // byl predan objekt reprezentujici ulozenou polozku objednavky 
                $this->raw_price_value          =$product_orm->price_with_tax;
                $this->raw_price_without_tax    =$product_orm->price_without_tax;
                $this->raw_price_with_tax       =$product_orm->price_with_tax;
                $this->total_price_without_tax  =$product_orm->price_without_tax;
                $this->total_price_with_tax     =$product_orm->price_with_tax;
                $this->total_tax_value          =$product_orm->price_with_tax - $product_orm->price_without_tax;
                $this->voucher_with_tax_discount_value          =0;
            }
            else
            {
                if(!$price_code) $price_code=self::$default_price_code;
                $response=Service_Product_Price::generate_product_prices($product_orm, $price_code, $voucher_distount);
                $this->raw_price_value          =$response["price"];
                $this->raw_price_without_tax    =$response["price_bez_dph"];
                $this->raw_price_with_tax       =$response["price_s_dph"];
                $this->total_price_without_tax  =$response["total_price_bez_dph"];
                $this->total_price_with_tax     =$response["total_price_s_dph"];
                $this->total_tax_value          =$response["price_dph_value"];
                $this->voucher_with_tax_discount_value          =$response["price_s_dph_voucher_discount_value"];
            }
        }
        else
        {
            $this->raw_price_value=$this->raw_price_without_tax=$this->raw_price_with_tax=$this->total_price_without_tax=$this->total_price_with_tax=$this->total_tax_value=0;
        }
    }
    
    
    public function get_raw_price_value()     
    {
        return $this->raw_price_value;
    }

    public function get_raw_price_without_tax()
    {
        return $this->raw_price_without_tax;
    }

    public function get_raw_price_with_tax()
    {
        return $this->raw_price_with_tax;
    }

    public function get_total_price_without_tax()
    {
        return $this->total_price_without_tax;
    }

    public function get_total_price_with_tax()
    {
        return $this->total_price_with_tax;
    }

    public function get_total_tax_value()
    {
        return $this->total_tax_value;
    }
                    
    public function get_voucher_with_tax_discount_value()
    {
        //die($this->voucher_with_tax_discount_value."-");
        return $this->voucher_with_tax_discount_value;
    }

    public function get_applied_discounts_witout_tax()
    {
        return $this->applied_discounts_witout_tax;
    }

    public function get_applied_discounts_with_tax()
    {
        return $this->applied_discounts_with_tax;
    }


    
}

?>
