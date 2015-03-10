<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Trida pro automaticke generovani seznamu polozek.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_List extends AutoForm_Container
{
    private $session;
    
    public $render_type;  // typ rendrování tabulky (nic=standardni vystup na screen, print=tisk, export=export do souboru) 

    public $item_page;    // aktualni stranka - nutno vyplnit
    public $edit_baseurl; // zaklad adresy listu

    public $module_key; // modulovy klic
    public $submodule_key; // submodulovy klic
    public $subaction_key;

    // ORM - reference na datovy objekt se kterym se pracuje
    public $orm;
    public $tree_mode;

    // obecne parametry AutoForm_Listu
    public $default_order_by   ="nazev"; // defaultni razeni
    public $default_order_direction   ="asc"; // defaultni razeni
    public $form_method;
    public $edit_link;
    public $web_type_code="";

    public $items_per_page=array(10=>10,20=>20,30=>30,50=>50,100=>100,100000=>"vše");
    public $items_per_page_default=30;

    // vlozene kontejnery AutoForm_Listu
    public $thead_section;
    public $filtering_section;
    public $data_table_section;
    public $summary_row_section;

    // parametry vkladaneho sloupce
    private $col_object=false;
    private $name;
    private $type="text";
    private $filterable_col=false;
    private $sequenceable_col=false;
    private $col_width=false;           // nastaveni sirky sloupce
    private $col_class=false;           // nastaveni tridy sloupce (th,td)
    private $col_label=false;           // nastaveni popisku sloupce
    private $item_settings=array();     // souhrnna dodatecna nastaveni pro konkretni polozku (HTML parametry tagu a dalsi nastaveni)
    private $item_value=false;          // pripadna staticka hodnota prvku ve sloupci (pokud nenastavena, cte se z orm)
    private $data_src=false;            // pripadna specifikace zdrojovych dat u M:N apod
    private $exportable=null;           // nastaveni vystupu polozky do exportu
    private $printable=null;            // nastaveni tiskoveho vystupu polozky
    
    // sumarizacni udaje
    public $summary_row=array();

    // auto-generovane parametry dostupne po nastaveni tabulky
    public $sequenceable       =false;    // raditelna tabulka
    public $filterable         =false;    // filtrovatelna tabulka

    // auto-generovane parametry dostupne po pregenerate
    public $count_records;

    public $order_by;
    public $order_direction;
    public $limit;
    public $offset;

    public $data_processing_errors;

    public function __construct($name, $render_type, $template, $orm_object, $module_key, $submodule_key, $subaction_key, $item_page, $autorization=false) {
        parent::__construct($name, $template);
        $this->render_type=$render_type;
        $this->session=Session::instance();
        $this->orm=$orm_object;
        $this->module_key=$module_key;
        $this->submodule_key=$submodule_key;
        $this->subaction_key=$subaction_key;
        $this->edit_baseurl="admin/".$this->module_key."/".$this->submodule_key."/".$this->subaction_key;
        $this->item_page=$item_page;
        
        // inicializace a vlozeni sekci
        $this->thead_section      = new AutoForm_Container("head_row");
        $this->add($this->thead_section);

        $this->filtering_section  = new AutoForm_Helper_FilterContainer("filtering_row");
        $this->add($this->filtering_section);

        $this->data_table_section = new AutoForm_MultipleContainer("data_section");
        $this->add($this->data_table_section);
        
        $this->summary_row_section = new AutoForm_Container("summary_row");
        $this->add($this->summary_row_section);
    }

    /**
     * Prida sloupec do tabulky. Metoda musi byt volana jako posledni
     * @chainable
     * @param AutoForm_Item $item
     */
    public function set()
    {
        if($this->col_object)
        {
            $item = $this->col_object;
        }
        else
        {
            $item = AutoForm_Item::factory($this->type,$this->name);
        }

        // preposlani nekterych parametru nastavenych sloupci konkretnimu prvku
        $item->settings = $this->item_settings;
        $item->render_type = $this->render_type;
        if($this->item_value!==false) $item->value = $this->item_value;
        if($this->data_src!==false) $item->data_src = $this->data_src;
        if($this->exportable!==null) $item->export_settings = $this->exportable;
        if($this->printable!==null) $item->print_settings = $this->printable;

        $name=$item->entity_name;

        // struktura automaticky generovanych sekci (kontejneru) v list-tabulce:
        // 1. thead_section        - standardni kontejner
        // 2. filtering_section    - specialni "filter" kontejner
        // 3. data_table_section   - standardni multiple kontejner
        // nadpis tabulky, horni ovladaci tlacitka, dolni ovladaci tlacitka a listovani budou soucasti sablony (nebudou v "automatickych" sekcich)

        // 1. pridani polozky do radku s nadpisem sloupce (s razenim/bez razeni)
        if($this->render_type=="" || ($this->render_type=="print" && $item->print_settings!==false) || ($this->render_type=="export" && $item->export_settings!==false))
        {        
            if($this->sequenceable_col) $this->sequenceable=true;
            $this->thead_section->add(AutoForm_Item::factory("textThead", $item->entity_name)->render_type($this->render_type)->value(($this->col_label)?$this->col_label:"&nbsp;")->sequencing($this->sequenceable_col));
            $html=array();
            if($this->col_class) $html["class"]=$this->col_class;
            if($this->col_width) $html["style"]="width:".$this->col_width."px;";
        
            // uzke sloupce budu automaticky centrovat
            if($this->col_width && $this->col_width<=60) $html["style"].=" text-align:center;";

            if(!empty($html))$this->thead_section->$name->HTML($html);
        }
        
        // 2. pridani polozky do radku s filtrovanim - pouze pokud jde o standardni generovani
        
        if($this->filterable_col)
        {
            $this->filterable=true;
            $this->filtering_section->add_filter($item, $this->data_src, $this->filterable_col);
        }
        else
        {
            $this->filtering_section->add_filter(false, false, false);
        }
        
        
        // 3. pridani polozky do radku v oblasti generovani dat
        if($this->render_type=="" || ($this->render_type=="print" && $item->print_settings!==false) || ($this->render_type=="export" && $item->export_settings!==false))
        {
            $this->data_table_section->add($item);
        }
        //if($this->col_class)$this->data_table_section->$name->html(array("class"=>$this->col_class));

        // vynulovani nastavovacich promennych pro sloupec
        $this->sequenceable_col=false;
        $this->filterable_col=false;
        $this->col_width=false;
        $this->col_class=false;
        $this->col_label=false;
        $this->col_object=false;
        $this->name=false;
        $this->type="text";
        $this->item_settings=array();
        $this->item_value=false;
        $this->data_src=false;
        $this->exportable=null;
        $this->printable=null;
    }

    /**
     * Nastavi nazev sloupce.
     * @chainable
     * @param string/object $item nazev sloupce, nebo primo objekt generovaneho prvku
     * @return AutoForm_List
     */
    public function column($col)
    {
        if(is_object($col))
        {
            $this->col_object = $col;
        }
        else
        {
            $this->name = $col;
        }
        return $this;
    }
    
    /**
     * Vlozi do tabulky sumarizacni radek.
     * @param array $columns nazvy sloupcu, ktere se budou scitat
     */
    public function summaryRow(array $columns)
    {
        foreach($columns as $col)
        {
            $this->summary_row[$col]=0;
            $this->summary_row_section->add(AutoForm_Item::factory("summary", $col));
        }
    }

    /**
     * Nastavi typ sloupce (standardne "text")
     * @chainable
     * @param string $type
     * @return AutoForm_List
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
     * @return AutoForm_List
     */
    public function value($value)
    {
        $this->item_value = $value;
        return $this;
    }

    /**
     * Nastavi specificky zdroj dat pro polozku (dokumentace ve tride AutoForm_Item)
     * @chainable
     * @param <type> $value
     * @return AutoForm_List
     */
    public function data_src($value)
    {
        $this->data_src = $value;
        return $this;
    }

    /**
     * Prideli sloupci vlastnost "filtrovatelny"
     * @chainable
     * @param string $settings eventualne vyplneni klauzule WHERE, jinak se bere automaticky
     * @return AutoForm_List
     */
    public function filterable($settings=true)
    {
        $this->filterable_col=$settings;
        return $this;
    }

    /**
     * Prideli sloupci vlastnost "raditelny"
     * @chainable
     * @param string $settings eventualni vyplneni klauzule ORDER BY, jinak se bere automaticky
     * @return AutoForm_List
     */
    public function sequenceable($settings=true)
    {
        $this->sequenceable_col=$settings;
        return $this;
    }
    
    /**
     * Nastavi export sloupce (defaultne se exportuje), true/false, nebo array pro dodatecne parametry
     * @chainable
     * @param mixed $settings boolean/array
     * @return AutoForm_List
     */
    public function exportable($settings=true)
    {
        $this->exportable=$settings;
        return $this;
    }
    
    /**
     * Nastavi tisknutelnost sloupce (defaultne se exportuje), true/false, nebo array pro dodatecne parametry
     * @chainable
     * @param mixed $settings boolean/array 
     * @return AutoForm_List
     */
    public function printable($settings=true)
    {
        $this->printable=$settings;
        return $this;
    }
    
    /**
     * Nastavi sirku sloupce
     * @chainable
     * @param int $width
     * @return AutoForm_List
     */
    public function width($width)
    {
        $this->col_width=$width;
        return $this;
    }

    /**
     * Nastavi tridu sloupce
     * @chainable
     * @param string $class
     * @return AutoForm_List
     */
    public function css_class($class)
    {
        $this->col_class=$class;
        return $this;
    }

    /**
     * Nastavi popisek sloupce
     * @chainable
     * @param string $label
     * @return AutoForm_List
     */
    public function label($label)
    {
        $this->col_label=$label;
        return $this;
    }

    /**
     * Dodatecna nastaveni pro konkretni prvek zobrazovany ve sloupci.
     * @chainable
     * @param array $settings
     * @return AutoForm_List
     */
    public function item_settings(array $settings)
    {
        $this->item_settings=$settings;
        return $this;
    }

    /**
     * Po provedeni predgenerovani a vsech akci nad databazi na zaklade obdrzenych dat, pripravi tato metoda auto-generovane promenne na zaklade aktualniho stavu dat.
     */
    public function prepare() {
        // obsluha strankovani
        if(isset($_GET["it_per_pg"])) $this->session->set("it_per_pg", $_GET["it_per_pg"]);
        $ormcopy=clone $this->orm;
        if($this->tree_mode){$this->count_records=$ormcopy->where("parent_id","=",0)->count_all("DISTINCT ".$ormcopy->table_name().".id");}else{$this->count_records=$ormcopy->count_all("DISTINCT ".$ormcopy->table_name().".id");}

        // inicializace strankovani
        $this->pagination = Pagination::factory(array(
              'current_page'   => array('source' => $this->edit_baseurl, 'value'=>$this->item_page),
              'total_items'    => $this->count_records,
              'items_per_page' => $this->session->get("it_per_pg")?$this->session->get("it_per_pg"):$this->items_per_page_default,
              'view'           => 'pagination/basic',
              'auto_hide'      => TRUE
        ));

        $this->limit=$this->pagination->items_per_page;
        $this->offset=$this->pagination->offset;

        if(isset($_SESSION[$this->module_key][$this->submodule_key][$this->subaction_key]["order"]))
        {
            $this->order_by=$_SESSION[$this->module_key][$this->submodule_key][$this->subaction_key]["order"]["orderby_col_name"];
            $this->order_direction=$_SESSION[$this->module_key][$this->submodule_key][$this->subaction_key]["order"]["order_direction"];
        }

    }

    public function generate($data_orm, $template=false)
    {
            $template = parent::generate($data_orm);

            // doplneni prvku do obecne casti sablony

            if($this->tree_mode)
            {
                $count_records="Celkem položek v základní úrovni: <span class=\"strong\">".$this->count_records."</span>";
            }
            else
            {
                $count_records="Celkem položek: <span class=\"strong\">".$this->count_records."</span>";
            }
            
            if($this->render_type=="") // do exportu ani tisku
            {
                $template->count_records=$count_records;
            
                // strankovani
                $template->items_per_pg=$this->items_per_page;
                $template->items_per_pg_sel=$this->session->get("it_per_pg")?$this->session->get("it_per_pg"):$this->items_per_page_default;
                $template->pagination=$this->pagination->render();
                
                // posledni editovana polozka
                $template->affected_rowid=Input::get("affected_rowid", null);
                
            }
            //die(print_r($template));
            return $template;
        
    }
    

}
?>