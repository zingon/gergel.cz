<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Zakladni polozka (sablona polozky) kontejneru AutoForm.
 * 
 * DEPRECATED !!!!
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
abstract class AutoForm_ItemHTML extends AutoForm_Item
{
    
    /**
     *
     * @var string popis prvku
     */
    public $label;

    /**
     *
     * @var array atributy HTML elementu
     */
    public $HTML=array();

    /**
     * Priznak agregovaneho prvku - urcuje, chovani v pripade, ze se ten samy prvek bude vyskytovat na strankach vicekrat pod stejnym nazvem.
     * @var boolean
     */
    public $aggregated_item=false;


    
    public function html(array $html)
    {
        $this->HTML=array_merge($this->HTML, $html);
        return $this;
    }

    public function tag_class($class)
    {
        $this->HTML["class"]=$class;
        return $this;
    }

    public function width($width)
    {
        $this->HTML["style"]="width: ".$width."px; ";
        return $this;
    }

    public function label($label)
    {
        $this->label=$label;
        return $this;
    }

    
    

}
?>
