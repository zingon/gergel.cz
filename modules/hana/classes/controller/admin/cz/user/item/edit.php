<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace nastaveni.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_User_Item_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    protected $item_name_property=array("username"=>"s uživatelským jménem");

    protected $user_exists=false;

    public function before() {
        $this->orm=new Model_User();
        parent::before();

    }

    protected function _column_definitions()
    {
        $xuser=Auth::instance()->get_user();
        if($xuser->username!="hana" && $this->orm->id && ($this->orm->id!=$xuser->id && $this->orm->created_by!=$xuser->id))
        {
            throw new Kohana_Exception("Nepovolený přístup - nejste oprávněn(a) editovat tohoto uživatele!");
        }

        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("username")->type("edit")->label("Uživatelské jméno")->condition("Položka musí mít minimálně 4 znaky.")->set();
        $this->auto_edit_table->row("password")->type("password")->value("")->label("Heslo")->condition("Položka musí mít minimálně 5 znaků.")->set();
        $this->auto_edit_table->row("password_confirm")->type("password")->value("")->label("Heslo - potvrzení")->set();
        $this->auto_edit_table->row("email")->type("edit")->label("E-mail")->condition("Položka musí mít minimálně 4 znaky.")->set();
    }

    protected function _form_action_main_prevalidate($data) {
        parent::_form_action_main_prevalidate($data);
        if($this->orm->id){$this->user_exists=true; }

        if($this->user_exists==true && !$_POST["password"] && !$_POST["password_confirm"]){unset($data["password"]); unset($data["password_confirm"]); $this->orm->check_password=false;}
        return $data;
    }

    protected function _form_action_main_postvalidate($data) {
        parent::_form_action_main_postvalidate($data);

        if(!$this->user_exists)
        {
            $role1=orm::factory("role")->where("name","=","login")->find();
            $role2=orm::factory("role")->where("name","=","admin")->find();
            $this->orm->add("roles", $role1);
            $this->orm->add("roles", $role2);
            
        }
        $xuser=Auth::instance()->get_user();
        $this->orm->created_by=$xuser->id;
        $this->orm->save();

    }

}