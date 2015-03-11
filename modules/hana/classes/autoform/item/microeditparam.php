<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Objekt mikro-editu - slouzi pro editaci propojenych parametru M:N (cen produktu, parametru produktu) pripojenych relaci M:N
 *
 * specificka nastaveni:
 * orm - nastavene ormko pripojenych parametru (napr $product_orm->price_categories), v tomto ormku musi byt vyselektovan i sloupec s hodnotou v propojovaci tabulce
 * title - titulek tabulky
 * item - nazev sloupce s nazvem atributu (napr. "kod")
 * description - nazev sloupce s popisem tohoto atributu (napr. "popis")
 * value - nazev sloupce s hodnotou v propojovaci tabulce (napr "hodnota") - musi byt zvlast vyselektovana
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Item_MicroeditParam extends AutoForm_Item {
    private $show_form=false;

    public function pregenerate($data_orm) {

        $result_data=array();

        if(isset($_GET["microedit_param"]) && $_GET["microedit_param"]==$this->entity_name)
        {
            if(isset($_GET["microeditparam_edit_id"]))
            $this->show_form=true;

            if(isset($_GET["microeditparam_delete_id"]))
            {
                $result_data["hana_form_action"]="microedit_".$this->entity_name."_delete";
                $result_data["microedit_param_delete_id"] = $_GET["microeditparam_delete_id"];
            }
        }



        if(isset($_POST["microedit_action_add"]) && $_POST["microedit_action_add"]==$this->entity_name)
        {
            $result_data["hana_form_action"]="microedit_".$this->entity_name."_add";
            $result_data["microedit_param_item_id"] = $_POST["microedit_param_item_id"];
            $result_data["microedit_param_value"] = $_POST["microedit_param_value"];
            $result_data["microedit_param_edit_id"] = $_POST["microedit_param_edit_id"];


        }

        return $result_data;
    }

    public function generate($data, $template=false) {
        //parent::generate($data, $template);
        // hodnoty z nastaveni
        $property=$this->entity_name;
        $orm=$this->settings["orm"];
        $col=$this->settings["item"];
        $mnvalue=$this->settings["value"];
        $nazev_vlastnosti=$this->settings["item"];
        $popis_vlastnosti=isset($this->settings["description"])?$this->settings["description"]:false;
        $hodnota_vlastnosti=$this->settings["value"][1];

        // hodnoty z formulare
        $edit_id=(isset($_REQUEST["microeditparam_edit_id"]) && $_REQUEST["microeditparam_edit_id"])?$edit_id=$_REQUEST["microeditparam_edit_id"]:null;
        $edit_value="";


        $parameters_order_by=$this->settings["parameters_order_by"];

        // vylistuju vsechny dostupne parametry
            $cparameters=orm::factory($property)->find_all();
            $all_properties=array();
            foreach($cparameters as $value){$all_properties[$value->id]=$value->$col;}
            $all_properties_to_add=$all_properties;

        // vylistuju pripojene parametry
        $orm_property=inflector::plural($property);
        $orm_properties=$orm->$orm_property->select($mnvalue);
        if(isset($this->settings["join"])) $orm_properties->join($this->settings["join"])->on($this->settings["on"][0],$this->settings["on"][1],$this->settings["on"][2]);
        $orm_properties=$orm_properties->find_all();
        $result_data="<table border=\"0\">";
        foreach($orm_properties as $item)
        {
            if(!$edit_id)
            {
                unset($all_properties_to_add[$item->id]);
            }
            else
            {
                if($edit_id==$item->id) $edit_value=$item->$hodnota_vlastnosti;
            }
            $result_data.="<tr><td>".$item->$nazev_vlastnosti.(($popis_vlastnosti)?" (".$item->$popis_vlastnosti.")":"").":</td><td>".$item->$hodnota_vlastnosti."</td><td><a href=\"?microedit_param=".$this->entity_name."&amp;microeditparam_edit_id=".$item->id."\">Editovat</a> </td><td><a href=\"?microedit_param=".$this->entity_name."&amp;microeditparam_delete_id=".$item->id."\">Smazat</a></td></tr>\n";
        }
        $result_data.="</table>\n<br />";
        $result_data.="<a href=\"?microedit_param=".$this->entity_name."&amp;microeditparam_edit_id=0\">Přidat hodnotu</a>\n";

        // byl pozadavek na zobrazeni formulare pro pridani/editaci polozky
        if($this->show_form)
        {

            $result_data.="<div id=\"ModalForm1Container\"><div id=\"ModalForm1\" title=\"Editace parametru\">\n";
            $result_data.="
                            <label for=\"editParameterID\">Název</label> &nbsp; ".form::select('microedit_param_item_id',$all_properties_to_add,$edit_id)." &nbsp; <br /><br />
                            <label for=\"editParameterValue\">Hodnota</label> &nbsp; 
                            <input type=\"text\" value=\"".$edit_value."\" name=\"microedit_param_value\" />
                            <input type=\"hidden\" name=\"microedit_param_edit_id\" value=\"".$edit_id."\" />
                            <input type=\"hidden\" name=\"microedit_action_add\" value=\"".$this->entity_name."\" />
                            ";
            $result_data.="</div><div>\n";
            $result_data.="<script type=\"text/javascript\">
                           $(function() {

                            // premisteni modalniho formulare mimo hlavni formular - jinak se neodeslou data
                            var data=$(\"#ModalForm1\").html();
                            $('#JqueryForm form').append(data);

                            $(\"#ModalForm1Container\").remove();
                            // nasetovani modalniho formulare pridani zavady
                            $(\"#JqueryForm\").dialog({
                                    autoOpen: true,
                                    bgiframe: true,
                                    height: 200,
                                    width: 350,
                                    modal: true,
                                    resizable: false,
                                    open: function(event, ui) {},
                                    //close: function(event, ui) {\$(\"#ModalForm1 form .error\").html(\"\"); \$(\"#ModalForm1 .date\").datepicker(\"hide\"); \$(\"#ModalForm1 .date\").datepicker(\"destroy\");},
                                    buttons: {
                                            'Uložit': function() {
                                                     // odeslani formulare
                                                       //$(this).dialog('close');
                                                        
                                                       // odeslani dialogu
                                                        $('#JqueryForm form').submit();
                                                       
                                                       // smazani dat z dialogu
                                                       // $(\"#ModalForm1 form .delAfterSend\").val(\"\");
                                            },
                                            Zrušit: function() {
                                                    $(this).dialog('close');
                                            }
                                    }
                            });

                            });
                            </script>
                            ";
        }


        return $result_data;
    }
}
?>
