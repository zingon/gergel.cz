<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Trida reprezentujici editacni wysiwyg.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

 class AutoForm_Item_Editor extends AutoForm_Item
 {
     public function pregenerate($data_orm, $data_array=false)
     {
         $data=parent::pregenerate($data_orm, $data_array);
         // trimovani prazdnych tagu
         if(!(strip_tags($data))) return(null); else return($data);
     }

     public function generate($data_orm, $template=false)
     {

        $name = $this->entity_name;


        $value=parent::generate($data_orm);
        //$html=(isset($this->settings["HTML"]) && count($this->settings["HTML"]))?implode(" ", $this->settings["HTML"]):"";

        $content=form::textarea($name, $value, isset($this->settings["HTML_array"])?$this->settings["HTML_array"]:array());
        $content.="<script type=\"text/javascript\">\n";
        
        $content.="var editor = CKEDITOR.replace( '".$name."' );";
        
//        $content.="var oFCKeditor = new FCKeditor( '".$name."' ) ;\n";
//        $content.="oFCKeditor.BasePath = \"".url::base()."media/admin/js/fckeditor/\";";
//        $content.="oFCKeditor.Config[\"CustomConfigurationsPath\"] = \"".url::base()."media/admin/js/fckeditor/config/myconfig.js\"  ;\n";
//        $content.="oFCKeditor.ReplaceTextarea() ;\n";
//                    $content.="var oFCKeditor = new FCKeditor('FCKeditor1');\n";
//                    $content.="oFCKeditor.BasePath = \"".$this->resource_path."/js/fckeditor/\";\n";
//                    $content.="oFCKeditor.Create();\n";
        $content.="</script>\n";


        return($content."\n");
     }



 }


 ?>