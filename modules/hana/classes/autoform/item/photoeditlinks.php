<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Trida reprezentujici odkazy na pridani fotky a fotky ze zipu v galerii (Photoedit)
 * 
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class AutoForm_Item_Photoeditlinks extends AutoForm_Item
{
    
    public function generate($data_orm, $template=false)
    {
        
        $href=$this->settings["href"];

        $result="<div class='btn-group hidden-xs'>\n";
        $result.="<a href=\"".$href."_editphoto=0\" class=\"btn btn-primary ajaxelement\">přidat/editovat fotografii</a> ";
        $result.="<a href=\"".$href."_addmultiple=true\" class=\"btn btn-primary ajaxelement\">hromadné přidání fotografií</a> ";
        $result.="<a href=\"".$href."_addzip=true\" class=\"btn btn-primary ajaxelement\">přidání fotografií ze zipu</a> \n";
        $result.="</div>";
        $result.="<div class='btn-group-vertical visible-xs'>\n";
        $result.="<a href=\"".$href."_editphoto=0\" class=\"btn btn-primary ajaxelement\">přidat/editovat fotografii</a> ";
        $result.="<a href=\"".$href."_addmultiple=true\" class=\"btn btn-primary ajaxelement\">hromadné přidání fotografií</a> ";
        $result.="<a href=\"".$href."_addzip=true\" class=\"btn btn-primary ajaxelement\">přidání fotografií ze zipu</a> \n";
        $result.="</div>";


        return $result;
    }




}

?>
