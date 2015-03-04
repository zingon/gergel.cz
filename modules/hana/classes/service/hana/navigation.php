<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Servisa pro obsluhu hlavni navigace (soucasne vygeneruje zaklad drobitkove navigace) a statickych stranek.
 *
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Service_Hana_Navigation extends Service_Hana_Module_Base
{
    public static function get_navigation_structure($module, $category_id, $language_id = 1)
    {

    }

    /**
     * Automaticky najde cely retezec
     *
     * @param type $nazev_seo
     */

    public static function get_navigation_breadcrumbs($nazev_seo, $actual_module)
    {
        // kazdy modul na ktery vede routa musi mit obsluznou metodu pro zpracovani vlastni casti navigace


    }
}

?>





