<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Trida reprezentujici editacni pole (edit).
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class AutoForm_Item_Colorpicker extends AutoForm_Item
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

        $response.=("<input type=\"text\" class=\"form-control b-colorpicker\" name=\"".$name."\" ".($value?"value=\"$value\"":"").$this->settings["HTML"].$disabled."/>\n");
        $response.=('
        <script type="text/javascript">
            $(document).ready(function () {
                $(".b-colorpicker").colorpicker();
            });
        </script>
        ');
        return $response;
    }



}


?>