<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Objekt mikro-editu - slouzi pro editaci pripojenych souboru
 *
 * specificka nastaveni:
 * orm - nastavene ormko pripojenych fileetru (napr $product_orm->price_categories), v tomto ormku musi byt vyselektovan i sloupec s hodnotou v propojovaci tabulce
 * title - titulek tabulky
 * item - nazev sloupce s nazvem atributu (napr. "kod")
 * description - nazev sloupce s popisem tohoto atributu (napr. "popis")
 * value - nazev sloupce s hodnotou v propojovaci tabulce (napr "hodnota") - musi byt zvlast vyselektovana
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Item_microeditfile extends AutoForm_Item {
    private $show_form=false;

    public function pregenerate($data_orm) {

        $result_data=array();

        if(isset($_GET["microedit_file"]) && $_GET["microedit_file"]==$this->entity_name)
        {
            if(isset($_GET["microeditfile_edit_id"]))
            $this->show_form=true;

            if(isset($_GET["microeditfile_delete_id"]))
            {
                $result_data["hana_form_action"]="microedit_".$this->entity_name."_delete";
                $result_data["delete_file_id"] = $_GET["microeditfile_delete_id"];
            }
        }



        if(isset($_POST["microedit_action_add"]) && $_POST["microedit_action_add"]==$this->entity_name)
        {
            $result_data["hana_form_action"]="microedit_".$this->entity_name."_add";
            $result_data["file_id"] = $_POST["microedit_file_item_id"];
            $result_data["nazev"] = $_POST["microedit_file_nazev"];
            $result_data["cz"] = isset($_POST["microedit_file_cz"])?$_POST["microedit_file_cz"]:0;
            $result_data["en"] = isset($_POST["microedit_file_en"])?$_POST["microedit_file_en"]:0;
            

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
        $edit_id=(isset($_REQUEST["microeditfile_edit_id"]) && $_REQUEST["microeditfile_edit_id"])?$edit_id=$_REQUEST["microeditfile_edit_id"]:null;
        $edit_value="";


        $fileeters_order_by=$this->settings["files_order_by"];

//        // vylistuju vsechny dostupne soubory
//            $cfiles=orm::factory($property)->find_all();
//            $all_properties=array();
//            foreach($cfiles as $value){$all_properties[$value->id]=$value->$col;}
//            $all_properties_to_add=$all_properties;

        // vylistuju vsechny
        $orm_property=inflector::plural($property);
        $orm_properties=$orm->$orm_property->select($mnvalue)->language($orm->get_selected_language_id());
//        if(isset($this->settings["join"])) $orm_properties->join($this->settings["join"])->on($this->settings["on"][0],$this->settings["on"][1],$this->settings["on"][2]);
        $orm_properties=$orm_properties->find_all();
        $result_data="<div class=\"table-responsive\"></div><table border=\"0\" class=\"table table-bordered table-condensed\">";
        foreach($orm_properties as $item)
        {
            if(!$edit_id)
            {
                //unset($all_properties_to_add[$item->id]);
            }
            else
            {
                if($edit_id==$item->id) $edit_value=$item->$hodnota_vlastnosti;
            }
            if($item->nazev) $result_data.="<tr>
            <td class=\"padding-right-10\">Název souboru: <strong>".$item->nazev."</strong></td>
            <td class=\"padding-right-10\"><a href=\"?microedit_file=".$this->entity_name."&amp;microeditfile_edit_id=".$item->id."\">Editovat</a> </td>
            <td><a href=\"?microedit_file=".$this->entity_name."&amp;microeditfile_delete_id=".$item->id."\">Smazat</a></td>
            </tr>\n";
        }
        $result_data.="</table></div>\n<br />";
        $result_data.="<a href=\"?microedit_file=".$this->entity_name."&amp;microeditfile_edit_id=0\" class=\"btn btn-default btn-sm\">Přidat soubor</a>\n";

        // byl pozadavek na zobrazeni formulare pro pridani/editaci polozky
        if($this->show_form)
        {
            $result_data.="<div class='modal fade' id='ModalForm1' role='dialog' tabindex='-1'>\n";
            $result_data.="<div class='modal-dialog'>\n";
            $result_data.="<div class='modal-content'>\n";
            $result_data.="<div class='modal-header'>\n";
            $result_data.="<button type='button' class='close' data-dismiss='modal'>&times;</button>\n";
            $result_data.="<h4 class='modal-title'>Editace souboru</h4>\n";
            $result_data.="</div>\n";
            $result_data.="<div class='modal-body'>\n";

            $result_data.="<div class='form-group'>\n";
            $result_data.="<label class='control-label col-sm-2' for='nazev'>Název</label>\n";
            $result_data.="<div class='col-sm-10'>\n";
            $result_data.="<input type='text' class='form-control' id='nazev' value='$edit_value' name='microedit_file_nazev'>\n";
            $result_data.="</div>\n";
            $result_data.="</div>\n";

            $result_data.="<div class='form-group'>\n";
            $result_data.="<label class='control-label col-sm-2' for='zdroj'>Zdroj</label>\n";
            $result_data.="<div class='col-sm-10'>\n";
            $result_data.="<input type='file' class='form-control' id='zdroj'  name='microedit_file_src'>\n";
            $result_data.="</div>\n";
            $result_data.="</div>\n";

            $result_data.=" <input type=\"hidden\" name=\"microedit_file_item_id\" value=\"".$edit_id."\" />\n
                            <input type=\"hidden\" name=\"microedit_action_add\" value=\"".$this->entity_name."\" />\n";

            $result_data.="</div>\n";
            $result_data.="<div class='modal-footer'>\n";
            $result_data.="<button type='submit' class='btn btn-primary'>Uložit</button>\n";
            $result_data.="<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>\n";
            $result_data.="</div>\n";
            $result_data.="</div>\n";
            $result_data.="</div>\n";
            $result_data.="</div>\n";

            $result_data.="<script type=\"text/javascript\">
                           $(function() {

                            // premisteni modalniho formulare mimo hlavni formular - jinak se neodeslou data

                                // nasetovani modalniho formulare pridani zavady
                                var data=$(\"#modalDialog\").html();
                                $(\"#modalDialog\").remove();
                                $('#JqueryForm form').append(data);

                                $('#ModalForm1').modal();



                            });
                            </script>
                            ";
        }


        return $result_data;
    }
}
?>
