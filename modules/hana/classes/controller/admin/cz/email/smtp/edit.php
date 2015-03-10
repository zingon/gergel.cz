<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace nastaveni.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Email_SMTP_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    protected $back_link_url;
    protected $back_link_text="Zpět";

    public function before() {
        $this->orm=new Model_Email_Settings();

        $this->back_link_url = url::base()."admin/cz/email/queue/list";
        $this->send_link_url = url::base()."admin/cz/email/queue/list";

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("mailer")->type("selectbox")->data_src(array("data_array"=>array("mail"=>"mail","sendmail"=>"sendmail","smtp"=>"smtp")))->label("Mailer")->set();
        $this->auto_edit_table->row("host")->type("edit")->label("Host")->set();
        $this->auto_edit_table->row("port")->type("edit")->label("Port")->css_class("short")->value(25)->set();
        $this->auto_edit_table->row("SMTPSecure")->type("selectbox")->label("SMTP Secure")->data_src(array("data_array"=>array(""=>"---","ssl"=>"ssl","tls"=>"tls")))->set();
        $this->auto_edit_table->row("SMTPAuth")->type("checkbox")->label("SMTP Auth")->set();
        $this->auto_edit_table->row("SMTPDebug")->type("checkbox")->label("SMTP Debug")->set();
        $this->auto_edit_table->row("username")->type("edit")->label("Username")->set();
        $this->auto_edit_table->row("password")->type("edit")->label("Password")->set();
        
    }

    
}