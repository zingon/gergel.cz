<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Trida reprezentujici textovy nadpis tabulky (s tridenim, nebo bez)
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

 class AutoForm_Item_TextThead extends AutoForm_Item
 {
     private $list_container;

     private $col_name;

     private $image_top="sort_asc.gif";
     private $image_down="sort_desc.gif";
     private $image_top_sel="sort_asc2.gif";
     private $image_down_sel="sort_desc2.gif";


     public function pregenerate($data_orm) {
         $this->list_container=$this->parent_container->parent_container;

         if(isset($_GET["orderby"]) && $_GET["orderby"]==$this->entity_name)
         {

             if(is_string($this->settings["sequencing"]))
             {
                 // manualni generovani ( ->sequencing([column_name]) )
                 $column_name=$this->settings["sequencing"];
             }elseif(is_array($this->settings["sequencing"]))
             {
                if(isset($this->settings["sequencing"]["col_name"])) $column_name=$this->settings["sequencing"]["col_name"]; 
             }
             else
             {
                 // automaticke generovani (nutno zjistit, zda jde o sloupec z jazykove tabulky)
                 if($this->entity_name=="poradi")
                 {
                     $prefix=$this->parent_container->parent_container->orm->table_name();
                 }
                 else 
                 {
                     $prefix=(method_exists($this->parent_container->parent_container->orm, "is_language_property") && $this->parent_container->parent_container->orm->is_language_property($this->entity_name))?($this->parent_container->parent_container->orm->get_language_table_name()):"";       
                     $prefix=(method_exists($this->parent_container->parent_container->orm, "is_route_property") && $this->parent_container->parent_container->orm->is_route_property($this->entity_name))?("routes"):$prefix;       
                 }
 
                 
                 
                 $column_name=$this->entity_name;
                 if($prefix) $column_name=$prefix.".".$column_name;
                 
             }
             $_SESSION[$this->list_container->module_key][$this->list_container->submodule_key][$this->list_container->subaction_key]["order"]=array("order_by"=>$this->entity_name,"orderby_col_name"=>$column_name,"order_direction"=>$_GET["order_direction"]);
         }

         // nastaveni vychoziho razeni
         if(!isset($_SESSION[$this->list_container->module_key][$this->list_container->submodule_key][$this->list_container->subaction_key]["order"]))
         {
             $_SESSION[$this->list_container->module_key][$this->list_container->submodule_key][$this->list_container->subaction_key]["order"]=array("order_by"=>$this->list_container->default_order_by,"orderby_col_name"=>$this->list_container->default_order_by,"order_direction"=>$this->list_container->default_order_direction);
         }

         parent::pregenerate($data_orm);

     }

     public function generate($data_orm, $template=false) {
        $result_data=array();
        $content="";

        $content .= parent::generate($data_orm, $template);
        
        if($this->render_type!="") return(array("content"=>$content)); // generovani polozky pri exportu/tisku

        if($this->settings["sequencing"])
        {
            if(isset($_SESSION[$this->list_container->module_key][$this->list_container->submodule_key][$this->list_container->subaction_key]["order"]) && $_SESSION[$this->list_container->module_key][$this->list_container->submodule_key][$this->list_container->subaction_key]["order"]["order_by"]==$this->entity_name)
            {
                $order_array=$_SESSION[$this->list_container->module_key][$this->list_container->submodule_key][$this->list_container->subaction_key]["order"];

                if($order_array["order_direction"]=="asc")
                {
                    $this->image_top=$this->image_top_sel;
                }
                else
                {
                    $this->image_down=$this->image_down_sel;
                }
            }

            $content.="&nbsp;<a class=\"ajaxelement\" title=\"řadit vzestupně\" href=\"?orderby=".$this->entity_name."&amp;order_direction=asc\"><img alt=\"řadit vzestupně\" src=\"".url::base()."media/admin/img/".$this->image_top."\" /></a>";
            $content.="<a class=\"ajaxelement\" title=\"řadit sestupně\" href=\"?orderby=".$this->entity_name."&amp;order_direction=desc\"><img alt=\"řadit sestupně\" src=\"".url::base()."media/admin/img/".$this->image_down."\" /></a>";
        }

        $result_data["html"]=$this->settings["HTML"];
        
        $result_data["content"] = $content;
        return($result_data);
     }



 }


 ?>