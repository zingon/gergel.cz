<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace typu emailu - edit.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2011 Pavel Herink
 */

class Controller_Admin_Cz_Email_Type_Edit extends Controller_Hana_Edit
{
    
    public function before() {
        $this->orm=new Model_Email_Type();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("code")->type("edit")->label("Kód")->condition("Položka musí být vyplněna. (pozor napojení na skript!)")->set();
        //$this->auto_edit_table->row("template")->type("edit")->label("Šablona")->condition("Položka musí být vyplněna. (složka application/views/email)")->set();
        $this->auto_edit_table->row("subject")->type("edit")->label("Subjekt zprávy")->set();
        $this->auto_edit_table->row("from_nazev")->type("edit")->label("Jméno odesílatele")->set();
        $this->auto_edit_table->row("from_email")->type("edit")->label("Email odesílatele")->set();
        $this->auto_edit_table->row("use_email_queue")->type("checkbox")->value(1)->label("Použít frontu e-mailů")->set();
        $this->auto_edit_table->row("send_by_cron")->type("checkbox")->value(0)->label("Pouze ukládat do fronty")->condition("Pokud je zaškrtnuto, e-maily se ukládají do fronty bez odeslání. Nutno zajistit např cronem.")->set();
        
    }

    
}