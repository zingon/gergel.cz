<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace fronty emailu - seznam.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2011 Pavel Herink
 */

class Controller_Admin_Cz_Email_Queue_List extends Controller_Hana_List
{
    protected $with_route=false;
    protected $default_order_by="id";
    protected $default_order_direction="desc";
    protected $save_button=false;//"znovu odeslat vybrané";
    protected $add_button=false;

    public function before() {
        $this->orm=new Model_Email_Queue();
        $this->default_buttons[]=array("type"=>"submit","nazev"=>"znovu odeslat vybrané","action"=>"save","onclick"=>"Opravdu znovu zaslat vybrané e-maily");
    
        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("queue_to_email")->type("link")->label("Email příjemce")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->sequenceable()->filterable()->width(200)->set();
        $this->auto_list_table->column("txt1")->type("link")->value("náhled e-mailu")->item_settings(array("target"=>"_blank","hrefid"=>$this->base_path."previewraw/".$this->item_page,"image"=>array("src"=>"table.png")))->label("")->width(20)->set();
        
        $this->auto_list_table->column("queue_to_name")->label("Název příjemce")->css_class("txtLeft")->width(150)->sequenceable()->filterable()->set();
        
        
        $this->auto_list_table->column("queue_create_date")->type("text")->label("Vytvořeno")->item_settings(array("special_format"=>"cz_datetime"))->css_class("txtLeft")->sequenceable()->filterable(array("type"=>"daterangepicker","date_incr_day"=>true))->width(150)->set();
        //$this->auto_list_table->column("queue_date_to_be_send")->type("text")->label("Datum zaslání")->item_settings(array("special_format"=>"cz_date"))->css_class("txtLeft")->sequenceable()->filterable(array("type"=>"daterangepicker"))->width(90)->set();
        $this->auto_list_table->column("queue_sent_date")->type("text")->label("Datum zaslání")->item_settings(array("special_format"=>"cz_datetime"))->css_class("txtLeft")->sequenceable()->filterable(array("type"=>"daterangepicker","date_incr_day"=>true))->width(150)->set();
        
        $this->auto_list_table->column("queue_subject")->label("Název zprávy (subject)")->css_class("txtLeft")->sequenceable()->filterable()->set();
        
        $this->auto_list_table->column("queue_sent")->type("indicator")->label("Zasláno")->item_settings(array("states"=>array(0=>array("image"=>"email.png","label"=>"nebylo odesíláno"),1=>array("image"=>"email_go.png","label"=>"bylo odesíláno"))))->css_class("txtCenter")->sequenceable()->filterable()->width(80)->set();
        $this->auto_list_table->column("queue_errors_count")->type("indicator")->label("Chyba")->item_settings(array("states"=>array(0=>array("image"=>"accept.png","label"=>"v pořádku"),1=>array("image"=>"exclamation.png","label"=>"došlo k chybě"))))->css_class("txtCenter")->sequenceable()->filterable()->width(70)->set();
        
        
        //$this->auto_list_table->column("uvodni_popis")->label("Popis")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->set();
        //$this->auto_list_table->column("poradi")->type("changeOrderShifts")->label("")->width(27)->set();
        //$this->auto_list_table->column("zobrazit")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->label("")->width(20)->set();
        $this->auto_list_table->column("selitem")->type("checkbox")->value(0)->label("")->width(20)->set();
    }
    
    protected function _orm_setup()
    {
        $this->orm->select(array("email_queue_bodies.queue_subject","queue_subject"));
        $this->orm->join("email_queue_bodies","left")->on("email_queue.email_queue_body_id","=","email_queue_bodies.id");
    }
    
    protected function _form_action_save($data)
    {
        $email_service=new Service_Email();
        $email_service->resendMailFromQueue(array_keys($data["selitem"]));
        $this->data_saved=true;
    }
    
    
    protected function _form_action_delete($data)
    {
        
        if($this->module_service->delete($data["selitem"],$this->with_route))
        {
            $this->data_saved="deleted";
            return true;
        }

        
    }

    

}
?>