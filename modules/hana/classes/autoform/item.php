<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Zakladni polozka (sablona polozky) koncoveho elementu ve strukture AutoForm.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
abstract class AutoForm_Item extends AutoForm_Entity
{
    public $value=false;        // hodnota prvku - nebere se v potaz hodnota db
    public $default_value=false;// defaultni hodnota pro polozku kde je prazdna hodnota v db      
    public $disabled=false;     // priznak, ze je polozka neaktivni (read-only)
    public $settings=array();   // nastaveni prvku v kontextu kde je pouzit (jako polozka ve filtrovani, v list tabulce, v editu)
    public $data_src=array();   // promenna pro eventualni nastaveni zdroje dat
    public $subquery;
    public $data_orm;           // odkaz na aktualni instanci datoveho ormka
    public $render_type="";     // nastaveni typu vystupu 
    public $export_settings;    // true/false, nebo nastavovaci pole pro format vystupu polozky do exportu
    public $print_settings;     // true/false, nebo nastavovaci pole pro format vystupu polozky na tisk

    protected $_default_lang_id=1;
    /**
     *
     * @param string $name jmeno prvku
     */
    public function __construct($name)
    {
        parent::__construct($name);
    }

    /**
     * Tovarni metoda pro vygenerovani prvku a provedeni jeho nastaveni v jednom kroku.
     * @chainable
     * @param string $item_type typ prvku ze slozky /item
     * @param <type> $name nazev prvku (odpovida jmenu v db - pokud je propojen s databazi)
     * @return AutoForm_Item $this
     */
    public static function factory($item_type,$name)
    {
            // Set class name
            $item = 'AutoForm_Item_'.ucfirst($item_type);

            return new $item($name);
    }

    /**
     * Nastavi dynamick parametry prvku.
     *
     * @chainable
     * @param string $name nazev nastaveni
     * @param array/string $arguments parametry nastaveni
     * @return object $this
     */
    public function __call($name,  $arguments) {
        $this->settings[$name]=$arguments[0];
        return $this;
    }

    public function settings($key, $value)
    {
        $this->settings[$key]=$value;
    }

    /**
     * Metoda pro dosazeni konkretni staticke hodnoty.
     * @param mixed $data
     * @return AutoForm_Item
     */
    public function value($data)
    {
        $this->value=$data;
        return $this;
    }
    
    /**
     * Metoda pro dosazeni vychozi hodnoty.
     * @param mixed $data
     * @return AutoForm_Item
     */
    public function default_value($data)
    {
        $this->default_value=$data;
        return $this;
    }

    /**
     * Metoda pro nastaveni zdroje dat. Prenastavi standardni zpusob ziskani dat $orm->$item_name<br />
     * priklady:<br />
     * $orm->related_1->related_2->column<br />
     * $orm->related_1->column<br />
     * $orm->column<br />
     *
     * @chainable
     * @param array $data_src pole hodnot [column_name][related_table_1] [related_table_2]
     * @return AutoForm_Item
     */
    public function data_src($data_src)
    {
        $this->data_src=$data_src;
        return $this;
    }
    
    public function subquery($subquery)
    {
        $this->subquery=$subquery;
        return $this;
    }
    
    /**
     * Metoda pro nastaveni typu vypisu polozky. Typy: prazdna hodnota=standardni, export, print.
     *
     * @chainable
     * @param array $type
     * @return AutoForm_Item
     */
    public function render_type($type)
    {
        $this->render_type=$type;
        return $this;
    }

    /**
     * Zpracuje obdrzena formularova data a vrati je, lze zaimplementovat specialni formatovani XSS filtr apod.
     */
    public function pregenerate($data_orm, $data_array=false) {
        // defaultni implementace - ziskani a predzpracovani dat
        $this->data_orm=$data_orm;

        
        // provedu preparsovani pripadnych vlozenych HTML atributu prvku
        $html="";
        if(isset($this->settings["HTML"]) && count($this->settings["HTML"]))
        {
            $this->settings["HTML_array"]=$this->settings["HTML"];
            while (list($key, $val) = each($this->settings["HTML"])) {
                $html.= " $key =\"$val\" ";
            }
        }
        $this->settings["HTML"]=$html;

        // vraceni dat
        $data=null;
        if($data_array && isset($data_array[$this->entity_name]))
        {
            $data=($data_array[$this->entity_name]);
        }
        elseif(isset($_POST[$this->entity_name]))
        {
            $data=($_POST[$this->entity_name]);
        }
        elseif(isset($_GET[$this->entity_name]))
        {
            $data=($_GET[$this->entity_name]);
        }

        if(isset($data) && ($this->parent_container instanceof AutoForm_MultipleContainer || isset($this->data_src["multiple"])))
        {
            $data[$this->entity_name]=$data;
        }

        return $data;
    }

