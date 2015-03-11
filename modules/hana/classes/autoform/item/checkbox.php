<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Trida reprezentujici zaskrtavaci policko (checkbox).
 * specificka nastaveni:
 * HTML - HTML atributy prvku 
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

 class AutoForm_Item_Checkbox extends AutoForm_Item
 {
     public function pregenerate($data_orm, $data_array = false)
     {
         $data = parent::pregenerate($data_orm, $data_array);
         return(empty($data)?0:$data);
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
        
        //$state = (($this->value!==false)? $this->value : (($data_orm->$name)?$data_orm->$name : false));
        $itn=$this->entity_name;
        if(isset($data_orm->id) && isset($data_orm->$itn)) $this->value=false;
        $state = parent::generate($data_orm);
        //if(!isset($data_orm->id)) $state=true; // implementuju defaultni zaskrtnuti

        $disabled="";
        $response="";
        if($this->disabled)
        {
            $disabled=" disabled=\"disabled\"";
            if($state) $response.="<input type=\"hidden\" name=\"".$this->entity_name."\" value=\"1\" /> \n";
        }

        $response.="<input type=\"checkbox\" value=\"1\" name=\"".$name."\" ".($state?"checked=\"checked\"":"").$this->settings["HTML"].$disabled."/>\n";
        return($response);
     }

//     public function pregenerate($data_orm) {
//         $data = parent::pregenerate($data_orm);
//
//
//     }


 }


 ?>