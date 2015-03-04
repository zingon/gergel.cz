<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace clanku - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Environment_Langstrings_Edit extends Controller_Hana_Edit
{
    protected $with_route=true;
    protected $item_name_property=array("string"=>" ");
    

    public function before() {
        $this->orm=new Model_Language_String();
        
        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("string")->type("edit")->label("Výraz")->condition("Položka musí mít minimálně 3 znaky.")->set();
        //$this->auto_edit_table->row("zobrazit")->type("checkbox")->value(1)->label("Zobrazit")->set();     
    }


    
    
}