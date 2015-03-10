<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Trida reprezentujici editacni pole (edit).
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

 class AutoForm_Item_Password extends AutoForm_Item
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
        $value=parent::generate($data_orm);

        // pokud je vygenerovana hodnota pole - vezmeme prvni prvek
        if(is_array($value)) $value=current($value);

        $disabled="";
        $response="";

         $response.=("<input type=\"password\" class=\"form-control\" name=\"".$name."\" ".$this->settings["HTML"].$disabled."/>\n");
         return $response;
     }



 }


 ?>
