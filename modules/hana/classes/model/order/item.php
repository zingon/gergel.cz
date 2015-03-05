<?php defined('SYSPATH') or die('No direct script access.');

class Model_Order_Item extends ORM
{
    public $join_on_routes=false;
    protected $_belongs_to = array('order' => array());
    
    public function prices($price_category=false, $voucher=false)
    {
//        if(!$price_category)
//        {
//            $user=Service_User::instance()->get_user();
//            if($user && $user->price_category_id)
//            {
//                $price_category=$user->price_category->kod;
//            }
//        }
//        
//        if(empty($this->_product_priceholder[$price_category])) 
//        {
//            $this->_product_priceholder[$price_category]=new Model_Product_Priceholder($this, $price_category, $voucher);
//        }
//        
//        return isset($this->_product_priceholder[$price_category])?$this->_product_priceholder[$price_category]:"";

        return(new Model_Product_Priceholder($this, $price_category, $voucher));
        
        
    }
}

?>

