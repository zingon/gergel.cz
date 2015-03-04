<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Zakladni trida pro implementaci listu/editu - kompozit.
 * Definuje "kontejner" do ktereho lze vkladat dalsi kontejnery, nebo koncove HTML prvky.
 * Vnorene kontejnery vytvori vnorene struktury smycek v sablonach.
 *
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Container extends AutoForm_Entity
{
    protected $template;             // reference na Smarty sablonu
    protected $container=array();    // pole vlozenych entit
    protected $result_data=array();  // pole vracenych zpracovanych (formularovych) dat po volani metody pregenerate()
    
    /**
     *
     * @param string $name nazev kontejneru (= nazev sekce v sablone)
     * @param object $template reference na Smarty objekt, pokud je uveden, provede se generovani do nej, pokud ne, provede se generovani do pole
     */
    public function __construct($name, $template=false) {
        parent::__construct($name);
        $this->template=$template;
    }

    /**
     * Umoznuje pristup ke svym ulozenym entitam jako k propertam.
     * @chainable
     */
    public function __get($key) {
        if(isset($this->$key)) return $this->$key;
        
        if(!key_exists($key, $this->container)) throw new Kohana_Exception("V kontejneru ".$this->entity_name." neexistuje vlozeny prvek nebo kontejner s nazvem ".$key."!");
        return $this->container[$key];
    }

    /**
     * Vlozi novou entitu do kontejneru (prvek/kontejner)
     * @param AutoForm_Entity $entity
     */
    public function add($entity)
    {
        $entity->parent_container=$this;
        $this->container[$entity->entity_name]=$entity;
    }

    /**
     * Pregenerovani dat, vraceni ziskanych formularovych hodnot z koncovych prvku (kontejner tato data standardne jen preposila vys)
     *
     * @param object $data_orm datovy objekt
     * @return array data z formularovych prvku (z koncovych elementu)
     */
    public function pregenerate($data_orm)
    {
         
        $result_data=array();
        foreach($this->container as $name=>$item)
        {
            $data=$item->pregenerate($data_orm);
            if(is_array($data))
            {
                $result_data=array_merge($result_data, $data); // navrat dat z vnoreneho kontejneru
            }else{
                $result_data[$name]=$data; // navrat dat z koncoveho prvku
            }
        }
        $this->result_data=$result_data;
        return $result_data;
    }

    /**
     * Generovani dat. Korenovy kontejner a kontejnery s nastavenou sablonou provedou vystup do sablony. Ostatni kontejnery, prvky provedou vystup do pole.
     * @param string $template Smarty view objekt
     * @return object
     */
    public function generate($data_orm)
    {
        $container_name=$this->entity_name;

        $result_array=array();
        foreach($this->container as $name => $entity)
        {
            $response=$entity->generate($data_orm);
            $result_array[$name] = $response;
            
//            // dodatecne vytazeni dat z MultipleContaineru
//            if($entity instanceof AutoForm_MultipleContainer) $this->result_data = $entity->get_result_data();
        }

        if($this->template)
        {
            $this->template->$container_name=$result_array;
            return $this->template;
        }else{
            return $result_array;
        }
    }

    /**
     * Metoda ktera vola pregenerate() a nasledne generate(), zpracovana data jsou nasledne pristupna metodou get_result_data()
     * @param object $data (ORM iterator)
     * @param object $template Smarty view objekt
     */
    public function generate_complete($data, $template)
    {
        $this->pregenerate($data);
        return $this->generate($template);
    }

    
    /**
     * Vrati zpracovana data.
     * @return array pole dat
     */
    public function get_result_data()
    {
        return $this->result_array;
    }

}