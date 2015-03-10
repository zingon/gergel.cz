<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Trida reprezentujici editacni pole (edit).
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class AutoForm_Item_Number extends AutoForm_Item
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

        if(isset($this->settings["remove_first_segment"]) && $this->settings["remove_first_segment"]){
            $value_array=explode("/",$value);
            if(is_array($value_array) && count($value_array)>1){
                array_shift($value_array);
                $value=implode("/", $value_array);
            }
        }

        $value=(htmlspecialchars($value));

        $disabled="";
        $response="";
        if($this->disabled)
        {
            $disabled=" disabled=\"disabled\"";
            if($value) $response="<input type=\"hidden\" class=\"form-control\" name=\"".$this->entity_name."\" value=\"".$value."\" /> \n";
        }

        $response.=("<input type=\"number\" class=\"form-control\" name=\"".$name."\" ".($value?"value=\"$value\"":"").$this->settings["HTML"].$disabled."/>\n");

        if (!empty($this->popover))
        {
            $title = (array_key_exists("title", $this->popover)) ? "data-original-title=\"".$this->popover["title"]."\"" : "";
            $content = (array_key_exists("content", $this->popover)) ? "data-content=\"".$this->popover["content"]."\"" : "";
            $response = "
                <div class=\"input-group\"><span class=\"input-group-btn\">
                    <button class=\"btn btn-default\" type=\"button\" data-placement=\"auto\" data-container=\"#table-edit\" data-toggle=\"popover\" $title $content>
                        <span class=\"glyphicon glyphicon-info-sign\"></span>
                    </button>
                   </span> $response </div>";

        }
        return $response;
    }



}


?>