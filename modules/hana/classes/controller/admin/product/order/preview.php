<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace objednavky - edit. Ponekud starsi implementace - TODO: predelat, separovat do servis dle zasad OOP.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Order_Preview extends Controller_Hana_Default
{
    public $template="admin/order_document";
    
    // tlacitko zpet
    protected $back_link_url;
    protected $back_link_text="Zpět na seznam";

    public function action_index()
    {
        $this->base_admin_path="admin/".$this->module_key."/".$this->submodule_key."/".$this->subaction_key."/".($this->item_page?"".$this->item_page:"").($this->item_id?"/".$this->item_id:"");

        $this->template->back_link=($this->back_link_url)?$this->back_link_url:url::base()."admin/".$this->module_key."/".$this->submodule_key."/list".($this->item_page?"/".$this->item_page:"/1");
        $this->template->back_link_text=$this->back_link_text;

        $order=orm::factory("order")->find($this->item_id);

        // cenova kategorie zakaznika, kteremu patri objednavka
        $shopper=orm::factory("shopper")->find($order->order_shopper_id);
        $price_code=$shopper->price_category->kod;
        

        $order_data=Service_Order::dump_order($order);
        
        //print_r($order_data);
        
        
        
        $this->template->order=$order_data;
    }

}
?>
