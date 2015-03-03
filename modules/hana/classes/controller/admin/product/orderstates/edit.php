<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace cenovych skupin - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Orderstates_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    
    public function before() {
        $this->orm=new Model_Order_State();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("code")->type("edit")->label("Kód")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("popis")->type("edit")->label("Popis")->set();
        if(!empty($this->orm->code))
        {
            $kod_stavu=$this->orm->code;
        }
        else
        {
            $kod_stavu="[kód stavu]";
        }
        $this->auto_edit_table->row("send_mail")->type("checkbox")->label("Zaslat e-mail")->condition("Musí být založen typ e-mailu s kódem ve tvaru: order_".$kod_stavu)->set();
        $this->auto_edit_table->row("email_text")->type("editor")->label("Text emailu")->set();
        
    }
    
}