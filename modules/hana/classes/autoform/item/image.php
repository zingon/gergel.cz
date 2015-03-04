<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Trida reprezentujici obrazek.
 * specificka nastaveni:
 * dir - povinne - cesta k adresari
 * name - zaklad nazvu obrazku (jinak se bere hodnota ze sloupce photo_src)
 * suffix - sufix obrazku
 * ext - pripona obrazku
 *
 * value - pevna cesta k obrazku vcetne nazvu souboru
 * delete_link
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

 class AutoForm_Item_Image extends AutoForm_Item
 {
   
 public function pregenerate($data_orm) {
           $this->data_orm=$data_orm;
//         $data=parent::pregenerate($data_orm);
//         if($data) die($data);
           $data=array();
           if(isset($_GET[$this->entity_name."_delete"]))
           {
               $data["hana_form_action"]=$this->entity_name."_delete";
               $data["delete_image_id"]=$_GET[$this->entity_name."_delete"];
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
             $src1=$data_orm->photo_src;
         }

         // pripona
         if(isset($this->settings["ext"]))
         {
             $ext=$this->settings["ext"];
         }
         else
         {
             $columns=$data_orm->table_columns();
             if(isset($columns["ext"]) && $data_orm->ext) $ext=$data_orm->ext; else $ext="jpg";
         }

         // suffix
         $suffix=isset($this->settings["suffix"])?($this->settings["suffix"]):"";


         $src=$src1."-".$suffix.".".$ext;

         if(is_object($data_orm))
         {
            $src="media/photos/".$this->settings["dir"]."images-".$data_orm->id."/".$src;
         }
         else
         {
             $src="";
         }


     }


     $title=isset($this->settings["title"])?(" \"title\"=\"".$this->settings["title"]."\""):"";
     $alt=isset($this->settings["alt"])?(" \"title\"=\"".$this->settings["alt"]."\""):"";

     //echo($src."<br />");

     $filename=str_replace('\\', '/',DOCROOT).$src;

     //echo($filename."<br />");

     if(file_exists($filename))
     {
         // zprovozneni lightboxu
         if(isset($this->settings["lightbox"]) && $this->settings["lightbox"])
         {
             $src_detail=$src1."-".$this->settings["lightbox"].".".$ext;
             $src_detail="media/photos/".$this->settings["dir"]."images-".$data_orm->id."/".$src_detail;
             $image="<a class=\"lightbox-enabled img-responsive\" title=\"detail fotky\" href=\"".url::base().$src_detail."?rnadid=".rand(0, 1000)."\" rel=\"lightbox-group".$data_orm->id."\"><img src=\"".url::base().$src."\" $title $alt /></a>\n";
         }
         else
         {
            $image="<img src=\"".url::base().$src."?rnadid=".rand(0, 1000)."\" $title $alt/>\n";
         }

         if(isset($this->settings["delete_link"]) && $this->settings["delete_link"])
            //$delete_link=($this->settings["delete_link"]===true)?:$this->settings["delete_link"];
            $image.="<a href=\"?".$this->entity_name."_delete=".$data_orm->id."\" title=\"smazat obrázek\"><img src=\"".url::base()."media/admin/img/delete.png\" alt=\"smazat obrázek\" /></a>";
     }
     else
     {
         $image="-- obrázek nebyl vložen --";
     }

     return($image);

 }




 }


 ?>
