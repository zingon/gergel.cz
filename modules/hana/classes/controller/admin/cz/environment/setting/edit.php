<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace nastaveni.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Environment_Setting_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    protected $back_link_url;
    protected $back_link_text="Zpět";
    protected $cloneable=false;

    public function before() {
        $this->orm=new Model_Owner();

        $this->back_link_url = url::base()."admin/".i18n::lang()."/environment/module/default";
        $this->send_link_url = url::base()."admin/".i18n::lang()."/environment/module/default";

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("default_title")->type("edit")->label("Hlavní název stránek")->set();
        $this->auto_edit_table->row("default_description")->type("edit")->label("Výchozí popis")->set();
        $this->auto_edit_table->row("default_keywords")->type("edit")->label("Výchozí klíčová slova")->set();
        $this->auto_edit_table->row("firma")->type("edit")->label("Jméno (název firmy)")->set();
        $this->auto_edit_table->row("ulice")->type("edit")->label("Ulice")->set();
        $this->auto_edit_table->row("mesto")->type("edit")->label("Město")->set();
        $this->auto_edit_table->row("psc")->type("edit")->label("PSČ")->set();
        $this->auto_edit_table->row("copyright")->type("edit")->label("Copyright")->set();
        $this->auto_edit_table->row("tel")->type("edit")->label("Telefon")->set();
        $this->auto_edit_table->row("email")->type("edit")->label("E-mail")->condition("(e-mail pro zasílání zpráv z kontaktního formuláře)")->set();
        $this->auto_edit_table->row("sitemap")->type("checkbox")->label("sitemap.xml")->condition("(vygenerovat nový sitemap.xml při uložení)")->value(0)->set();
        $this->auto_edit_table->row("ga_script")->type("edit")->label("Google Analytics kód")->condition("kód ve tvaru: UA-XXXXX-X")->set();

    }

    
    protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);

       // vygeneruju sitemapu na pozadani
       if($data["sitemap"]) Service_Sitemap::get_google_sitemap();

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