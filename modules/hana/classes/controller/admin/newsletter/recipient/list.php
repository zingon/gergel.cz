<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace clanku - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Newsletter_Recipient_List extends Controller_Hana_List
{
    protected $with_route=false;

    protected $default_order_by = "email";
    protected $default_order_direction= "asc";

    public function before() {
        $this->orm=new Model_Newsletter_Recipient();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("email")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->filterable()->sequenceable()->width(300)->set();
        $this->auto_list_table->column("allowed")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable()->label("")->width(32)->set();
        
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->exportable(false)->printable(false)->set();
    }
    
   

}
?>