    /**
     * Vraceni vykresleneho prvku.
     * @param <type> $data
     * @param <type> $template sablona, kterou prvek pouzije pro sve generovani (u slozitejsich struktur)
     * @return <type>
     */
    public function generate($data, $template=false)
    {
        $name=$this->entity_name;
        $property=isset($this->data_src["column_name"])?$this->data_src["column_name"]:$name;

        // funkcionalita read-only ("subject" - vazana na sloupec readonly v tabulce subjektu; "language" - vazana na sloupec v jazykove tabulce)
        $this->disabled=false;
        $data_ro=(is_object($data))?$data:$this->data_orm;
            
        if(isset($this->settings["readonly"]))
        {
            switch ($this->settings["readonly"]) {
                case "route":
                    if($data_ro->route->read_only==1) $this->disabled=true;
                    break;

                case "subject":
                default:
                    if($data_ro->read_only==1)$this->disabled=true;
                    break;
            }
        }
        
        if(Session::instance()->get("admlang") && Session::instance()->get("admlang") != $this->_default_lang_id && (!$data_ro->is_language_property($this->entity_name))) $this->disabled=true;
        

        // zdroj dat muze byt bud objekt, nebo pole

        if(is_object($data))
        {
            $ret_data="";
            if($this->value!==false){
                $ret_data=$this->value;
            }
            elseif(!empty($this->subquery))
            {
                //$subquery=$this->subquery;
                $object=$this->subquery->decorate_object($data);
                $column=$this->subquery->column_to_get;
                if($this->subquery->find_all)
                {
                    $data=$object->find_all();
                    
                    foreach($data as $item)
                    {
                       $values[$item->id]=$item->$column;
                    }

                    $ret_data = $values;
                }
                elseif($this->subquery->find)
                {
                    $ret_data = $object->$column;
                }
            }   
            elseif(isset($this->data_src["multiple"]))
            {
                // pokud je vztah typu M:N
                $object1=$this->data_src["related_table_1"];
                $data=$data->$object1;
                if(isset($this->data_src["condition"])) $data->where($this->data_src["condition"][0],$this->data_src["condition"][1],$this->data_src["condition"][2]);
                //if(isset($this->data_src["orm_tree"]) && $this->data_src["orm_tree"]) $data->where("parent_id","=",0);
                if(isset($this->data_src["select"])) $data->select($this->data_src["select"]);
                if(isset($this->data_src["order_by"])) $data->select($this->data_src["order_by"]);
                $data = $data->find_all();
                $values=array();
                $column=isset($this->data_src["column_name"])?$this->data_src["column_name"]:"nazev";
                foreach($data as $item)
                {
                   $values[$item->id]=$item->$column;
                }

                $ret_data = $values;
            }
            elseif(isset($this->data_src["multiple"]))
            {
                //die(print_r($data));
            }
            elseif(isset($this->data_src["related_table_2"]))
            {
                // pripad $orm->related_1->related_2->column (1:N:1)
                $object1=$this->data_src["related_table_1"];
                $object2=$this->data_src["related_table_2"];
                
                if(Session::instance()->get("admlang") && Session::instance()->get("admlang") != $this->_default_lang_id && (!$data->is_language_property($this->entity_name)))
                {
                    // u nejazykovych polozek se musi uvodni data brat z hlavniho jazyku
                    $original_orm=orm::factory($data->object_name())->where("language_id","=",$this->_default_lang_id)->where($data->table_name().".id","=",$data->id)->find();                    
                    $data=$original_orm;
                }
                
                $ret_data = $data->$object1->$object2->$property;
  
            }elseif(isset($this->data_src["related_table_1"])){
                // pripad $orm->related_1->column(1:N)
                $object1=$this->data_src["related_table_1"];
                $ret_data = $data->$object1->$property;
            }
            else
            {
                // klasicka automatika bez nastaveni data_src
                $ret_data = $data->$property;
            }
            if((empty($ret_data) && (is_object($this->data_orm) && !$this->data_orm->id) && $this->default_value!==false))
            {
                $ret_data = $this->default_value;
            }
            return($ret_data);
            
        }else{
            if($this->value!==false){
                return $this->value;
            }
            
            return isset($data[$property])?$data[$property]:null;
        }


    }
}
?>
