<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace objednávek - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Order_List extends Controller_Hana_List
{
    protected $with_route=false;
    protected $add_button=false;
    protected $save_button="uložit stavy";
    protected $default_order_by="order_date";
    protected $default_order_direction="desc";

    public function before() {
        $this->orm=new Model_Order();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->filterable(array("col_name"=>"orders.id"))->set();
        $this->auto_list_table->column("order_code")->type("text")->label("Kód")->css_class("txtLeft")->width(100)->filterable()->sequenceable()->set();
        $this->auto_list_table->column("order_date")->label("Datum")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->width(160)->filterable(array("type"=>"daterangepicker"))->sequenceable()->set();
        $this->auto_list_table->column("order_shopper_name")->label("Zákazník")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->sequenceable()->set();
        $this->auto_list_table->column("last_modified")->label("Naposledy změněno")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->width(150)->sequenceable()->set();
        $this->auto_list_table->column("order_total_without_vat")->label("Cena zboží bez DPH")->css_class("txtRight")->item_settings(array("maxlenght"=>100,"special_format"=>"currency"))->sequenceable()->set();
        $this->auto_list_table->column("order_total_CZK")->label("Cena celkem s DPH")->css_class("txtRight")->item_settings(array("maxlenght"=>100,"special_format"=>"currency"))->sequenceable()->set();
        $this->auto_list_table->column("payu_status_message")->label("PayU")->width(120)->item_settings(array("maxlenght"=>20))->set();
        
        $this->auto_list_table->column("order_state")->type("selectbox")->label("Stav")->data_src(array("related_table_1"=>"order_state","column_name"=>"nazev","condition"=>array("smazano","=",0),"orm_tree"=>false))->sequenceable("orders.order_state_id")->filterable(array("col_name"=>"orders.order_state_id"))->set();
        $this->auto_list_table->column("txt1")->type("link")->value("náhled objednávky")->item_settings(array("hrefid"=>$this->base_path."preview/".$this->item_page,"image"=>array("src"=>"table.png")))->label("")->width(20)->set();
        $this->auto_list_table->column("txt3")->type("link")->value("editace objednávky")->item_settings(array("hrefid"=>$this->base_path_to_edit,"image"=>array("src"=>"table_edit.png")))->label("")->width(20)->set();
        $this->auto_list_table->column("txt2")->type("link")->value("tisk objednávky")->item_settings(array("hrefid"=>$this->base_path."print/".$this->item_page,"target"=>"_blank","image"=>array("src"=>"printer.png")))->label("")->width(20)->set();
        
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(20)->set();
        
        $this->auto_list_table->summaryRow(array("order_total_without_vat","order_total_CZK"));
    }

    protected function _form_action_save($data)
    {
        // nastaveni stavu jednotilvym polozkam
        foreach($data["order_state"] as $item_id=>$value)
        {
            $order=orm::factory("order",$item_id);
//            $order->order_state_id=$value;
//            $order->save();
            Service_Order::set_order_state($order, $value);
        }

        $this->data_saved=true;
    }

    

}
?>