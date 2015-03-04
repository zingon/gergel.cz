<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace plateb - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Tax_List extends Controller_Hana_List
{
    protected $with_route=false;

    public function before() {
        $this->orm=new Model_Tax();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->width(150)->set();
        $this->auto_list_table->column("code")->label("Kód")->css_class("txtLeft")->set();
        $this->auto_list_table->column("hodnota")->type("text")->label("Hodnota")->css_class("txtRight")->width(150)->set();
    }

    

}
?>