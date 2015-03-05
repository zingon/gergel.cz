<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace produktu - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Shopper_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    
    public function before() {
        $this->orm=new Model_Shopper();
        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        //$this->auto_edit_table->row("username")->type("edit")->label("Uživatelské jméno")->condition("Položka musí mít minimálně 4 znaky.")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("password")->type("edit")->value("")->label("Heslo")->condition("Položka musí mít minimálně 5 znaků.")->set();      
        //$this->auto_edit_table->row("price_category_id")->type("edit")->label("Cenová skupina")->set();
        $this->auto_edit_table->row("price_category_id")->type("selectbox")->label("Cenová skupina")->data_src(array("related_table_1"=>"price_category","column_name"=>"kod","orm_tree"=>false))->set();
        $this->auto_edit_table->row("email")->type("edit")->label("E-mail")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("telefon")->type("edit")->label("Telefon")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("ulice")->type("edit")->label("Ulice")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("mesto")->type("edit")->label("Město")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("psc")->type("edit")->label("PSČ")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("ic")->type("edit")->label("IČ")->set();
        $this->auto_edit_table->row("dic")->type("edit")->label("DIČ")->set();
    }
    
    protected function _form_action_main_prevalidate($data) {
        parent::_form_action_main_prevalidate($data);
        if($this->orm->id){$this->user_exists=true; }
        unset($this->orm->_rules["obchodni_podminky"]);
        $data["password_confirm"]=$data["password"];
        if($this->user_exists==true && !$_POST["password"]){unset($data["password"]); unset($data["password_confirm"]); $this->orm->check_password=false;}
        return $data;
    }

}