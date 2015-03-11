<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Trida reprezentujici odkaz
 * specificka nastaveni:
 * HTML - HTML atributy prvku
 * href - pouze staticka url adresa
 * hrefid - url adresa s poslednim automatickym segmentem /id - pro admin
 * title - titulek odkazu
 * orm_tree_level_indicator - vlozi obrazek s odrazkou pred nazev kategorie podle urovne zanoreni
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Item_Link extends AutoForm_Item_Text
{
    
    public function generate($data_orm, $template=false)
    {
        $href="#";
        if(isset($this->settings["href"]))
        {
            $href=$this->settings["href"];
        }
        elseif(isset($this->settings["hrefid"]))
        {
            $href=$this->settings["hrefid"]."/".$data_orm->id;
        }
        
        if(isset($this->settings["target"]))
        {
            $this->settings["HTML"].=" target=\"".$this->settings["target"]."\"";
        }

        $data=parent::generate($data_orm, $template); // text odkazu se formatuje v rodicovske tride
        
        //$html=(isset($this->settings["HTML"]) && count($this->settings["HTML"]))?implode(" ", $this->settings["HTML"]):"";

        if(isset($this->settings["orm_tree_level_indicator"]) && $this->settings["orm_tree_level_indicator"] && $this->render_type!="export")
        {
            $result="<div class=\"tree_level_".$this->parent_container->tree_level."\"><a href=\"$href\"".$this->settings["HTML"].">".$data."</a></div>";
        }
        elseif(isset($this->settings["image"]) && $this->render_type!="export")
        {
            //
            $result="<a href=\"$href\"".$this->settings["HTML"]." title=\"$data\"><img alt=\"$data\" src=\"".url::base()."media/admin/img/".$this->settings["image"]["src"]."\" /></a>";
        }
        elseif($this->render_type!="export")
        {
            $result="<a href=\"$href\"".$this->settings["HTML"].">".$data."</a>";
        }
        else
        {
            $result=$data;
        }

        return $result;
    }




}

?>
