<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

 class AutoForm_Item_Summary extends AutoForm_Item
 {
     
 public function generate($data_orm, $template=false)
 {
     if(isset($this->parent_container->parent_container->summary_row[$this->entity_name]))
     {
        $result="&sum; ".$this->parent_container->parent_container->summary_row[$this->entity_name]; 
     }
     else
     {
         $result="";
     }
     
     return $result;
 }




 }


 ?>