<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Trida reprezentujici tlacitko pro vyber souboru (edit). Doplneno o link pro zobrazeni souboru a mazani.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

 class AutoForm_Item_Filebrowserextended extends AutoForm_Item
 {
     
public function pregenerate($data_orm) {
           $this->data_orm=$data_orm;
//         $data=parent::pregenerate($data_orm);
//         if($data) die($data);
           $data=array();
           if(isset($_GET[$this->entity_name."_delete"]))
           {
               $data["hana_form_action"]=$this->entity_name."_delete";
               $data["delete_file_id"]=$_GET[$this->entity_name."_delete"];
           }
           return $data;
     }

 public function generate($data_orm, $template=false)
 {
     if(!$this->parent_container instanceof AutoForm_MultipleContainer)
     {
         // v editu budu pracovat s puvodnim orm objektem, nikoliv s formularovymi daty
         $data_orm=$this->data_orm;
     }
     // nazev souboru
     if($this->value)
     {
        $src=$this->value;
     }
     else
     {
         // obrazky budou mit v nazvu standardne nazev_seo ORMka
         if(isset($this->settings["name"]))
         {
             $src1=$this->settings["name"];  
         }
         elseif(isset($this->settings["db_col_name"]))
         {
             $dbcol=$this->settings["db_col_name"];
             $src1=$data_orm->$dbcol;
         }
         else
         {
             $src1=$data_orm->file_src;
         }


         if(is_object($data_orm))
         {
            $src="media/files/".$this->settings["dir"]."files-".$data_orm->id."/".$src1;
         }
         else
         {
             $src="";
         }


     }

     //echo($src."<br />");

     $filename=str_replace('\\', '/',DOCROOT).$src;

     //echo($filename."<br />");
     
     $file="<input type=\"file\" name=\"".$name."\" ".$this->settings["HTML"]." />\n";
     
     if(file_exists($filename))
     {
         // zprovozneni lightboxu
         $file.="<a href=\"".url::base().$src."?rnadid=".rand(0, 1000)."\" />".$src1."</a>\n";

         if(isset($this->settings["delete_link"]) && $this->settings["delete_link"])
            //$delete_link=($this->settings["delete_link"]===true)?:$this->settings["delete_link"];
            $file.="<a href=\"?".$this->entity_name."_delete=".$data_orm->id."\" title=\"smazat soubor\"><img src=\"".url::base()."media/admin/img/delete.png\" alt=\"smazat soubor\" /></a>";
     }
     else
     {
         $file.="-- soubor nebyl vložen --";
     }

     return($file);

 }

//     public function generate($data_orm, $template=false)
//     {
//        if($this->parent_container instanceof AutoForm_MultipleContainer)
//        {
//            $name = $this->entity_name."[".$data_orm->id."]";
//        }
//        else
//        {
//            $name = $this->entity_name;
//        }
//
//        //$value = (($this->value!==false)? $this->value : (($data_orm->$name)?$data_orm->$name : false));
//        if($this->disabled) return "";
//        return("<input type=\"file\" name=\"".$name."\" ".$this->settings["HTML"]." />\n");
//     }

 }


 ?>
