<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Administrace clanku - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Image_Item_Edit extends Controller_Hana_Edit
{

    public function before() {
        $this->orm=new Model_Image();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->set();
        $this->auto_edit_table->row("link")->type("edit")->label("Odkaz")->set();
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->default_value(1)->label("Zobrazit")->set();
        $this->auto_edit_table->row("main_image")->type("image")->item_settings(array("dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"jpg","delete_link"=>true))->label("Náhled obrázku")->set();
        $this->auto_edit_table->row("main_image_src")->type("filebrowser")->label("Zdroj obrázku")->set();

    }


    protected function _form_action_main_postvalidate($data) {
        parent::_form_action_main_postvalidate($data);
        // vlozim o obrazek
        if(isset($_FILES["main_image_src"]) && $_FILES["main_image_src"]["name"])
        {
            // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
            $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo");
            $this->module_service->insert_image("main_image_src", $this->subject_dir, $image_settings, SEO::uprav_fyzicky_nazev($data["nazev"]));
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