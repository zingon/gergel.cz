<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Moznost uploadu popupu..
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2011 Pavel Herink
 */

class Controller_Admin_Environment_Popup_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    protected $back_link_url;
    protected $back_link_text="Zpět";

    public function before() {
        $this->orm=new Model_Popup();

        $this->back_link_url = url::base()."admin/environment/module/default";
        $this->send_link_url = url::base()."admin/environment/module/default";

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("datum_od")->type("datepicker")->label("Datum počátku zobrazení")->set();
        $this->auto_edit_table->row("datum_do")->type("datepicker")->label("Datum konce zobrazení")->set();
        $this->auto_edit_table->row("text")->type("textarea")->label("Text(*)")->condition(" *Text na základním pozadí bude zobrazen pouze v případě, nebude-li zvolen žádný obrázek.")->set();
        $this->auto_edit_table->row("main_image_src")->type("filebrowser")->label("Zdroj obrázku")->set();
        $this->auto_edit_table->row("main_image")->type("image")->item_settings(array("dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"jpg","delete_link"=>true))->label("Náhled obrázku")->set();
        $this->auto_edit_table->row("jednorazovy")->type("checkbox")->value(1)->label("Jednorázové zobrazení")->set();
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->value(1)->label("Zobrazit")->set();
    }

    
    protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);
       
       $current=$this->orm->counter;
       
       $this->orm->counter=$current+1;
       $this->orm->save();
       
       // vlozim o obrazek
       if(isset($_FILES["main_image_src"]) && $_FILES["main_image_src"]["name"])
       {
           // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
           $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo");

           $this->module_service->insert_image("main_image_src", $this->subject_dir, $image_settings, "popupimage_".$this->orm->id."_".$this->orm->language_id);
       }

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
