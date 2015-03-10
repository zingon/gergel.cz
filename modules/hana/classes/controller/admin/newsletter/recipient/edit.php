<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace clanku - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Newsletter_Recipient_Edit extends Controller_Hana_Edit
{
    protected $with_route=true;
    protected $item_name_property=array("email"=>"s názvem");
    

    public function before() {
        $this->orm=new Model_Newsletter_Recipient();
        
        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("email")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
       
        $this->auto_edit_table->row("allowed")->type("checkbox")->default_value(1)->label("Povolen")->set();

        
    }

    
}