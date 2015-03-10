<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Trida reprezentujici odkaz na dostupne jazyky
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Item_Languages extends AutoForm_Item_Text
{
    public function __construct($name) {
        parent::__construct($name);

        $this->languages=Kohana::config("languages")->get("mapping");
    }

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

        $data=parent::generate($data_orm, $template); // text odkazu se formatuje v rodicovske tride
        //$html=(isset($this->settings["HTML"]) && count($this->settings["HTML"]))?implode(" ", $this->settings["HTML"]):"";
        $result="";
        foreach($this->languages as $lang_id=>$lang_code)
        {
            if($lang_code=="cz") $lnk=""; else $lnk="?admlang=".$lang_id;
            if($data & $lang_id)
            {
                if($this->render_type=="export"){
                    $result.=$lang_code.", ";
                }else{
                    $result.="<a class=\"green\" title=\"jazyková byla vyplňována\" href=\"$href$lnk\"".$this->settings["HTML"].">".$lang_code."</a> \n";
                }
            }
            elseif($this->render_type=="")
            {
                $result.="<a class=\"red\" title=\"jazyková verze nebyla vyplňována\" href=\"$href$lnk\"".$this->settings["HTML"].">".$lang_code."</a> \n";
            }
        }

        return $result;
    }




}

?>
