<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Trida reprezentujici tlacitko pro vyber souboru (edit).
 * naprosto staticky prvek, nevyplnuje se daty ani je nezpracovava
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

 class AutoForm_Item_Filebrowser extends AutoForm_Item
 {
     

     public function generate($data_orm, $template=false)
     {
        if($this->parent_container instanceof AutoForm_MultipleContainer)
        {
            $name = $this->entity_name."[".$data_orm->id."]";
        }
        else
        {
            $name = $this->entity_name;
        }

        //$value = (($this->value!==false)? $this->value : (($data_orm->$name)?$data_orm->$name : false));
        if($this->disabled) return "";
        return("<input type=\"file\" class=\"form-control\" name=\"".$name."\" ".$this->settings["HTML"]." />\n");
     }

 }


 ?>
