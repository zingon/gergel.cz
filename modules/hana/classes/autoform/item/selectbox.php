<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Trida reprezentujici selectbox.
 * specificka nastaveni:
 * HTML - HTML atributy prvku
 * multiple - pokud je true (hodnota) zobrazi multiple selectbox
 * null_row - prvni nulovy radek v selectboxu (nepovinne)
 *
 * $this->auto_edit_table->row("product_parameters_type_id")->type("selectbox")->label("Typ vlastnosti")->data_src(array("related_table_1"=>"product_parameters_type","column_name"=>"nazev","orm_tree"=>false,"order_by"=>array("nazev","asc"),"null_row"=>"-- není stanoven --"))->set();

 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

 class AutoForm_Item_Selectbox extends AutoForm_Item
 {

     public function generate($data_source, $template=false)
     {
        if($this->parent_container instanceof AutoForm_MultipleContainer)
        {
            $name = $this->entity_name."[".$data_source->id."]";
        }
        elseif(isset($this->data_src["multiple"]) && $this->data_src["multiple"])
        {
            $name = $this->entity_name."[]";
        }
        else
        {
            $name = $this->entity_name;
        }

        $key_col="id"; // nazev klicoveho sloupce

        // uprava zpusobu generovani - nejprve automaticky vygeneruju vsechny polozky v selectboxu
        if(!isset($this->data_src["data_array"]))
        {
            // automaticke naplneni selectboxu daty
            // $this->data_src["condition"], $this->data_src["orm_tree"]
            if(isset($this->data_src["related_table_2"]))
            {
                // pripad $orm->related_1->related_2->column
                $object1=$this->data_src["related_table_1"];
                $object2=$this->data_src["related_table_2"];
                $on=$this->data_orm->$object1->$object2;
                $data=orm::factory($on->object_name());
            }
            elseif(isset($this->data_src["related_table_1"]))
            {
                // pripad $orm->related_1->column
                $object1=$this->data_src["related_table_1"];
                $data=orm::factory($this->data_orm->$object1->object_name()); 
            }
            else
            {
                //neni pripojena zadna tabulka jde o vylistovani sama sebe
                $data=$this->data_orm;
                if(isset($this->data_src["orm_tree"]) && $this->data_src["orm_tree"]) 
                    $key_col="parent_id";
              
            }

            if(isset($this->data_src["condition"])) $data->where($this->data_src["condition"][0],$this->data_src["condition"][1],$this->data_src["condition"][2]);
            if(isset($this->data_src["condition2"])) $data->where($this->data_src["condition2"][0],$this->data_src["condition2"][1],$this->data_src["condition2"][2]);
            // nastaveni na defaultni jazyk
            if(isset($this->data_src["language"]) && $this->data_src["language"]) $data->language(1);//$data->where("language_id","=",1); // vzdy budu zobrazovat vychozi jazykovou verzi

            if(isset($this->data_src["order_by"])) $data->order_by($this->data_src["order_by"][0],$this->data_src["order_by"][1]);
            if(isset($this->data_src["orm_tree"]) && $this->data_src["orm_tree"]) $data->where("parent_id","=",0);
            $data = $data->find_all();
            $options=array();
            if(isset($this->data_src["null_row"])) $options[0]=$this->data_src["null_row"]; // nulovy radek

            $column=isset($this->data_src["column_name"])?$this->data_src["column_name"]:"nazev"; // nazev sloupce
//print_r($data);
            
            $options=$options+$this->_generate_options($data, 1);

            //print_r($options);

        }
        else
        {
            // manualni naplneni selectboxu daty
            $options=$this->data_src["data_array"];
            $key_col=$this->entity_name;
        }
        
        
        // ziskam id zvolene polozky
        $colname=isset($this->data_src["column_name"])?$this->data_src["column_name"]:$this->entity_name;
        if(is_array($data_source)) $this->data_src["column_name"]=$this->entity_name; else $this->data_src["column_name"]=$key_col;
        $selected = parent::generate($data_source);

        $this->data_src["column_name"]=$colname;

        $html=isset($this->settings["HTML_array"])?$this->settings["HTML_array"]:array();//(isset($this->settings["HTML"]) && count($this->settings["HTML"]))?implode(" ", $this->settings["HTML"]):"";
        $response="";
        if($this->disabled){
            $html["disabled"]="disabled";

            if(is_array($selected))
            {
                foreach($selected as $selitem)
                {
                    $response.="<input type=\"hidden\" class\"form-control\" name=\"".$this->entity_name."[]\" value=\"".$selitem."\" /> \n";
                }
            }
            else
            {
                $response="<input type=\"hidden\" class\"form-control\" name=\"".$this->entity_name."\" value=\"".$selected."\" /> \n";
            }
        }
        $html = array_merge($html, array("class"=>"form-control"));
        $response.=form::select($name, $options, $selected, $html);

        return $response;
     }

     /**
      * Privatni funkce na vlastni generovani obsahu selectboxu. Automaticky generuje orm tree v zavislostni na volbe data_src[orm_tree]
      * @param <type> $data
      * @param <type> $tree_level
      */
     private function _generate_options($data, $tree_level=1)
     {
        $column=isset($this->data_src["column_name"])?$this->data_src["column_name"]:"nazev";
        
        $options=array();

        foreach($data as $item)
        {
           $options[$item->id]=(str_repeat("&nbsp;&nbsp;", $tree_level-1).$item->$column);
           if(isset($this->data_src["orm_tree"]) && $this->data_src["orm_tree"] && ((isset($this->settings["max_tree_level"]) && $tree_level+1 < $this->settings["max_tree_level"]) || !isset($this->settings["max_tree_level"])))
           {
               
                $children=orm::factory($item->class_name);
                if(isset($this->data_src["language"]) && $this->data_src["language"]) $children->where("language_id","=",1); // vzdy budu zobrazovat vychozi jazykovou verzi
                if(isset($this->data_src["condition"])) $children->where($this->data_src["condition"][0],$this->data_src["condition"][1],$this->data_src["condition"][2]);
                if(isset($this->data_src["order_by"])) $children->order_by($this->data_src["order_by"][0],$this->data_src["order_by"][1]);
                $children = $children->where("parent_id","=",$item->id)->find_all();

                $children_options=$this->_generate_options($children, $tree_level+1);
                $options=$options+$children_options;
           }
        }
        return $options;
     }
 }
 ?>