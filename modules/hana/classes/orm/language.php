<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Trida rozsirujici standardni ORM o jazykove verze. Verze pro system Hana 2.6
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class ORM_Language extends Kohana_ORM{

    // atributy, ktere se budou nacitat/ukladat do propojene tabulky "language"
    protected $_class_name;                // "product"
    protected $_language_class_name;       // "product_data"
    protected $_language_table_suffix="data";
    protected $_route_columns=array("nazev_seo"=>"","title"=>"","description"=>"","keywords"=>"","zobrazit"=>"");

    protected $_selected_language_id=false; // mozno menit dynamicky setrem, ve vychozim stavu nebude jazykova podminka
    protected $_join_on_routes=false; // mozno predefinovat v odvozenych tridach

    private $_language_table_name;
    private $_language_columns = array();
    private $_language_column_changed = array();
    private $_language_data_loaded=false;
    private $_language_db_pending=false;

    private $route_orm;

    protected $_ld_orm;

    // napr. product_category
    private $_get_count_all=false;

    public $class_name;

    // Stores column information for ORM models
    protected static $_language_column_cache = array();
    protected static $_ignored_column_cache = array();

    public function __construct($id = NULL)
    {
        if(!empty($this->_class_name))
        {
            $this->_table_name = Inflector::plural(strtolower($this->_class_name));

        }
        else
        {
            $segm=explode("_",get_class($this));
            for($x=1;$x<count($segm);$x++)
            {
                $this->_class_name.=$segm[$x].(($x<(count($segm)-1))?"_":"");
            }
        }

        $this->class_name=$this->_class_name;
        $this->_language_table_name=strtolower($this->_class_name)."_".$this->_language_table_suffix;

        // nastavim jazykovy auto modeler a pripojim ho k tomuto modelu
        $this->_has_many["language_data"] = array();

        parent::__construct($id);

        if (isset(ORM_Language::$_language_column_cache[$this->_object_name]))
        {
            // Use cached column information
            $this->_language_columns = ORM_Language::$_language_column_cache[$this->_object_name];
            $this->_ignored_columns = ORM_Language::$_ignored_column_cache[$this->_object_name];
            Model_Language_Data::$dynamic_table_columns=$this->_language_columns;
        }
        else
        {
            // Grab column information from database
            if(empty($this->_language_columns))
            {
                foreach($this->language_data->list_columns() as $col=>$par)
                {
                    if($col!="id")
                    {
                        $this->_language_columns[$col]=$col;
                        $this->_ignored_columns[$col]=$col;
                    }
                }
            }else{
                $this->_ignored_columns=$this->_language_columns;
            }

            Model_Language_Data::$dynamic_table_columns=$this->_language_columns;

            ORM_Language::$_language_column_cache[$this->_object_name]=$this->_language_columns;
            ORM_Language::$_ignored_column_cache[$this->_object_name]=$this->_ignored_columns;
        }


    }

    protected function _build($type){

        // tady musim odchytit WHERE prikazy - tykajici se pripojene jazykove tabulky a udelat z nich subselect

        foreach($this->_db_pending as $key=>$item){

//            if(is_array($item["args"][0]))
//            {
//                $this->_db_pending[$key]["args"]=$item["args"][0][0];
//                $item["args"][0]=$this->_db_pending[$key]["args"][0];
//            }

            if($item["name"]=="where" && !is_object($item["args"][0]) && array_key_exists($item["args"][0], $this->_language_columns))
            {
                $this->_language_db_pending[$key]=$this->_db_pending[$key];
                unset($this->_db_pending[$key]);
            }
        }

        if(!$this->_get_count_all) array_unshift($this->_db_pending, array('name' => "select", 'args' => array(0=>strtolower($this->_class_name)."_".$this->_language_table_suffix.".*")));

        array_unshift($this->_db_pending, array('name' => "on",'args' => array(0=>$this->_table_name.".id",1=>"=",2=>strtolower($this->_class_name)."_".$this->_language_table_suffix.".".strtolower($this->_class_name)."_id")));

        if($this->_selected_language_id!==false)
        {
            array_unshift($this->_db_pending, array('name' => "on",'args' =>array(0=>$this->_language_table_name.".language_id",1=>"=",2=>DB::expr($this->_selected_language_id))));
        }

        array_unshift($this->_db_pending, array('name' => "join", 'args' => array(0=>$this->_language_table_name,1=>"LEFT")));


        parent::_build($type);

        // doplnim query builder o vnoreny dotaz pro praci s pripojenymi atributy
        //$subquery=DB::select('page_id')->from($this->_class_name."_".$this->language_table_suffix);

        // vyselectuju polozky v pripojene jazykove tabulce


        if(is_array($this->_language_db_pending) && count($this->_language_db_pending))
        {
            foreach($this->_language_db_pending as $key=>$item)
            {

                $this->_db_builder->where($this->_language_table_name.".".$item["args"][0],$item["args"][1],$item["args"][2]);

            }
        }

        //puvodni where nahrazeno na 109 left joinem
        //$this->_db_builder->where($this->_language_table_name.".language_id","=",$this->selected_language_id);

        return $this;
    }

    public function __get($column)
    {
        if(array_key_exists($column, $this->_language_columns) && !$this->_language_data_loaded )
        {
            $this->_load_language_data();
        }

        if($this->_join_on_routes && $column=="route")
        {
            return $this->get_orm_route();
        }
        elseif($this->_join_on_routes && key_exists($column, $this->_route_columns))
        {
            return $this->get_orm_route()->$column;
        }

        Model_Language_Data::$dynamic_table_name=$this->_language_table_name;
        return parent::__get($column);
    }

    public function __set($column, $value){
        if(array_key_exists($column, $this->_language_columns))
        {
            $this->_language_column_changed[$column] = $column;
        }
        elseif(true)
        {
            //TODO - kontrolu parametru vazajicich se na routu

        }

        Model_Language_Data::$dynamic_table_name=$this->_language_table_name;
        return parent::__set($column, $value);
    }

    public function save()
    {
        Model_Language_Data::$dynamic_table_name=$this->_language_table_name;

        // zmena puvodni implementace - pred ukladanim se testuje zda doslo ke zmene atributu (vlastniho, nebo jazykoveho)
        if (empty($this->_changed) AND empty($this->_language_column_changed))
            return $this;

        $data = array();
        foreach ($this->_changed as $column)
        {
            // Compile changed data
            $data[$column] = $this->_object[$column];
        }

        if ( ! $this->empty_pk() AND ! isset($this->_changed[$this->_primary_key]))
        {
            // Primary key isn't empty and hasn't been changed so do an update

            if (is_array($this->_updated_column))
            {
                // Fill the updated column
                $column = $this->_updated_column['column'];
                $format = $this->_updated_column['format'];

                $data[$column] = $this->_object[$column] = ($format === TRUE) ? time() : date($format);
            }

            if(!empty($data))
            {
                // ukladat v hlavnim objektu budu pouze tehdy, dojde-li ke zmene dat v hlavnim objektu
                // pokud doslo ke zmene dat pouze v pripojenem jazykovem objektu, tato cast bude preskocena
                $query = DB::update($this->_table_name)
                    ->set($data)
                    ->where($this->_primary_key, '=', $this->pk())
                    ->execute($this->_db);
            }

            // Object has been saved
            $this->_saved = TRUE;
        }
        else
        {
            if (is_array($this->_created_column))
            {
                // Fill the created column
                $column = $this->_created_column['column'];
                $format = $this->_created_column['format'];

                $data[$column] = $this->_object[$column] = ($format === TRUE) ? time() : date($format);
            }

            $result = DB::insert($this->_table_name)
                ->columns(array_keys($data))
                ->values(array_values($data))
                ->execute($this->_db);

            if ($result)
            {
                if ($this->empty_pk())
                {
                    // Load the insert id as the primary key
                    // $result is array(insert_id, total_rows)
                    $this->_object[$this->_primary_key] = $result[0];
                }

                // Object is now loaded and saved
                $this->_loaded = $this->_saved = TRUE;
            }
        }

        if ($this->_saved === TRUE)
        {
            // All changes have been saved
            $this->_changed = array();
        }

        //die(print_r($this->as_array()));

        // pri ukladani musim oddelene ulozit i jazykove polozky
        if (empty($this->_language_column_changed))
            return $this;

        $data = array();
        foreach ($this->_language_column_changed as $column)
        {
            // Compile changed data
            $data[$column] = $this->_object[$column];
        }


        if (DB::select(array('COUNT("*")', 'records_found'))->from($this->_language_table_name)->where("language_id","=",$this->_selected_language_id)->where(strtolower($this->_class_name)."_id","=",$this->pk())->execute()->get('records_found'))
        {
            $query = DB::update($this->_language_table_name)
                ->set($data)
                ->where(strtolower($this->_class_name)."_id", '=', $this->pk())
                ->where("language_id","=",$this->_selected_language_id)
                ->execute($this->_db);
        }
        else
        {
            $data["language_id"]=$this->_selected_language_id;
            $data[strtolower($this->_class_name)."_id"]=$this->pk();


            $result = DB::insert($this->_language_table_name)
                ->columns(array_keys($data))
                ->values(array_values($data))
                ->execute($this->_db);
        }

        $this->_language_column_changed = array();


        return $this;


    }

    protected function _load_language_data(){

        // nahraju rucne hodnoty z pripojene jazykove tabulky a vlozim je do objektu jako by to byly jeho atributy
        $this->_load();
        //die(print_r($this->_object));
        $this->_ld_orm=$this->_object;//$this->language_data->where("language_id","=",$this->selected_language_id)->find();

        foreach ($this->_language_columns as $col=>$value)
        {
            if(!isset($this->_language_column_changed[$col])) // pokud byl jiz atribut pred nactenim dat z modelu zmenen, uz ho neprenacitam
            {
                if(!empty($this->_ld_orm[$col]))
                {
                    $this->$col=$this->_ld_orm[$col]; // pokud jsou data - vyplnim
                }
                else
                {
                    $this->$col=""; //pokud nejsou, provedu jeho inicializaci na prazdnou hodnotu
                }
            }
        }

        $this->_language_data_loaded=true;

    }

    public function clear(){
        $this->_language_data_loaded=false;
        $this->_language_column_changed=false;

        Model_Language_Data::$dynamic_table_name=$this->_language_table_name;
        return parent::clear();
    }

    public function delete($id = NULL)
    {
        // upraveni zaznamu v tabulce routes
        if($this->_join_on_routes)
        {
            Service_Route::delete_route($this->route_id);
        }

        // vymazani z jazykove tabulky
        DB::delete($this->_language_table_name)
            ->where(strtolower($this->_class_name)."_id", '=', $this->pk())
            ->execute($this->_db);

        // smazani ze zakladniho ormka
        Model_Language_Data::$dynamic_table_name=$this->_language_table_name;
        return parent::delete($id);
    }

    public function delete_all()
    {
        Model_Language_Data::$dynamic_table_name=$this->_language_table_name;
        $this->_build(Database::SELECT);

        $result = $this->_db_builder->from($this->_table_name)
            ->select(array($this->_table_name.'.id', 'ids'))
            ->execute($this->_db);
        $ids=array();
        foreach($result as $item){
            $ids[]=$item["ids"];
        }
        if(!empty($ids))
        {
            DB::delete($this->_language_table_name)->where(strtolower($this->_class_name)."_id","IN",$ids)->execute();
            DB::delete($this->_table_name)->where($this->_primary_key,"IN",$ids)->execute();
        }

        //die("-".$records);

        return $this->clear();
        //return parent::delete_all();
    }

    public function as_array()
    {
        if(!$this->_language_data_loaded)
        {
            $this->_load_language_data();
        }

        return parent::as_array();
    }

    /**
     * Umoznuje zjistit, zda dana properta je obecna, nebo patri do jazykove tabulky
     * @param string $property_name
     * @return boolean
     */
    public function is_language_property($property_name)
    {
        if(key_exists($property_name, $this->_language_columns))
        {
            return true;
        }
        else
        {
            if(key_exists($property_name, $this->_route_columns))
            {
                return true; // soucasti routy jsou rovnez jazykovy polozky
            }
            else
            {
                return false;
            }
        }
    }

    public function is_route_property($property_name)
    {
        if(key_exists($property_name, $this->_route_columns))
        {
            return true; // soucasti routy jsou rovnez jazykovy polozky
        }
        else
        {
            return false;
        }
    }

    public function get_class_name()
    {
        return $this->_class_name;
    }

    public function get_language_class_name()
    {
        return $this->_language_table_name;
    }

    public function get_language_table_name()
    {
        return $this->_language_table_name;
    }

    public function count_all($condition="*")
    {
        $this->_get_count_all=true;
        $response=parent::count_all($condition);
        $this->_get_count_all=false;

        return $response;
    }

    /**
     * Nastavi jazykovou podminku.
     * @param int $lang_id (0=jazyk na zaklade aktualni routy, 1..n pozadovany jazyk)
     * @return ORM_language
     */
    public function language($lang_id=0)
    {
        if($lang_id==0)
        {
            $this->_selected_language_id=Hana_Application::instance()->get_actual_language_id();
        }
        else
        {
            $this->_selected_language_id=$lang_id;
        }

        return($this);
    }

    public function get_selected_language_id()
    {
        return $this->_selected_language_id;
    }

    public function is_join_on_routes()
    {
        return $this->_join_on_routes;
    }

    public function get_orm_route()
    {
        if(!$this->_join_on_routes) throw new Kohana_Exception("toto orm není napojeno na routes");

        if(empty($this->route_orm))
        {
            $this->route_orm = orm::factory("route")->where("id","=",$this->route_id)->find();
        }
        return $this->route_orm;
    }

    public function object_name()
    {
        return $this->_class_name;
    }

}