<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace fronty emailu - edit.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2011 Pavel Herink
 */

class Controller_Admin_Cz_Email_Queue_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    
    public function before() {
        $this->orm=new Model_Email_Queue();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("queue_subject")->data_src(array("related_table_1"=>"email_queue_body"))->label("Název (subjekt) zprávy")->set();
        $this->auto_edit_table->row("queue_from_email")->data_src(array("related_table_1"=>"email_queue_body"))->label("Odesílatel")->set();
        $this->auto_edit_table->row("queue_from_name")->data_src(array("related_table_1"=>"email_queue_body"))->label("Email odesílatele")->set();
        $this->auto_edit_table->row("queue_to_name")->label("Příjemce")->set();
        $this->auto_edit_table->row("queue_to_email")->label("Email příjemce")->set();
        $this->auto_edit_table->row("queue_create_date")->item_settings(array("special_format"=>"cz_datetime"))->label("Datum vytvoření")->set();
        $this->auto_edit_table->row("queue_date_to_be_send")->item_settings(array("special_format"=>"cz_datetime"))->label("Určeno k zaslání")->set();
        $this->auto_edit_table->row("queue_sent_date")->item_settings(array("special_format"=>"cz_datetime","empty_text"=>"-- nebylo zasláno --"))->label("Datum zaslání")->set();
        $this->auto_edit_table->row("queue_errors_count")->item_settings(array("empty_text"=>"-- bez chyb --"))->label("Počet chybných zaslání")->set();
        $this->auto_edit_table->row("queue_error")->item_settings(array("empty_text"=>"-- bez chyb --"))->label("Chybová zpráva")->set();
//        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
//        $this->auto_edit_table->row("nazev_seo")->type("edit")->data_src(array("related_table_1"=>"route"))->label("Název SEO")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();
//        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
//        $this->auto_edit_table->row("description")->type("edit")->label("Popis")->set();
//        $this->auto_edit_table->row("keywords")->type("edit")->label("Klíčová slova")->set();
//        $this->auto_edit_table->row("zobrazit")->type("checkbox")->value(1)->label("Zobrazit")->set();
//        $this->auto_edit_table->row("uvodni_popis")->type("editor")->label("Úvodní text")->set();
//        $this->auto_edit_table->row("popis")->type("editor")->label("Text")->set();
//        $this->auto_edit_table->row("sizes")->type("editor")->label("Tabulka velikostí")->set();
    }

    
}