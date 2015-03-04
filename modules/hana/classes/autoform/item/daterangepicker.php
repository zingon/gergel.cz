<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Trida reprezentujici daterangepicker.
 * specificka nastaveni:
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class AutoForm_Item_Daterangepicker extends AutoForm_Item_Text
{
    private $initial_value_enabled=true;

    public function pregenerate($data_orm) 
    {
        $data = parent::pregenerate($data_orm);

        // preformatuju na date
        try {
            $date_parts=explode(".", $data);
            $data=$date_parts[2]."-".$date_parts[1]."-".$date_parts[0];
        } catch (Exception $e) {
            $data="";
        }
        return $data;
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
        if($this->initial_value_enabled && !$value)
        {        
            $value=date("j.n.Y");
        }
        elseif(!$value)
        {
            $value="";
        }
//        else
//        {
//            $value=date("j.n.Y", strtotime($value));
//        }   
        
        $class_name=str_replace(array("[","]"), "_", $this->entity_name);
        $result="<input class=\"daterangepicker_".$class_name." daterangepicker form-control\" type=\"text\" name=\"".$name."\" ".($value?"value=\"$value\"":"").$this->settings["HTML"]."/>\n";
        $result.="
        <script type=\"text/javascript\">    
            $(document).ready(function() {
                $('.daterangepicker_".$class_name."').daterangepicker();
            }); 
        </script>
        ";

        return $result;
     }

     
     public function set_initial_value_enabled($initial_value_enabled) {
         $this->initial_value_enabled = $initial_value_enabled;
         return $this;
     }


     


}

?>

