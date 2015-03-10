<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Doplnkova servisni trida k Service_Order. Obsluha sestav emailu a jejich odesilani na mail.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 * 
 */
class Service_Hana_Order_Email{
    /**
     * Posle objednavku mailem.
     * @param array $order_data 
     */
    public static function send_order($order_data, $attachment=false, $message_code="order_new")
    {
        $order_mail_template=new View("emails/order/".$message_code);
                
        $order_mail_template->order=$order_data;
        $order_mail_template->eshop_title=Hana_Application::instance()->get_name(); // nazev stranek
        $message=$order_mail_template->render();
        
        // doplnujici data
        $data=array();
        $data["file_attachment"]=$attachment;
        
        return Service_Email::process_email($message, $message_code, $order_data["order_shopper_email"], $order_data["order_shopper_name"], $data);
    }
    
    
    
    /**
     * 
     * @param orm $order nactena objednavka
     * @param orm $order_state nacteny novy stav
     * @param type $message_code_prefix 
     */
    public static function send_state_change_notification($order, $order_state, $message_code_prefix="order_state")
    {
        $state_template=new View("emails/order/".$message_code_prefix."_".$order_state->code);
                
        $state_template->order_id=$order->id;
        $state_template->order_code=$order->order_code;
        $state_template->order_link="";
        $state_template->order=  Service_Order::dump_order($order);
        
        $state_template->owner_data= orm::factory("product_setting",1);
        $state_template->eshop_title=Hana_Application::instance()->get_name(); // nazev stranek
        $state_template->stav=$order_state->nazev;
        $state_template->popis=$order_state->popis;

        $message=$state_template->render();
        $message_code=$message_code_prefix."_".$order_state->code;
        return Service_Email::process_email($message, $message_code, $order->order_shopper_email, $order->order_shopper_name);
    }
    
    
}
?>
