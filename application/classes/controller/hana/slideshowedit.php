<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Zakladni kontroler - sablona pro implementaci fotogalerii. Nutno nastavit ormko s pripojenymi fotografiemi.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

abstract class Controller_Hana_Slideshowedit extends Controller_Hana_Edit {

    protected $extension="jpg"; // jpg, png, gif, auto - pro automaticke zachovani pripony obrazku

    protected $settings_submodule_code="gallery"; // sloupecek "submudule_code" v settings, odkud se berou rozmery fotek

    protected $image_dir;
    
    protected $cloneable=false;
    protected $copy_lang_link=false;

    protected $action_buttons=array();

    protected $subject;
    protected $subject_suffix="_slideshow";
    protected $subject_col_id_name;
    protected $subject_photos_name;

    public function before() {
        parent::before();
        // automaticky generovany image-dir - bude stejny pro vsechny moduly ve vychozim stavu
        $this->image_dir=$this->module_key."/".$this->submodule_key."/".$this->subaction_key."/";

        $this->subject=strtolower($this->orm->class_name);
        $this->subject_col_id_name=$this->subject."_id";
        $this->subject_photos_name=$this->subject.$this->subject_suffix;
        
        $this->set_module_key=$this->module_key;
        
        $this->table->back_to_item=url::base().Kohana::$index_file."admin/".$this->module_key."/".$this->submodule_key."/edit/1/".$this->item_id;
        $this->table->back_to_item_text="Zpět na položku";
        
        $this->table->edit_form_subinfo="<img src=\"".url::base().Kohana::$index_file."media/admin/img/arrow_up_down.png\" alt=\"řazení tažením aktivováno\" width=\"16\" height=\"16\" /> Řazení položek tažením myší je <span class=\"bold\">aktivováno</span>.";
    }

    protected function _column_definitions()
    {
          $main_gallery_key="main_gallery"; // rozliseni pokud bychom v budoucnu chteli generovat vice photoeditu v jednom editu

          //if($this->admlang==1) $this->auto_edit_table->row("link_new")->type("link")->item_settings(array("href"=>$this->base_admin_path."?".$main_gallery_key."_editphoto=0","HTML"=>array("class"=>"button ajaxelement")))->variant("one_col")->value("přidat novou fotografii")->set();
          //$this->auto_edit_table->row("link_new_zip")->type("link")->item_settings(array("href"=>$this->base_admin_path."?".$main_gallery_key."_editphoto=0","HTML"=>array("class"=>"button")))->variant("one_col")->value("přidat fotky ze zip archivu")->set();
          
          if($this->admlang==1) $this->auto_edit_table->row("link_new")->type("photoeditlinks")->item_settings(array("href"=>$this->base_admin_path."?".$main_gallery_key))->variant("one_col")->set();
          

          $this->auto_edit_table->row($main_gallery_key)->type("photoedit")->data_src(array("image_dir"=>$this->image_dir,"href"=>$this->base_admin_path,"photos_orm_name"=>$this->subject."_Slideshow"))->variant("one_col")->set();
//        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
//        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
//        $this->auto_edit_table->row("popis")->type("editor")->label("Text")->set();
//        $this->auto_edit_table->row("main_image_src")->type("filebrowser")->label("Zdroj obrázku")->set();
//        $this->auto_edit_table->row("main_image")->type("image")->item_settings(array("dir"=>$this->image_dir,"suffix"=>"at","ext"=>"jpg","delete_link"=>true))->label("Náhled obrázku")->set();
          
    }

    protected function _form_action_photoedit_main_gallery_add($data)
    {
        $errors="";
        // primitivni predvalidovani dat
        //if(!$data["nazev"]) $errors["nazev"]="musí být zadán název";
        if(!$data["photo_id"])
        {
            // prvni zadavani - musi byt zdroj obrazku a pokud neni nazev, vytvori se z tohoto zdroje
            if(!$_FILES['gallery_image_src']["name"]) $errors["src"]="musí být vybrán soubor obrázku";
            if(empty($errors) && !$data["nazev"]) $data["nazev"]=Service_Hana_File::get_raw_file_name($_FILES['gallery_image_src']['name']);
        }
        else
        {
            // editace - nemusi byt zdroj obrazku

            if(!isset($_FILES['gallery_image_src']) || !$_FILES['gallery_image_src']["name"])
            {
                // 1) neni obrazek - musi byt nazev
                if($data["language_id"]==1)
                {    
                    if(!$data["nazev"]) $errors["nazev"]="název obrázku musí být zadán";
                }
            }
            else
            {
                // 2) je obrazek - pokud neni nazev - pouziju opet nazev z obrazku
                if(!$data["nazev"]) $data["nazev"]=Service_Hana_File::get_raw_file_name($_FILES['gallery_image_src']['name']);
            }

        }
        // validace probehly, data jsou predzpracovana, prejdu k procesu jejich ulozeni

        // vlastni zpracovani dat
        if(empty($errors))
        {
            // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
            $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->set_module_key, $this->settings_submodule_code, "photo");
            //die($this->set_module_key."-".$this->settings_submodule_code."-photo");
            
            // ziskani vychoziho ormka v zavislosti na tom, zda jde o editaci nebo novou polozku
            if($data["photo_id"])
            {
                $subject_photos=orm::factory($this->subject_photos_name)->language($data["language_id"])->where($this->subject."_slideshows.id","=",$data["photo_id"])->find();
            }
            else
            {
                $subject_photos=orm::factory($this->subject_photos_name);
            }
            // predam data ke zpracovani a ulozeni modulove servise
            $result=$this->module_service->insert_gallery_image($subject_photos, $this->subject_col_id_name, $this->item_id, "gallery_image_src", $this->image_dir, $image_settings, $data);
        }

