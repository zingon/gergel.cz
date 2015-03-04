<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Trida reprezentujici textareu pole (edit).
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

 class AutoForm_Item_Textarea extends AutoForm_Item
 {
     public function pregenerate($data_orm, $data_array = false) {
         $data=parent::pregenerate($data_orm, $data_array);
         if(isset($this->settings["nl2br"]))
         {
            return nl2br($data);
         }
         else
         {
             return $data;
         }
     }
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
        $value=parent::generate($data_orm);

        // pokud je vygenerovana hodnota pole - vezmeme prvni prvek
        if(is_array($value)) $value=current($value);
        if(isset($this->settings["nl2br"]))
        {
            $value=preg_replace('`<br(?: /)?>([\\n\\r])`', '$1', $value); // inverzni nl2br 
        }
        return("<textarea class=\"form-control\" name=\"".$name."\" ".$this->settings["HTML"]." rows=\"5\"/>".$value."</textarea>\n");
     }



 }


 ?>