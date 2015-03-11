<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace statickeho obsahu stranek - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Static_Item_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    protected $item_name_property=array("kod"=>"s kódem");


    
    public function before() {
        $this->orm=new Model_Static_Content();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("kod")->type("edit")->label("Kód")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("popis")->type("editor")->label("Text")->set();
    }


}