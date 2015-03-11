<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace clanku - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Giftbox_Item_List extends Controller_Hana_List
{
    protected $with_route=false;
    
    protected $default_order_by = "id";
    

    public function before() {
        $this->orm=new Model_Gift_Box();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("code")->type("link")->label("Kód")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->filterable()->sequenceable()->width(300)->set();
        $this->auto_list_table->column("zobrazit")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"routes.zobrazit"))->label("")->width(32)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->exportable(false)->printable(false)->set();
    }
    
}
?>