        // pokud servisa vrati chybu, pridam ji do chyb
        if(isset($result) && $result !== true) $errors=$result;

        // zhodnoceni vysledku
        if($errors)
        {
            // neuspesne zpracovani dat
            $this->data_processing_errors=$errors; // nastaveni chyby
            $data["action"]="main_gallery_editphoto"; // toto nastaveni zpusobi, ze se otevre znovu dialogove okno
            return($data);
            
        }
        else
        {
            // uspesne zpracovani dat
            $this->data_saved=true;
        }
    }
    
    protected function _form_action_photoedit_main_gallery_add_multiple($data)
    {
      if(isset($_FILES["Filedata"])) 
      {
          if(count($_FILES["Filedata"]["error"]) < 2) {
            // Single file
            //$tmp_name = $_FILES["Filedata"]["tmp_name"];
            //$name = $_FILES["Filedata"]["name"];
            //move_uploaded_file($tmp_name, "$uploads_dir/$name");
            $_FILES['gallery_image_src']=$_FILES["Filedata"];
            $this->_form_action_photoedit_main_gallery_add($data);
           } 
           else 
           {
                // Multiple files
                foreach ($_FILES["Filedata"]["error"] as $key => $error) {
                    if ($error == UPLOAD_ERR_OK) {
                        //$tmp_name = $_FILES["Filedata"]["tmp_name"][$key];
                        //$name = $_FILES["Filedata"]["name"][$key];
                        //move_uploaded_file($tmp_name, "$uploads_dir/$name");
                        $_FILES['gallery_image_src']["tmp_name"]=$_FILES["Filedata"]["tmp_name"][$key];
                        $_FILES['gallery_image_src']["name"]=$_FILES["Filedata"]["name"][$key];
                        $this->_form_action_photoedit_main_gallery_add($data);
                    }
                }

            }
            $this->data_saved=true;
       }
    }

    
    protected function _form_action_photoedit_main_gallery_add_zip($data)
    {
        $errors=array();
        // primitivni predvalidovani dat
        //if(!$data["nazev"]) $errors["nazev"]="musí být zadán název";

        if(!$_FILES['gallery_image_src']["name"]) $errors["src"]="musí být vybrán soubor archivu";
//        if(empty($errors) && !$data["nazev"]) $data["nazev"]=Service_Hana_File::get_raw_file_name($_FILES['gallery_image_src']['name']);
//        
        // validace probehly, data jsou predzpracovana, prejdu k procesu jejich ulozeni

        // vlastni zpracovani dat
        if(empty($errors))
        {
            // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
            $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->set_module_key, $this->settings_submodule_code, "photo");
          
            $subject_photos=orm::factory($this->subject_photos_name);
            

            // predam data ke zpracovani a ulozeni modulove servise
            $result=$this->module_service->insert_gallery_image_zip($subject_photos, $this->subject_col_id_name, $this->item_id, "gallery_image_src", $this->image_dir, $image_settings, $data);
        }

        // pokud servisa vrati chybu, pridam ji do chyb
        if(isset($result) && $result !== true) $errors=$result;

        // zhodnoceni vysledku
        if($errors)
        {
            // neuspesne zpracovani dat
            $this->data_processing_errors=$errors; // nastaveni chyby
            $data["action"]="main_gallery_add_zip"; // toto nastaveni zpusobi, ze se otevre znovu dialogove okno
            return($data);
            
        }
        else
        {
            // uspesne zpracovani dat
            $this->data_saved=true;
        }
    }

    
    protected function _form_action_photoedit_main_gallery_delete($data)
    {
        $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->set_module_key, $this->settings_submodule_code, "photo");
        $orm=orm::factory($this->subject_photos_name);
        $this->module_service->delete_image($data["photo_id"], $this->image_dir, $orm, $this->subject_col_id_name, $image_settings);
        $this->data_saved=true;
    }
    
    protected function _form_action_photoedit_main_gallery_multiple_delete($data)
    {
        foreach ($data["photos_id"] as $photo_id=>$val)            
        {
            $this->_form_action_photoedit_main_gallery_delete(array("photo_id"=>$photo_id));
        }
        $this->data_saved=true;
    }

    protected function _form_action_photoedit_main_gallery_visibility($data)
    {   
        $orm=orm::factory($this->subject_photos_name);
        $this->module_service->change_visibility($data["photo_id"], $data["state_value"], $orm);
        $this->data_saved=true;
    }

    protected function _form_action_photoedit_main_gallery_favorite($data)
    {

    }

    protected function _form_action_photoedit_main_gallery_change_order($data)
    {
        $orm=orm::factory($this->subject_photos_name);
        $this->module_service->reorder_two_items($data["photo_id"], $data["direction"], $orm, $this->subject_col_id_name);
        $this->data_saved=true;
    }

    protected function _form_action_photoedit_main_gallery_change_order_multiple($data)
    {
        $this->module_service->reorder_many_items($this->subject_photos_name."s",$data["sequence"],array($this->subject_col_id_name, $this->orm->id));
        $this->data_saved=true;
    }




}
?>
