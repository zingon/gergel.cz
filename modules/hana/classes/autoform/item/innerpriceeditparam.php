<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Objekt vlozeneho editu pro editaci pripojenych cen - specialni funkcionalita pro edit.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Item_InnerPriceEditParam extends AutoForm_Item
{
    private $product_orm;

    public function pregenerate($data_orm)
    {
        $this->product_orm=$data_orm;
        return array("price_category"=>parent::pregenerate($data_orm));
    }
//    public function pregenerate($data_orm) {
//
//        $result_data=array();
//
//        if(isset($_GET["microedit_param"]) && $_GET["microedit_param"]==$this->entity_name)
//        {
//            if(isset($_GET["microeditparam_edit_id"]))
//
//
//            if(isset($_GET["microeditparam_delete_id"]))
//            {
//                $result_data["hana_form_action"]="microedit_".$this->entity_name."_delete";
//                $result_data["microedit_param_delete_id"] = $_GET["microeditparam_delete_id"];
//            }
//        }
//
//
//
//        if(isset($_POST["microedit_action_add"]) && $_POST["microedit_action_add"]==$this->entity_name)
//        {
//            $result_data["hana_form_action"]="microedit_".$this->entity_name."_add";
//            $result_data["microedit_param_item_id"] = $_POST["microedit_param_item_id"];
//            $result_data["microedit_param_value"] = $_POST["microedit_param_value"];
//            $result_data["microedit_param_edit_id"] = $_POST["microedit_param_edit_id"];
//
//
//        }
//
//        return $result_data;
//    }

    public function generate($data, $template=false) {
        $result_data="";
        $price_categories=orm::factory("price_category")->find_all();

        $result_data="<table border=\"0\">";
        foreach ($price_categories as $pcategory)
        {
            $result_data.="<tr><td>$pcategory->kod</td><td>".($pcategory->popis?"($pcategory->popis)":"")."</td>";

            if($pcategory->price_type->kod=="sleva_procentem")
            {
                $cena_procentem=$this->product_orm->prices($pcategory->kod)->get_raw_price_value();
                if($cena_procentem!==false)
                {
                    $result_data.="<td>".$cena_procentem." ".$pcategory->price_type->kratky_popis."</td>";
                    if($this->product_orm->prices($pcategory->kod)->get_raw_price_with_tax())
                    {
                        $result_data.="<td>(".$this->product_orm->prices($pcategory->kod)->get_raw_price_with_tax()." s DPH)</td>\n";
//                        $priceholder2=new Model_Product_Priceholder($this->product_orm,$pcategory->kod);
//                        echo($priceholder2->get_raw_price_with_tax());
                    }
                    else
                    {
                        $result_data.="<td>Základní cena D0 nebyla vyplněna, nebo je nulová.</td>";
                    }
                }
                else
                {
                    $result_data.="<td>Základní cena D0 nebyla vyplněna, nebo je nulová.</td>";
                    $result_data.="<td>&nbsp;</td>\n";
                }
            }
            else
            {
                $priceobj=$this->product_orm->prices($pcategory->kod);
                if(is_object($priceobj))
                {
                    $cena=$priceobj->get_raw_price_value();
                }
                else
                {
                    $cena="";
                }
                        
                $result_data.="<td><input type=\"text\" name=\"price_category[$pcategory->id]\" class=\"shortInput\" value=\"$cena\"> ".$pcategory->price_type->kratky_popis."</td>";
                $result_data.="<td>&nbsp;</td>\n";
            }
            
            $result_data.="</tr>\n";

        }
        $result_data.="</table>\n<br />";

        return $result_data;
    }
}
?>
