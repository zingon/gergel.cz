<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Trida reprezentujici TRISTAVOVE zaskrtavaci policko (checkbox). 
 * specificka nastaveni:
 * HTML - HTML atributy prvku 
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

 class AutoForm_Item_Checkbox3 extends AutoForm_Item
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
        
        //$state = (($this->value!==false)? $this->value : (($data_orm->$name)?$data_orm->$name : false));
        $itn=$this->entity_name;
        if(isset($data_orm->id) && isset($data_orm->$itn)) $this->value=false;
        $state = parent::generate($data_orm);
        //$state=isset($_POST[$name])?$_POST[$name]:0;
        //if(!isset($data_orm->id)) $state=true; // implementuju defaultni zaskrtnuti

        $disabled="";
        $response="";
        if($this->disabled)
        {
            $disabled=" disabled=\"disabled\"";
            if($state) $response.="<input type=\"hidden\" name=\"".$this->entity_name."\" value=\"1\" /> \n";
        }
        
        $class_name=str_replace(array("[","]"), "_", $this->entity_name);        
        $response.="<input type=\"checkbox\" class=\"tristatecheckbox_".$class_name."\" value=\"1\" name=\"".$name."\" ".($state?"checked=\"checked\"":"").$this->settings["HTML"].$disabled."/>\n";

        $response.="
        <script type=\"text/javascript\">    
            $('.tristatecheckbox_".$class_name."').tristateCheckbox({'default_state':".((int)$state)."});        
        </script>
        ";
        
        return($response);
     }

//     public function pregenerate($data_orm) {
//         $data = parent::pregenerate($data_orm);
//
//
//     }


 }


 ?>