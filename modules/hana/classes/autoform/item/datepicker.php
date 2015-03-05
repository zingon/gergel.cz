<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Trida reprezentujici datepicker.
 * specificka nastaveni:
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Item_Datepicker extends AutoForm_Item_Text
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
        else
        {
            $value=date("j.n.Y", strtotime($value));
        } 
        
        $result="
        <div class=\"input-group\">
            <input class=\"datepicker form-control\" type=\"text\" name=\"".$name."\" ".($value?"value=\"$value\"":"").$this->settings["HTML"]."/>
            <span class=\"input-group-addon\"><span class=\"glyphicon glyphicon-calendar\"></span></span>
        </div>
        ";

        return $result;
     }

     
     public function set_initial_value_enabled($initial_value_enabled) {
         $this->initial_value_enabled = $initial_value_enabled;
         return $this;
     }


     


}

?>

