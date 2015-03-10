<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace clanku - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Newsletter_Item_Edit extends Controller_Hana_Edit
{
    protected $with_route=true;
    protected $item_name_property=array("nazev"=>"s názvem");
    

    public function before() {
        $this->orm=new Model_Newsletter();
        
        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("date")->type("datepicker")->label("Datum")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
        
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->default_value(1)->label("Aktivováno")->set();
        
        $this->auto_edit_table->row("popis")->type("editor")->label("Text")->set();
        //$this->auto_edit_table->row("preferred")->type("checkbox")->value(0)->label("Zobrazit na úvodní straně")->set();
        
    }

    protected function _form_action_main_postvalidate($data)
    {
        $data = parent::_form_action_main_postvalidate($data);
        
        // vytvorim frontu newsletteru
        if($this->orm->id)
        {
            Service_Newsletter::create_newsletters($this->orm->id);
        }
    }
    
}