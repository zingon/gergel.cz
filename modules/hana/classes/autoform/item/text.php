<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Trida reprezentujici textovy popis, ktery muze byt automaticky naplnen z DB (podle zadaneho nazvu), nebo rucne (pri zadani hodnoty data_raw)
 * specificka nastaveni:
 * maxlenght - maximalni pocet zobrazenych znaku
 * with_hidden - doplni vystup o skryty formularovy prvek "hidden" s nazvem entity a jeji hodnotou
 * special_format - specialni formatovani dat
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

 class AutoForm_Item_Text extends AutoForm_Item
 {
 public function generate($data_orm, $template=false)
 {
     $result = parent::generate($data_orm, $template);
     if(is_array($result))
     {
         $result=implode("<br />", $result);
     }
     else
     {
        $result=strip_tags($result); // ve vypisech nebudou zadne HTML tagy
     }
     
     //die(print_r($this->parent_container->parent_container->summary_row));
     if(isset($this->parent_container->parent_container->summary_row[$this->entity_name])) $this->parent_container->parent_container->summary_row[$this->entity_name]+=$result;
     
     // omezeni poctu znaku (mimo export)
     if(isset($this->settings["maxlenght"]) && $this->render_type=="")
     {
         $delimiter=(strlen($result)>$this->settings["maxlenght"])?"...":"";
         //$result = preg_replace('/\s+?(\S+)?$/u', '', mb_substr($result, 0, $this->settings["maxlenght"], 'UTF-8')).$delimiter;
         $result = mb_substr($result, 0, $this->settings["maxlenght"], 'UTF-8').$delimiter;
         //$result = mb_substr($result, 0, $this->settings["maxlenght"]).$delimiter;
     }

     if(isset($this->settings["special_format"]))
     {
         // specificke formatovani vystupu
         switch ($this->settings["special_format"]) {
             case "cz_date":
                 $result=($result)?date("d.m.Y", strtotime($result)):"";
                 break;

             case "cz_datetime":
                 $result=($result)?date("d.m.Y H:i:s", strtotime($result)):"";
                 break;
             
             case "cz_datetime_ns":
                 $result=($result)?date("d.m.Y (H:i)", strtotime($result)):"";
                 break;

             case "cz_date_timestamp":
                 $result=($result)?date("j.n.Y", $result):"";
                 break;

             case "cz_datetime_timestamp":
                 $result=($result)?date("j.n.Y H:i:s", $result):"";
                 break;

             case "currency":
                 $result=($result)?number_format($result, 2, ',', ' '):"";
                 break;

             // obsah bude tvořit obrázek
             case "image":


                 break;

             default:
                 break;
         }

     }

     // pokud explicitne stanovim with_hidden
     if(isset($this->settings["with_hidden"]))
     {
         $result.="\n <input type=\"hidden\" name=\"".$this->entity_name."\" value=\"".$result."\" />\n";
     }

     return $result;
 }




 }


 ?>