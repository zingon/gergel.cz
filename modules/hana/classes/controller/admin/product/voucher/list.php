<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace plateb - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Voucher_List extends Controller_Hana_List
{
    protected $with_route=false;
    protected $default_order_by="id";

    public function before() {
        $this->orm=new Model_Voucher();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("code")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->set();
        $this->auto_list_table->column("lifetime")->type("text")->label("Datum")->item_settings(array("special_format"=>"cz_date"))->css_class("txtLeft")->sequenceable()->filterable(array("type"=>"daterangepicker"))->width(150)->set();
        $this->auto_list_table->column("discount_value")->type("text")->label("Sleva %")->css_class("txtRight")->width(150)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->exportable(false)->printable(false)->set();
    }

    

}
?>