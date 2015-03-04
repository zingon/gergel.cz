<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Trida reprezentujici sipky pro realizaci razeni - pouziti v ListTable
 * zaroven obsluha a predzpracovani dat pri trideni tazenim mysi
 * specificka nastaveni:
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class AutoForm_Item_ChangeOrderShifts extends AutoForm_Item
{
    private $image_top="sort_asc2.gif";
    private $image_down="sort_desc2.gif";

    private $ranges;

    public function pregenerate($data_orm) {
        
        // zpracovani dat
        if(isset($_GET["hana_form_action"]))
        {
            if($_GET["hana_form_action"]=="change_order")
            {    
                return $_GET; // obycejne razeni neni nutne zvlastni osetreni dat
            }
            elseif($_GET["hana_form_action"]=="drag_change_order")
            {
                $result_array["hana_form_action"]="drag_change_order";
                $result_array["sequence"][0]=substr($_GET["reorder_item"], 6); // jednoduse odstrihnu kvuli rychlejsimu zpracovani
                foreach($_GET["ItemsList"] as $item){
                    if($item) array_push ($result_array["sequence"], substr($item, 6));
                }
//                print_r($result_array);
//                die();
                return($result_array);
            }
        }
        
        
    }

    public function generate($data_orm, $template=false)
    {
        
        // předinicializace - zjisteni rozsahu (v jednotlivych urovnich)
        if(empty($this->ranges))
        {
            if($this->parent_container->parent_container->web_type_code)
            {        
                $web_type_id=DB::select("id")->from("web_types")->where("code","=",$this->parent_container->parent_container->web_type_code)->as_object()->execute()->current()->id;
                
            }else{
                $web_type_id=0;
            }
            
            if($this->parent_container->tree_mode)
            {
                $result = DB::select('parent_id')->select(array(DB::expr('min(poradi)'),'range_min'))->select(array(DB::expr('max(poradi)'),'range_max'))->from(strtolower($data_orm->table_name()))->group_by('parent_id');
                if($web_type_id)
                {
                    $result->join(strtolower($data_orm->class_name)."_data")->on($data_orm->table_name().".id","=",strtolower($data_orm->class_name)."_data.".strtolower($data_orm->class_name)."_id")->join("routes")->on(strtolower($data_orm->class_name)."_data.route_id","=","routes.id")->where("routes.web_type_id","=",$web_type_id);
                }
                
                if(!empty($this->settings["restriction"]))
                {
                    $result->where($this->settings["restriction"]["name"],"=",$this->settings["restriction"]["value"]);
                }
                
                $result=$result->execute();
                
                foreach($result as $row)
                {
                    $this->ranges[$row["parent_id"]]["range_min"]=$row["range_min"];
                    $this->ranges[$row["parent_id"]]["range_max"]=$row["range_max"];
                }

            }
            else
            {
                $result = DB::select(array(DB::expr('min(poradi)'),'range_min'))->select(array(DB::expr('max(poradi)'),'range_max'))->from(strtolower($data_orm->table_name()));
                if($web_type_id)
                {
                    $result->join(strtolower($data_orm->class_name)."_data")->on($data_orm->table_name().".id","=",strtolower($data_orm->class_name)."_data.".strtolower($data_orm->class_name)."_id")->join("routes")->on(strtolower($data_orm->class_name)."_data.route_id","=","routes.id")->where("routes.web_type_id","=",$web_type_id);
                }
                
                if(!empty($this->settings["restriction"]))
                {
                    $result->where($this->settings["restriction"]["name"],"=",$this->settings["restriction"]["value"]);
                }
                
                $result=$result->execute()->current();
                $this->ranges[0]=$result;
            }
        }

        // zobrazeni tridicich sipek v zavislosti na pozici polozky (vcetne polozek ve stromove strukture)
        $parent_id_str=($this->parent_container->tree_mode)? "&amp;parent_id=".$data_orm->parent_id:"";
        $parent_id=($this->parent_container->tree_mode)? $data_orm->parent_id:0;
        $result_data="";

        if((strpos($this->parent_container->order_by, ".poradi") || $this->parent_container->order_by=="poradi") && isset($this->ranges[$parent_id]))
        {
            if($this->parent_container->order_direction=="asc")
            {
                if($data_orm->poradi > $this->ranges[$parent_id]["range_min"]) $result_data.="<a title=\"posunout výš\" href=\"?hana_form_action=change_order&amp;item_id=".$data_orm->id."&amp;direction=up".$parent_id_str."\" class=\"ajaxelement\"><img class=\"left\" alt=\"posunout výš\" src=\"".url::base()."media/admin/img/".$this->image_top."\" /></a>\n";
                if($data_orm->poradi < $this->ranges[$parent_id]["range_max"]) $result_data.="<a title=\"posunout níž\" href=\"?hana_form_action=change_order&amp;item_id=".$data_orm->id."&amp;direction=down".$parent_id_str."\" class=\"ajaxelement\"><img class=\"right\" alt=\"posunout níž\" src=\"".url::base()."media/admin/img/".$this->image_down."\" /></a>\n";
            }
            else
            {
                if($data_orm->poradi > $this->ranges[$parent_id]["range_min"]) $result_data.="<a title=\"posunout výš\" href=\"?hana_form_action=change_order&amp;item_id=".$data_orm->id."&amp;direction=up".$parent_id_str."\" class=\"ajaxelement\"><img class=\"left\" alt=\"posunout výš\" src=\"".url::base()."media/admin/img/".$this->image_down."\" /></a>\n";
                if($data_orm->poradi < $this->ranges[$parent_id]["range_max"]) $result_data.="<a title=\"posunout níž\" href=\"?hana_form_action=change_order&amp;item_id=".$data_orm->id."&amp;direction=down".$parent_id_str."\" class=\"ajaxelement\"><img class=\"right\" alt=\"posunout níž\" src=\"".url::base()."media/admin/img/".$this->image_top."\" /></a>\n";
            }
        }

        return $result_data;
    }

}
?>
