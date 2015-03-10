<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace cenovych skupin - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Orderstates_List extends Controller_Hana_List
{
    protected $with_route=false;


    public function before() {
        $this->orm=new Model_Order_State();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->width(150)->set();
        $this->auto_list_table->column("code")->label("Kód")->css_class("txtLeft")->width(120)->set();
        $this->auto_list_table->column("popis")->label("Popis")->css_class("txtLeft")->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(20)->set();
    }

    

}
?>