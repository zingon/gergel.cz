<?php

/**
 * Rozhranní pro implementaci vyhledávání.
 * @author Pavel
 */
interface Interface_Navigable
{
    /**
     * Metoda na vygenerovani navigacni struktury.
     * 
     * @param type $language_id
     * @param type $category - typ navigace 
     * @param type $max_levels - maximum generovanych urovni
     * @param type $breadcrumbs $breadcrumbs aktualni cesta (vygeneruje pouze vetve, ktere jsou v ramci retezce zvolene cesty)
     * @param type $parent_id pomocna promenna
     * @param type $counter pomocna promenna
     * @return type 
     */
    public static function get_navigation($language_id,$category=0,$max_levels=false,$breadcrumbs=array());
    
    /**
     * Metoda pro vygenerovani drobitkove navigace dle koncoveho sea.
     * @param type $nazev_seo
     * @return array 
     */
    public static function get_navigation_breadcrumbs($nazev_seo);
}

?>

