<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace objednavky - edit. Ponekud starsi implementace - TODO: predelat, separovat do servis dle zasad OOP.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Order_Print extends Controller_Hana_Default
{
    public $template="admin/order_document";

    public function action_index()
    {
        $order=orm::factory("order")->find($this->item_id);

        // cenova kategorie zakaznika, kteremu patri objednavka
        $shopper=orm::factory("shopper")->find($order->order_shopper_id);
        $price_code=$shopper->price_category->kod;
        

        $order_data=Service_Order::dump_order($order);
        
        //print_r($order_data);

        $this->template->order=$order_data;
        $this->template->direct_print=true;
        
        echo($this->template->render());
        exit();
    }


}
?>
