<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Zakladni stavebni prvek knihovny AutoForm (pro kontejnery stromove struktury a koncove listy)
 *
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
abstract class AutoForm_Entity
{
    public $parent_container;   // reference na rodicovsky kontejner kde je prvek umisten
    protected $entity_name;        // nazev prvku

    public function __construct($name)
    {
        $this->entity_name=$name;
    }
    
    /**
     * Provede "predgenerovani" dat - standardne kazdy formularovy koncovy prvek si z pole $_POST($_GET) zjisti vlastni hodnotu,
     * pripadne ji zformatuje a vyfiltruje (XSS) a vrati ji v poli pod svym nazvem. Mozne dalsi akce pro inicializaci objektu (k dispozici ORM objekt).
     * Kontejnery deleguji tutu funkci dal na sve vnorene polozky.
     *
     * @param object $data_orm datovy objekt
     * @return array pole vracenych dat
     */
    abstract function pregenerate($data_orm);

    /**
     * Provede generovani dat - na zaklade datoveho objektu se prvky vyplni provede se graficky vystup do sablony.
     * Kontejnery deleguji tutu funkci dal na sve vnorene polozky.
     *
     * @param object $data_orm datovy objekt
     * @return string
     */
    abstract function generate($data_orm);


    public function __get($key)
    {
            return isset($this->$key) ? $this->$key : NULL;
    }
    

}
?>
