<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace plateb - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Tax_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    
    public function before() {
        $this->orm=new Model_Tax();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("code")->type("edit")->label("Kód")->set();
        $this->auto_edit_table->row("hodnota")->type("edit")->label("Hodnota (v %)")->set();
        
    }
}