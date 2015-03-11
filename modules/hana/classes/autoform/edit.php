<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Trida pro automaticke generovani editacniho formulare.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Edit extends AutoForm_Container
{
    
    // vlozene kontejnery AutoForm_Editu
    public $data_table_section;
    public $data_photo_section;          
    
    // parametry vkladaneho radku
    private $row_object=false;
    private $name;
    private $type="text";               // vychozi typ formularoveho prvku v bunce
    private $row_class=false;           // nastaveni tridy radku
    private $row_label=false;           // nastaveni popisku radku
    private $row_variant=false;         // variantu radku
    private $row_condition=false;       // nastaveni podminky pro radek
    private $item_settings=array();     // souhrnna dodatecna nastaveni pro konkretni polozku
    private $item_value=false;          // pripadna staticka hodnota prvku ve sloupci (pokud nenastavena, cte se z orm, jinak se db nenacita a vezme se tato hodnota)
    private $item_default_value=false;       // vychozi hodnota, pokud je v db prazdna
    private $data_src=false;            // pripadna specifikace zdrojovych dat u M:N apod
    private $data_callback=false;
    private $subquery=false;
    private $script="";
    private $popover = array();
    
    public $summary_row=array();


    private $row_parameters=array();    // pole pro uchovani dalsich nastavenych parametru radku
    public $row_errors=array();         // pole pripadnych datovych chyb k polozkam na radku

    public function __construct($name, $template, $autorization=false) {
        parent::__construct($name, $template);
        // inicializace a vlozeni sekci

        $this->data_table_section = new AutoForm_Container("data_section");
        $this->add($this->data_table_section);

//        // pokud bude pozadovan photobox zahrnu ho do kontejneru
//        if($with_photo_box)
//        {
//            // tenhle kontejner se bude generovat primo do specialni sablony "base_photo_edit"
//            $this->data_photo_section = new AutoForm_MultipleContainer("photo_section", "base_photo_edit");
//            $this->add($this->data_photo_section);
//        }
        
        

    }

    /**
     * Prida radek do tabulky. Metoda musi byt volana jako posledni
     * @chainable
     * @param AutoForm_Item $item
     */
    public function set()
    {
        if($this->row_object)
        {
            $item = $this->row_object;
        }
        else
        {
            $item = AutoForm_Item::factory($this->type,$this->name);
        }

        // preposlani nekterych parametru nastavenych sloupci konkretnimu prvku
        $item->settings = $this->item_settings;
        if($this->item_value!==false) $item->value = $this->item_value;
        if($this->item_default_value!==false) $item->default_value = $this->item_default_value;
        if($this->data_src!==false) $item->data_src = $this->data_src;
        if($this->subquery!==false) $item->subquery = $this->subquery;
        $item->popover = $this->popover;

        $name=$item->entity_name;

        // struktura automaticky generovanych sekci (kontejneru) v edit-tabulce:
        // 1. data_table_section   - standardni kontejner
        // 2. nepovinna foto-sekce - standardni kontejner
        // nadpis tabulky, horni ovladaci tlacitka, dolni ovladaci tlacitka budou soucasti sablony (nebudou v "automatickych" sekcich)

        $this->row_parameters[$name]["class"]     =$this->row_class;
        $this->row_parameters[$name]["variant"]   =$this->row_variant;
        $this->row_parameters[$name]["label"]     =$this->row_label;
        $this->row_parameters[$name]["condition"] =$this->row_condition;

        // pridani polozky do radku v oblasti generovani dat
        $this->data_table_section->add($item);
        //if($this->col_class)$this->data_table_section->$name->html(array("class"=>$this->col_class));

        // vynulovani nastavovacich promennych pro sloupec
        $this->row_class=false;
        $this->row_variant=false;
        $this->row_label=false;
        $this->row_condition=false;
        $this->row_object=false;
        $this->name=false;
        $this->type="text";
        $this->item_settings=array();
        $this->item_value=false;
        $this->item_default_value=false;
        $this->data_src=false;
        $this->subquery=false;
    }

    /**
     * Nastavi nazev sloupce.
     * @chainable
     * @param string/object $item nazev sloupce, nebo primo objekt generovaneho prvku
     * @return AutoForm_Edit
     */
    public function row($row)
    {
        if(is_object($row))
        {
            $this->row_object = $row;
        }
        else
        {
            $this->name = $row;
        }
        return $this;
    }

    /**
     * Nastavi typ sloupce (standardne "text")
     * @chainable
     * @param string $type
     * @return AutoForm_Edit
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * Nastavi statickou hodnotu prvku ve sloupci
     * @chainable
     * @param mixed $value
     * @return AutoForm_Edit
     */
    public function value($value)
    {
        $this->item_value = $value;
        return $this;
    }
    
    /**
     * Nastavi vychozi hodnotu prvku ve sloupci
     * @chainable
     * @param mixed $value
     * @return AutoForm_Edit
     */
    public function default_value($value)
    {
        $this->item_default_value = $value;
        return $this;
    }

    /**
     * Nastavi specificky zdroj dat pro polozku (dokumentace ve tride AutoForm_Item) - deprecated - pouzijte obecnejsi subquery()
     * @chainable
     * @deprecated
     * @param <type> $value
     * @return AutoForm_Edit
     */
    public function data_src($value)
    {
        $this->data_src = $value;
        return $this;
    }
    
    /**
     *
     * @chainable
     * @param type $value
     * @return AutoForm_Edit 
     */
    public function subquery($value)
    {
        $this->subquery = $value;
        return $this;
    }


    /**
     * Nastavi tridu radku
     * @chainable
     * @param string $class
     * @return AutoForm_Edit
     */
    public function css_class($class)
    {
        $this->row_class=$class;
        return $this;
    }

    /**
     * Nastavi popisek radku
     * @chainable
     * @param string $label
     * @return AutoForm_Edit
     */
    public function label($label)
    {
        $this->row_label=$label;
        return $this;
    }

    public function popover($text)
    {
        $this->popover = $text;
        return $this;
    }

    /**
     * Nastavi podminku (text) za formularovym prvkem
     * @chainable
     * @param string $condition
     * @return AutoForm_Edit
     */
    public function condition($condition)
    {
        $this->row_condition = $condition;
        return $this;
    }

    /**
     * Nastavi specialni variantu radku, zmeni generovani dle sablony.
     * @chainable
     * @param string $variant
     * @return AutoForm_Edit
     */
    public function variant($variant)
    {
        $this->row_variant = $variant;
        return $this;
    }

    /**
     * Dodatecna nastaveni pro konkretni prvek zobrazovany ve sloupci.
     * @chainable
     * @param array $settings
     * @return AutoForm_Edit
     */
    public function item_settings(array $settings)
    {
        $this->item_settings=$settings;
        return $this;
    }

    /**
     * Vlozeni obsluzneho JS (jquery) k editacnimu formulari
     * @param string $script
     */
    public function add_script($script)
    {
        $this->script.=$script."\n";
    }

    public function generate($data_orm)
    {
        $this->template->script=$this->script;
        $this->template->row_parameters=$this->row_parameters;
        $this->template->row_errors=$this->row_errors;
        return parent::generate($data_orm);
    }

}
?>