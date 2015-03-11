<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Doplnkova servisni trida k Service_Order. Tvorba PDF sestavy.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 * 
 */
class Service_Hana_Order_Pdf{
    
    /**
     * Vytvori zalohovou fakturu, ulozi ji do adresare a v pripade uspechu vrati celou cestu k tomuto souboru.
     * @param type $order_data 
     */
    public static function create_order_pdf($order_data)
    {
        $order_tpl=new View("mpdf/order_new");
        
        $order_data["date_from"]=date("d.m.Y",$order_data["order_timestamp"]);
        $order_data["date_to"]=date("d.m.Y",$order_data["order_timestamp"]+($order_data["owner_due_date"]*86400));
        
        $order_tpl->order=$order_data;
        $order_tpl->eshop_title=Hana_Application::instance()->get_name();
        $html= $order_tpl->render();
        $name="zalohova_faktura_".$order_data["order_code_invoice"];
        
        try
        {
            $directory=str_replace('\\', '/',DOCROOT)."media/files/pdf/order/".$order_data["order_code_invoice"]."/";
            mkdir($directory);
            Kohana_Mpdf::create($name, $html,"",$directory);
            return($directory.$name.".pdf");
        }
        catch (Exception $e)
        {
            // vytvoreni PDF se zalohovou fakturou selhalo
            Kohana_Log::instance()->add("error", 'Chyba pri vytvoreni zalohove faktury: '.$order_data["order_code_invoice"]." - ".$e->getMessage());
        }
        return false;

     }





}
?>
