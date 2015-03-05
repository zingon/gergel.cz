<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace nastaveni.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Environment_Mainsetup_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    protected $back_link_url;
    protected $back_link_text="Zpět";
    protected $cloneable=false;

    public function before() {
        $this->orm=new Model_Admin_Setting();

        $this->back_link_url = url::base()."admin/environment/module/default";
        $this->send_link_url = url::base()."admin/environment/module/default";

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("nazev_dodavatele")->type("edit")->label("Název (firma) dodavatele")->set();
        $this->auto_edit_table->row("email_podpora_dodavatele")->type("edit")->label("E-mail podpora dodavatele")->set();
        //$this->auto_edit_table->row("logo_dodavatele")->type("edit")->label("Ulice")->set();
        $this->auto_edit_table->row("kohana_debug_mode")->type("checkbox")->label("Kohana debug mód")->set();
        $this->auto_edit_table->row("smarty_console")->type("checkbox")->label("Smarty debug/console mód")->set();
        $this->auto_edit_table->row("disable_login")->type("checkbox")->label("Zaablokovat login")->condition("Znemožnení přihlášení do adminu (mimo superadmina)")->set();
        $this->auto_edit_table->row("shutdown")->type("checkbox")->label("Shutdown")->condition("(odstaví frontend projektu - údržba)")->set();
        $this->auto_edit_table->row("interni_poznamka")->type("editor")->label("Interní poznámka k projektu")->set();
    }

    /**
     * Akce na smazani obrazku !
     * @param <type> $data
     */
    protected function _form_action_main_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], $this->subject_dir);
    }
}