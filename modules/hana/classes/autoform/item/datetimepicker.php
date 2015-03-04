<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Trida reprezentujici datetimepicker.
 * specificka nastaveni:
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Item_Datetimepicker extends AutoForm_Item_Text
{
    private $initial_value_enabled=true;

    public function pregenerate($data_orm) 
    {
        $data = parent::pregenerate($data_orm);

        // preformatuju na date
        try {
            $minutes=Input::post($this->entity_name."_minutes", 0);
            $hours=Input::post($this->entity_name."_hours", 0);
            $seconds=0;
            
            $date_parts=explode(".", $data);
            $data=$date_parts[2]."-".$date_parts[1]."-".$date_parts[0]." ".$hours.":".$minutes.":".$seconds;
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
            $value_date=date("j.n.Y");
            $value_hours=0;
            $value_minutes=0;
        }
        elseif(!$value)
        {
            $value_date="";
            $value_hours=0;
            $value_minutes=0;
        }
        else
        {
            if(Input::post($this->entity_name,false))
            {
                $value_date=Input::post($this->entity_name, 0);
                $value_minutes=Input::post($this->entity_name."_minutes", 0);
                $value_hours=Input::post($this->entity_name."_hours", 0);
            }
            else
            {
                $timestamp=strtotime($value);
                $value_date=date("j.n.Y", $timestamp);
                $value_hours=date("G", $timestamp);
                $value_minutes=date("i", $timestamp);
            }
        } 
        
        
        
        $result="<input class=\"datepicker mid form-control\" type=\"text\" name=\"".$name."\" ".($value_date?"value=\"$value_date\"":"").$this->settings["HTML"]."/>\n";
        $result.="<input class=\"short form-control\" maxlength=\"2\" type=\"text\" name=\"".$name."_hours\" value=\"".($value_hours?$value_hours:0)."\" /> h\n";
        $result.="<input class=\"short form-control\" maxlength=\"2\" type=\"text\" name=\"".$name."_minutes\" value=\"".($value_minutes?$value_minutes:0)."\" /> m\n";

        return $result;
     }

     
     public function set_initial_value_enabled($initial_value_enabled) {
         $this->initial_value_enabled = $initial_value_enabled;
         return $this;
     }


     


}

?>

