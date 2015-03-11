<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Registr Widgetů.
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Hana_Widgets
{
    private static $instance;
    
    private $widgets_to_process=array();
    private $widgets_to_assign=array();
    
//    private $set_to_process=array();
    
    /**
     *
     * @return Hana_Widgets
     */
    public static function instance()
    { 
            if (self::$instance === NULL) {
                self::$instance=new Hana_Widgets();
            }
            
            return self::$instance;
    }
    
    private function __construct()
    {
    }
    
    /**
     * Prida widget do registru ke zpracovani.
     * @param string $widget_name
     * @param string $widget_path 
     */
    public function add_to_process($widget_name,$widget_path)
    {
        $this->widgets_to_process[ucfirst($widget_name)."Widget"]=$widget_path;
    }
    
    
    /**
     * Vrati pole vystupu z widgetu, ktere byly oznaceny ke zpracovani.
     * @param array/string $set_to_procces manualni urceni jmen(-a) widgetu ke zpracovani
     * @return type 
     */
    public function process($set_to_procces=null)
    {
        foreach($this->widgets_to_process as $widget_name=>$widget_path)
        {
            $widgets_response[$widget_name]=Request::factory($widget_path)->execute()->response;
        }
        return $widgets_response;       
    }
    
    /**
     * Dynamicky priradi widgetu obsluzny kontroler s metodou (dle url).
     * @param string $widget_name
     * @param string $widget_url 
     */
    public function assign($widget_name, $widget_url)
    {
        $this->widgets_to_assign[$widget_name]=$widget_url;
    }
    
    /**
     * Dynamicky odstrani widget.
     * @param string $widget_name 
     */
    public function remove($widget_name)
    {
        $this->widgets_to_assign[$widget_name]=false;
    }
    
    /**
     *
     * @param string $widget_name
     * @return boolean 
     */
    public function is_assigned($widget_name)
    {
        if(isset($this->widgets_to_assign[$widget_name])) return true; else return false;
    }
    
    /**
     * Vraci dynamicky prirazene url widgetu.
     * @param string $widget_name
     * @return string/false 
     */
    public function get_assigned($widget_name)
    {
        if(isset($this->widgets_to_assign[$widget_name])) return($this->widgets_to_assign[$widget_name]);else return false;    
    }
    
    
    
}

?>
