<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace statickeho obsahu stranek - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Static_Item_List extends Controller_Hana_List
{
    protected $with_route=false;

    protected $default_order_by="kod";

    public function before() {
        $this->orm=new Model_Static_Content();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("kod")->label("Kód")->type("link")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->filterable()->set();
        $this->auto_list_table->column("popis")->label("Popis")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        if(Kohana::config("languages")->get("enabled"))
        $this->auto_list_table->column("available_languages")->type("languages")->item_settings(array("hrefid"=>$this->base_path_to_edit))->width(58)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->set();
    }  

}
?>