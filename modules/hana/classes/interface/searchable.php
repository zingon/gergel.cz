<?php

/**
 * Rozhranní pro implementaci vyhledávání.
 * @author Pavel
 */
interface Interface_Searchable
{
    /**
     * Implementace vyhledavani v jednotlivych modulech, vraci konfiguracni pole.
     * napr.:
     * return array(

                  "title"=>"Výsledky ve stránkách",
                  "display_title"=>"page_data.nazev",
                  "display_text"=>"page_data.popis",
                  "search_columns"=>array("page_data.nazev", "page_data.popis", "page_data.uvodni_popis"),    
        );
     */
    public static function search_config(); 
}

?>
