<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * Pomocny kontejner pro generovani filtrovaciho radku v tabulce a spravu filtrovani.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Helper_FilterContainer extends AutoForm_Container
{
    private $like_col_setting=array();
    private $where_col_setting=array();

    private $where_rules;
    private $like_rules;

    private $counter=1;

    
    // vlozi filtrovaci sloupec
    public function add_filter($item, $data_src=false, $settings=false)
    {     
        if($item===false)
        {
            $this->add(AutoForm_Item::factory("text", "label_".$this->counter)->value("&nbsp;")); 
        }
        else
        {
            //die(print_r($item));
            //$it_name=isset($data_src["column_name"])?$data_src["column_name"]:$item->entity_name;
            if(isset($settings["col_name"]))
            {
                $it_name=$settings["col_name"];
            }
            elseif(isset($data_src["related_table_2"]))
            {
                $it_name=(Inflector::plural($data_src["related_table_2"]).".id"); // defaultne se bere idcko
            }
            elseif(isset($data_src["related_table_1"]))
            {
                $it_name=(Inflector::plural($data_src["related_table_1"]).".id"); // defaultne se bere idcko         
            }elseif(isset($data_src["column_name"]))
            {
                $it_name=$data_src["col_name"];
            }
            else
            {
                $it_name=$item->entity_name;
            }
                        
            if(empty($settings["type"]))
            {
                // automaticke generovani vystupu na zaklade typu filtrovanych dat

                if(($item instanceof AutoForm_Item_Switch || $item instanceof AutoForm_Item_Indicator) && count($item->settings["states"])==2)
                {
                    // dvojstavovy prepinac
                    //$this->add(AutoForm_Item::factory("checkbox", "hana_filter[".$item->entity_name."]"));
                    //$this->where_col_setting[$item->entity_name]=array("name"=>$it_name,"operator"=>"=");
                    $this->add(AutoForm_Item::factory("checkbox3", "hana_filter[".$item->entity_name."]"));
                    $this->where_col_setting[$item->entity_name]=array("name"=>$it_name,"operator"=>"=","decoration"=>"tricheckbox_value");
                }
                elseif($item instanceof AutoForm_Item_Switch)
                {
                    // vicestavovy prepinac - TODO
                }
                else
                {   
                    // input pole (nebo jiny prvek), nebo selectbox (pokud jde o relaci 1:N)
                    if(isset($data_src["related_table_2"]) || isset($data_src["related_table_1"]))
                    {
                        // selectbox
                        $data_src["null_row"]="---";
                        $data_src["multiple"]=false;
                        
                        $this->add(AutoForm_Item::factory("selectbox", "hana_filter[".$item->entity_name."]")->data_src($data_src));
  
                        
                        
                        $this->where_col_setting[$item->entity_name]=array("name"=>$it_name, "operator"=>"=");
                    }
                    else
                    {
                        //$this->add(AutoForm_Item::factory("text", "label_".$this->counter)->value("---"));
                        
                        // obyc edit
                        $this->like_col_setting[$item->entity_name]=array("name"=>$it_name, "operator"=>"like");
                        $this->add(AutoForm_Item::factory("edit", "hana_filter[".$item->entity_name."]"));

                        
                    }
                }

            }
            else
            {
                // manualni nastaveni typu filtru
                switch ($settings["type"]) {
                    case "edit":
                         $it_name=(Inflector::plural($data_src["related_table_1"]).".".(isset($data_src["column_name"])?$data_src["column_name"]:"id")); 
                         $this->like_col_setting[$item->entity_name]=array("name"=>$it_name, "operator"=>"like");
                         $this->add(AutoForm_Item::factory("edit", "hana_filter[".$item->entity_name."]"));
                         break;
                     
                    case "datepicker":
//                        if($item->entity_name=="order_date_start" || $item->entity_name=="order_date_end")
//                        {
                            $this->where_col_setting[$item->entity_name]=array("name"=>$it_name, "operator"=>"=", "decoration"=>"cz_date_to_eng");
//                        }
//                        else
//                        {
//                            $this->like_col_setting[$item->entity_name]=array("name"=>$name, "operator"=>"like", "decoration"=>"cz_date_to_eng");
//                        }

                        $this->add(AutoForm_Item::factory($settings["type"], "hana_filter[".$item->entity_name."]")->set_initial_value_enabled(false));  

                        break;
                    
                    case "daterangepicker":
                        
                        $decorator=(isset($settings["date_incr_day"]) && $settings["date_incr_day"])?"range_cz_date_to_eng_incr_day":"range_cz_date_to_eng";
                        $this->where_col_setting[$item->entity_name]=array("name"=>$it_name, "operator"=>"=", "decoration"=>$decorator);                    
                        
                        $this->add(AutoForm_Item::factory($settings["type"], "hana_filter[".$item->entity_name."]")->set_initial_value_enabled(false));  

                        break;
                    

                    default:
                        break;
                }

            }
        }

        $this->counter++;



    }

    public function pregenerate($data_orm) 
    {
        // zpracovani obdrzenych dat z odeslaneho filtrovaciho formulare, nebo jako GET parametr (pro vyfiltrovani z prechod na vyfiltrovany seznam z jineho seznamu)
        if((isset($_POST["do-filter"]) && $_POST["hana_filter"]) || (isset($_GET["do-filter"]) && $_GET["hana_filter"]))
        {
           // nastaveni filtru
           $data["do-filter"]=true;
           foreach($_POST["hana_filter"] as $filter_name => $filter_item)
           {
               $data["hana_filter[".$filter_name."]"]=$filter_item;
           }
           $_SESSION[$this->parent_container->module_key][$this->parent_container->submodule_key][$this->parent_container->subaction_key]["filter"]=$data;
        }
        elseif(isset($_POST["destroy-filter"]) || isset($_GET["destroy-filter"]))
        {
            // zruseni filtru
            $data=array();
            $_SESSION[$this->parent_container->module_key][$this->parent_container->submodule_key][$this->parent_container->subaction_key]["filter"]=$data;
        }
        
        return parent::pregenerate($data_orm);
    }

    public function generate($data_orm) {
        $data=isset($_SESSION[$this->parent_container->module_key][$this->parent_container->submodule_key][$this->parent_container->subaction_key]["filter"])?$_SESSION[$this->parent_container->module_key][$this->parent_container->submodule_key][$this->parent_container->subaction_key]["filter"]:array();

        //print_r($data);
        $result = parent::generate($data);
        if(isset($data["do-filter"]) && $data["do-filter"]) $result["do_filter"]=true; else $result["do_filter"]=false;
        //print_r($result);
        return $result;  
    }

    public function get_where_rules($module_key,$submodule_key,$subaction_key)
    {
        if(!is_array($this->where_rules))
        {
            $this->where_rules=array();
            foreach($this->where_col_setting as $key=>$setting)
            {
                if(isset($_SESSION[$module_key][$submodule_key][$subaction_key]["filter"]["hana_filter[".$key."]"]) && $_SESSION[$module_key][$submodule_key][$subaction_key]["filter"]["hana_filter[".$key."]"])
                {
                    $value=$_SESSION[$module_key][$submodule_key][$subaction_key]["filter"]["hana_filter[".$key."]"];
                    if(isset($setting["decoration"]))
                    {
                        $decoration_method="_".$setting["decoration"];
                        $value=$this->$decoration_method($value);
                    }
                    if((!is_array($value) && isset($value)))
                    {
                        $this->where_rules[]=array($setting["name"],$setting["operator"],$value);
                    }
                    elseif(is_array($value))
                    {
                        foreach ($value as $row) {
                            $operator=isset($row["operator"])?$row["operator"]:$setting["operator"];
                            $value=isset($row["value"])?$row["value"]:$row;
                            $this->where_rules[]=array($setting["name"],$operator,$value);
                        }
                    }    
                }
            }
            //print_r($this->where_rules);
        
        }
        return $this->where_rules;
    }

    public function get_like_rules($module_key,$submodule_key,$subaction_key)
    {
        if(!is_array($this->like_rules))
        {
            $this->like_rules=array();
            foreach($this->like_col_setting as $key=>$setting)
            {
                if(isset($_SESSION[$module_key][$submodule_key][$subaction_key]["filter"]["hana_filter[".$key."]"]) && $_SESSION[$module_key][$submodule_key][$subaction_key]["filter"]["hana_filter[".$key."]"])
                {
                    $value=$_SESSION[$module_key][$submodule_key][$subaction_key]["filter"]["hana_filter[".$key."]"];
                    if(isset($setting["decoration"]))
                    {
                        $decoration_method="_".$setting["decoration"];
                        $value=$this->$decoration_method($value);
                    }
                    $this->like_rules[]=array($setting["name"],$setting["operator"],"%".$value."%");
                }
            }
        }
        //print_r($this->like_rules);
        return $this->like_rules;
    }
    
    
    // dekoracni metody
    
    /**
     * Prevadec ceskeho formatu datumu na anglicky
     * @param type $value
     * @param type $increase_day
     * @return type 
     */
    private function _cz_date_to_eng($value,$increase_day=0)
    {
        $cz_date=explode(".", $value);
        if(isset($cz_date[0]) && isset($cz_date[1]) && isset($cz_date[2]))
        {
            $date=($cz_date[2]."-".str_pad($cz_date[1], 2, "0", STR_PAD_LEFT)."-".str_pad($cz_date[0], 2, "0", STR_PAD_LEFT));
            if($increase_day){
                $date=date("Y-m-d", (strtotime($date)+($increase_day*60*60*24)));
            }
            return($date);
        }
        else
        return null;
    }
    
    // zpracuje datepicker
    private function _range_cz_date_to_eng($value, $all_day=true)
    {
        $daterange=explode("-", $value);
        if(count($daterange)>1 || $all_day)
        {
            if($all_day && !isset($daterange[1])){
                $daterange[1]=$daterange[0];
            }else{
                
            }
            
            $result=array();
            $result[0]["value"]=$this->_cz_date_to_eng(trim($daterange[0]));
            $result[0]["operator"]=">=";
            $result[1]["value"]=$this->_cz_date_to_eng(trim($daterange[1]),($all_day)?1:0);
            $result[1]["operator"]="<=";
            //(print_r($result));
            return($result);
            
        }
        else
        {
            return $this->_cz_date_to_eng($value);
        }
    }
    
    private function _range_cz_date_to_eng_incr_day($value)
    {
        return $this->_range_cz_date_to_eng($value, true);
    }
    
    private function _tricheckbox_value($value){
        if($value==2) return(0);
        return($value);
    }


}
?>
