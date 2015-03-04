<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Trida reprezentujici indikator (2-n definovatelnych stavu)
 * specificka nastaveni:
 * states => array(0=>array("image"=>"lightbulb_off","label"=>"neaktivní")
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class AutoForm_Item_Indicator extends AutoForm_Item
{
    public function pregenerate($data_orm)
    {
        if(isset($_GET[$this->entity_name]))
        {
            $result_data["id"]=$_GET["id"];
            $result_data["state_property"]=$this->entity_name;
            $result_data["state_value"]=$_GET[$this->entity_name];
            return $result_data;
        }
        else
        {
            return array();
        }
    }

    public function generate($data_orm, $template=false)
    {
        $current_state=parent::generate($data_orm, $template);
        if(!$current_state) $current_state=0;
        $next_state=(isset($this->settings["states"][$current_state+1]))?$current_state+1:0;
        
        $keys=(array_keys($this->settings["states"]));
        //die("-".max($keys));
        if($current_state>max($keys))$current_state=max($keys);
        
        $current_image=$this->settings["states"][$current_state]["image"];
        $current_title=$this->settings["states"][$current_state]["label"];
        
        if($this->render_type=="")
        {       
            $result_data="<img title=\"$current_title\" alt=\"$current_title\" src=\"".url::base()."media/admin/img/".$current_image."\" />";
        }
        else
        {
            $result_data=$current_title;
        }

        return($result_data);
    }

}