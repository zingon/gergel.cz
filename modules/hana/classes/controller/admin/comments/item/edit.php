<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace clanku - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Comments_Item_Edit extends Controller_Hana_Edit
{
    protected $item_name_property=array("title"=>"s názvem");
    

    public function before() {
        $this->orm=new Model_Comment();
        //$this->action_buttons=array_merge($this->action_buttons,array("odeslat_3"=>array("name"=>"odeslat_3","value"=>"odeslat a editovat galerii","hrefid"=>"article/item/gallery/")));
        
        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("datetime")->type("datepicker")->label("Datum")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->set();
        $this->auto_edit_table->row("author")->type("edit")->label("Autor")->set();
        $this->auto_edit_table->row("email")->type("edit")->label("E-mail autora")->set();
        
        $this->auto_edit_table->row("authorized")->type("checkbox")->label("Autorizovat")->set();
        $this->auto_edit_table->row("text_question")->type("editor")->label("Text dotazu")->set();
        $this->auto_edit_table->row("text_response")->type("editor")->label("Text odpovědi")->set();
        //$this->auto_edit_table->row("preferred")->type("checkbox")->value(0)->label("Zobrazit na úvodní straně")->set();
        
    }

   
}