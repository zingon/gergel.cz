<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace produktu - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Shopper_List extends Controller_Hana_List
{
    protected $with_route=true;
    protected $default_order_by="nazev";

    public function before() {
        $this->orm=new Model_Shopper();
        parent::before();
    }

    protected function _column_definitions()
    {
        // kod, uživatelské jméno, Název, Objednávky, Email, Přihlášení, Smazat
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("kod")->label("Kód")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->width(150)->sequenceable()->filterable()->set();
        //$this->auto_list_table->column("username")->label("Uživatelské jméno")->css_class("txtLeft")->sequenceable()->filterable()->set();
        $this->auto_list_table->column("email")->label("E-mail")->css_class("txtLeft")->sequenceable()->filterable()->set();
        $this->auto_list_table->column("last_login")->label("Poslední přihlášení")->item_settings(array("special_format"=>"cz_datetime_timestamp"))->width(170)->sequenceable()->css_class("txtRight")->set();
        $this->auto_list_table->column("order_total")->label("Objednáno celkem (Kč)")->css_class("txtRight")->width(170)->sequenceable()->set();
//        $this->auto_list_table->column("poradi")->type("changeOrderShifts")->label("")->sequenceable()->width(32)->exportable(false)->printable(false)->set();
//        $this->auto_list_table->column("zobrazit")->type("switch")->data_src(array("related_table_1"=>"route"))->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"routes.zobrazit"))->label("")->width(32)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->exportable(false)->printable(false)->set();
    }

    

}
?>