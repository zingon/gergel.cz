<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Cz_User_Item_List extends Controller_Hana_List
{
    protected $with_route=true;
    protected $default_order_by="username";
    
    public function before() {
        $this->orm=new Model_User();
        parent::before();
    }

    protected function _column_definitions()
    {
        // kod, uživatelské jméno, Název, Objednávky, Email, Přihlášení, Smazat
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("username")->type("link")->item_settings(array("hrefid"=>$this->base_path_to_edit))->label("Uživatelské jméno")->css_class("txtLeft")->set();
        $this->auto_list_table->column("email")->label("E-mail")->css_class("txtLeft")->set();
        $this->auto_list_table->column("last_login")->label("Poslední přihlášení")->item_settings(array("special_format"=>"cz_datetime_timestamp"))->width(130)->css_class("txtLeft")->set();
//        $this->auto_list_table->column("poradi")->type("changeOrderShifts")->label("")->width(27)->set();
//        $this->auto_list_table->column("zobrazit")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->label("")->width(20)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(20)->set();
    }

    protected function _orm_setup()
    {

        //$this->orm->join("roles_users")->on("users.id","=","roles_users.user_id");
        //$this->orm->join("roles")->on("roles.id","=","roles_users.role_id");
        $xuser=Auth::instance()->get_user();
        if($xuser->username!="hana")
        {
            $this->orm->where("users.username","<>","hana");
            $this->orm->and_where_open();
            $this->orm->or_where("users.id","=",$xuser->id);
            $this->orm->or_where("users.created_by","=",$xuser->id);
            $this->orm->and_where_close();
        }
    }



}
?>
