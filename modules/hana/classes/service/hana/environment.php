<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Servisni trida pro obsluhu zakladniho nastaveni projektu.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2013 Pavel Herink
 */
class Service_Hana_Environment
{
   
    /**
     * Provede inicializaci vybranych modulu - vyvola metodu module_setup() v hlavnich servisach (je-li implementovana)
     * Slouzi zejmena pro vlozeni zakladnich rout a inicializaci jinych zdroju.
     * 
     * @param int $modules_id 
     */
    public static function modules_setup($modules_id)
    {
        
    } 
    
    /**
     * Vygeneruje kostru (soubory) modulu dle zadanych dat.
     * @param array $data 
     */
    public static function module_create($data)
    {
        // TODO:
        // vygenerovani kontroleru
        
        // vygenerovani servisni tridy
        
        // vygenerovani modelu
        
        // vygenerovani databazovych tabulek
    }
    
    
}
?>