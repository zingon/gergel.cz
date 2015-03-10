<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Zobrazí odkaz na detail s vyfiltrovanymi polozkami (puvodne catDetailCol v Hane 1)
 * specificka nastaveni:
 * image - ikona, ktera se zobrazi pri neprazdne kategorii (obrazek ze slozky admin/img)
 * image_empty - ikona, ktera se zobrazi pri prazdne kategorii (obrazek ze slozky admin/img)
 * alt - popis odkazu
 * alt_empty - popis odkazu
 * data_src["db_query"] - sestaveni dotazu
 * data_src["db_query_where_colid"] - nazev sloupce s odkazem na id polozky
 * hrefid - odkaz na kontroler ke kteremu se automaticky pripoji id polozky
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Item_RelatedDetail extends AutoForm_Item
{
    public function pregenerate($data_orm)
    {
        // nasetovani zakladnich hodnot prvku
        $this->image=isset($this->settings["image"])?$this->settings["image"]:"folder_explore.png";
        $this->image_empty=isset($this->settings["image_empty"])?$this->settings["image_empty"]:$this->image;
        $this->alt=isset($this->settings["alt"])?$this->settings["alt"]:"detail";
        $this->alt_empty=isset($this->settings["alt_empty"])?$this->settings["alt_empty"]:$this->alt;
    }

    public function generate($data, $template=false) {
        $query=clone $this->data_src["db_query"];
        $query->where($this->data_src["db_query_where_colid"],"=",$data->id);
        $result=$query->execute()->current();
        $count=$result["count"];

        $href=$this->settings["hrefid"]."/".$data->id;


        $result_data="<div class=\"catdetailCol\"><a href=\"$href\" title=\"".($count?$this->alt:$this->alt_empty)."\"><img alt=\"".($count?$this->alt:$this->alt_empty)."\" src=\"".url::base()."media/admin/img/".($count?$this->image:$this->image_empty)."\" />(".$count.")</a></div>";
        return($result_data);
    }
}
?>
