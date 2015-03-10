<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace plateb - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Voucher_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    
    public function before() {
        $this->orm=new Model_Voucher();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("code")->type("edit")->label("Kód kupónu")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("discount_value")->type("edit")->label("Hodnota (v %)")->set();
        $this->auto_edit_table->row("one_off")->type("checkbox")->label("Jednorázový")->set();
        $this->auto_edit_table->row("enabled")->type("checkbox")->label("Povolen")->condition("Jednorázové kupóny se po použití automaticky zneaktivní.")->set();
        $this->auto_edit_table->row("lifetime")->type("datepicker")->label("Datum platnosti")->set();
        
        
        
    }
}