<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Vygeneruje okno s fotkami a obsluznymi procedurami. (photo_box) Navrzeno pro edit - v listu nezame chovani :-)
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Item_Photoedit extends AutoForm_Item {

    private $gallery_orm;

    private $image_dir;
    private $media_path="media/photos/";

    private $subject_id;
    private $photos_orm_name;

    private $poradi_min;
    private $poradi_max;
    
    private $lang;

    public function pregenerate($data_orm) {
        $this->subject_id=$data_orm->id;
        $this->image_dir=url::base().$this->media_path.$this->data_src["image_dir"];

        $subject=strtolower($data_orm->class_name);
        $this->photos_orm_name=$this->data_src["photos_orm_name"];
        // nacteni fotek z galerie
        $this->lang=Session::instance()->get("admlang");
        if(!$this->lang) $this->lang=1;
        $this->gallery_orm=orm::factory($this->photos_orm_name)->where($subject."_id","=",$data_orm->id)->order_by("poradi","asc")->language($this->lang);

        $result = DB::select(array(DB::expr('min(poradi)'),'range_min'))->select(array(DB::expr('max(poradi)'),'range_max'))->from($this->photos_orm_name."s")->where($subject."_id","=",$data_orm->id)->execute();
        $this->poradi_min=$result[0]["range_min"];
        $this->poradi_max=$result[0]["range_max"];
   
        $result_data=array();

        // zjistim pripadna data z predchoziho pozadavku, predzpracuju je, nastavim akce a odeslu ke zpracovani do kontroleru
        // pozadavek na pridani a editaci
        
        if(isset($_POST["photoedit_action_add"]) && $_POST["photoedit_action_add"]==$this->entity_name)
        {
            $result_data["id"]=isset($_POST["photo_id"])?$_POST["photo_id"]:0;
            $result_data["language_id"]=isset($_POST["language_id"])?$_POST["language_id"]:1;
            $result_data["hana_form_action"]="photoedit_".$this->entity_name."_add";
            $result_data["nazev"] = isset($_POST["nazev"])?$_POST["nazev"]:"";
            $result_data["popis"] = isset($_POST["popis"])?$_POST["popis"]:"";
            $result_data["zobrazit"] = isset($_POST["zobrazit"])?1:0;
            // obrazku zdroj nactu primo v obsluzny servise
            $result_data["photo_id"] = isset($_POST["photo_id"])?$_POST["photo_id"]:0;
            $result_data["nahled_src"] = isset($_POST["nahled_src"])?$_POST["nahled_src"]:"";

        }
        // pozadavek na pridani ze zipu
        elseif(isset($_POST["photoedit_action_add_multiple"]) && $_POST["photoedit_action_add_multiple"]==$this->entity_name)
        {
            $result_data["hana_form_action"]="photoedit_".$this->entity_name."_add_multiple"; 
            $result_data["id"]=0;
            $result_data["language_id"]=1;
            $result_data["nazev"] = "";
            $result_data["popis"] = "";
            $result_data["zobrazit"] = 1;

            // obrazku zdroj nactu primo v obsluzny servise
            $result_data["photo_id"] = 0;
            $result_data["nahled_src"] = "";
        }
        // pozadavek na pridani ze zipu
        elseif(isset($_POST["photoedit_action_add_zip"]) && $_POST["photoedit_action_add_zip"]==$this->entity_name)
        {
            $result_data["language_id"]=isset($_POST["language_id"])?$_POST["language_id"]:1;
            $result_data["hana_form_action"]="photoedit_".$this->entity_name."_add_zip";
            $result_data["nazev"] = isset($_POST["nazev"])?$_POST["nazev"]:"";
            $result_data["popis"] = isset($_POST["popis"])?$_POST["popis"]:"";
            $result_data["zobrazit"] = isset($_POST["zobrazit"])?1:0;
            $result_data["extract_type"] = isset($_POST["extract_type"])?$_POST["extract_type"]:"";
        }
        // pozadavek na smazani
        elseif(isset($_GET["photoedit_action_delete"]) && $_GET["photoedit_action_delete"])
        {
            $result_data["hana_form_action"]="photoedit_".$this->entity_name."_delete";
            $result_data["photo_id"]=$_GET["photo_id"];
        }
        
        // pozadavek na hromadne smazani
        elseif(isset($_POST["delitem"]) && $_POST["delitem_gallery"]==$this->entity_name && !empty($_POST["selitem"]))
        {
            $result_data["hana_form_action"]="photoedit_".$this->entity_name."_multiple_delete";
            $result_data["photos_id"]=$_POST["selitem"];
        }

        // pozadavek na zmenu viditelnosti
        elseif(isset($_GET["photoedit_action_visibility"]) && $_GET["photoedit_action_visibility"]==$this->entity_name)
        {
            $result_data["hana_form_action"]="photoedit_".$this->entity_name."_visibility";
            $result_data["photo_id"]=$_GET["photo_id"];
            $result_data["state_value"]=$_GET["state_value"];
        }

        // pozadavek na nastaveni oblibene fotky
        elseif(isset($_GET["photoedit_action_favorite"]) && $_GET["photoedit_action_favorite"]==$this->entity_name)
        {
            $result_data["hana_form_action"]="photoedit_".$this->entity_name."_favorite";
        }

        // pozadavek na zmenu poradi sipkami
        elseif(isset($_GET["photoedit_action_reorder"]) && $_GET["photoedit_action_reorder"]==$this->entity_name)
        {
            $result_data["hana_form_action"]="photoedit_".$this->entity_name."_change_order";
            $result_data["photo_id"]=$_GET["photo_id"];
            $result_data["direction"]=$_GET["reorder_direction"];
        }

        // pozadavek na zmenu poradi tazenim
        if(isset($_GET["photoedit_action_reorder_drag"]) && $_GET["photoedit_action_reorder_drag"]==$this->entity_name)
        {
            $selid=(int) trim(substr($_GET["item"][0],5,5));
            $newarr=array();
            $newarr[0]=$selid;
            for($a=1;$a<count($_GET["item"]);$a++) $newarr[]=$_GET["item"][$a];
            $result_data["hana_form_action"]="photoedit_".$this->entity_name."_change_order_multiple";
            $result_data["sequence"]=$newarr;
        }

        // pozadavek na zmenu poradi tazenim
        if(isset($_POST["photoedit_action_chorderdrag"]) && $_POST["photoedit_action_chorderdrag"]==$this->entity_name)
        {
            $result_data["hana_form_action"]="photoedit_".$this->entity_name."_chorderdrag";
        }

        return $result_data;
    }

    public function generate($data, $template=false) {
        //parent::generate($data, $template);
        //die(var_dump($data));

        $photoedit_template = new View("admin/edit/base_photo_edit");
        // ziskani vsech fotek a jejich vyplneni do formulare
        $photoedit_template->media_path=url::base().$this->media_path;
        $photoedit_template->admin_path=$this->data_src["href"];
        $photos_array=array();
        //die(print_r($this->gallery_orm->find_all()));
        foreach($this->gallery_orm->find_all() as $photo)
        {
            $photos_array[]=array(
              "id"=>$photo->id,
              "language_id"=>$photo->language_id,
              "nazev"=>$photo->nazev,
              "src_at"=>$this->image_dir."images-".$this->subject_id."/".$photo->photo_src."-at.".$photo->ext,
              "src_ad"=>$this->image_dir."images-".$this->subject_id."/".$photo->photo_src."-ad.".$photo->ext,
              "popis"=>$photo->popis,
              "preferovana"=>"",
              "zobrazit"=>$photo->zobrazit,
              "move_up"=>(($photo->poradi > $this->poradi_min /*&& $this->lang==1*/)?1:0),
              "move_down"=>(($photo->poradi < $this->poradi_max /*&& $this->lang==1*/)?1:0),
            );
        }
        //die(print_r($photos_array));
        $photoedit_template->entity_name=$this->entity_name;
        $photoedit_template->photos=$photos_array;
        $photoedit_template->language_id=$this->lang;
        $result_data=$photoedit_template->render();

        // byl pozadavek na zobrazeni formulare pro pridani/editaci polozky, nebo nevyrizena polozka
        if(isset($_GET[$this->entity_name."_editphoto"]) || (is_array($data) && isset($data["action"]) && ($data["action"]==$this->entity_name."_editphoto" && isset($data["form_errors"]))))
        {
            $selected_language=$this->lang;
                
            // nasetuju ormko pro editaci/novou fotku
            if(isset($_GET[$this->entity_name."_editphoto"]))
            {
                $orm=orm::factory($this->photos_orm_name)->where($this->photos_orm_name."s.id","=",$_GET[$this->entity_name."_editphoto"])->language($selected_language)->find();//->join($this->photos_orm_name."_data","LEFT")->on($this->photos_orm_name."s.id","=",$this->photos_orm_name."_data.".$this->photos_orm_name."_id")->on($this->photos_orm_name."_data.language_id","=",$selected_language)->find();
                $data=$orm->as_array();
            }
    
            $photo_form=new View("admin/edit/base_photo_edit_dialog");

            // nastavim vychozi zaskrtnuti checkboxu pro novou fotku
            if(isset($_GET[$this->entity_name."_editphoto"]) && $_GET[$this->entity_name."_editphoto"]==0) $data["zobrazit"]=1;

            if($data && is_array($data))
            {
                $photo_form->nazev=$data["nazev"];
                $photo_form->photo_id=isset($data["id"])?$data["id"]:0;
                $photo_form->language_id=$selected_language;
                
                $photo_form->popis=$data["popis"];
                $photo_form->zobrazit=$data["zobrazit"];
                if(isset($data["photo_src"]))
                {
                    $photo_form->nahled_src=$this->image_dir."images-".$this->subject_id."/".$data["photo_src"]."-at.".$data["ext"];
                }
                elseif(isset($data["nahled_src"]) && $data["nahled_src"])
                {
                    $photo_form->nahled_src=$data["nahled_src"];
                }
                else
                {
                    $photo_form->nahled_src="";
                }
                
                $photo_form->form_errors=isset($data["form_errors"])?$data["form_errors"]:array();
            }
            $photo_form->entity_name=$this->entity_name;
            // pokud jsou zaslana data na editaci polozky, nahrajeme data do formulare

            $result_data.=$photo_form->render();
        }
        elseif(isset($_GET[$this->entity_name."_addmultiple"]) || (is_array($data) && isset($data["action"]) && ($data["action"]==$this->entity_name."_addmultiple" && isset($data["form_errors"]))))
        {
            $selected_language=$this->lang;
    
            $photo_form=new View("admin/edit/base_photo_edit_dialog_add_multiple");
            $photo_form->entity_name=$this->entity_name;
            $photo_form->base_admin_path = $this->data_src["href"];
            $photo_form->max_files=15;
            //$photo_form->language_id=$selected_language;
            

            $result_data.=$photo_form->render();
        }
        elseif(isset($_GET[$this->entity_name."_addzip"]) || (is_array($data) && isset($data["action"]) && ($data["action"]==$this->entity_name."_add_zip" && isset($data["form_errors"]))))
        {
            
            $selected_language=$this->lang;
            
            
            // nasetuju ormko pro editaci/novou fotku
//            if(isset($_GET[$this->entity_name."_editphoto"]))
//            {
//                $orm=orm::factory($this->photos_orm_name)->where($this->photos_orm_name."s.id","=",$_GET[$this->entity_name."_editphoto"])->language($selected_language)->find();//->join($this->photos_orm_name."_data","LEFT")->on($this->photos_orm_name."s.id","=",$this->photos_orm_name."_data.".$this->photos_orm_name."_id")->on($this->photos_orm_name."_data.language_id","=",$selected_language)->find();
//                $data=$orm->as_array();
//            }
    
            $photo_form=new View("admin/edit/base_photo_edit_dialog_zip");

            $photo_form->language_id=$selected_language;
            if($data && is_array($data))
            {
                $photo_form->nazev=$data["nazev"];
                $photo_form->photo_id=isset($data["id"])?$data["id"]:0;
                $photo_form->language_id=$selected_language;
                
                $photo_form->popis=$data["popis"];
                $photo_form->zobrazit=$data["zobrazit"];
                
                $photo_form->form_errors=isset($data["form_errors"])?$data["form_errors"]:array();
            }
            $photo_form->entity_name=$this->entity_name;
            
            // nastavim vychozi zaskrtnuti checkboxu pro novou fotku
            if(isset($_GET[$this->entity_name."_addzip"]) && $_GET[$this->entity_name."_addzip"]) $photo_form->zobrazit=1;

            // pokud jsou zaslana data na editaci polozky, nahrajeme data do formulare

            $result_data.=$photo_form->render();
        }
        
        return $result_data;

    }

}
?>
