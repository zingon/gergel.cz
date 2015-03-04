<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace cenovych skupin - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Price_List extends Controller_Hana_List
{
    protected $with_route=false;
    protected $default_order_by="id";

    public function before() {
        $this->orm=new Model_Price_Category();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("kod")->type("link")->label("Kód")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->width(150)->set();
        $this->auto_list_table->column("price_type_id")->label("Kód typ ceny")->data_src(array("related_table_1"=>"price_type","column_name"=>"kod"))->css_class("txtLeft")->width(120)->set();
        $this->auto_list_table->column("popis")->label("Popis")->css_class("txtLeft")->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->exportable(false)->printable(false)->set();
    }

    

}
?>