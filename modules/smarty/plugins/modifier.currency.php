<?php
/**
* Currency smarty modifier.
* Autor: Pavel Herink
*
* Example
*   <!--[$myvar|currency:'cz']-->
* 
* @author       Erik Spaan [espaan]
* @since        11/12/2008
* @param        array    $string       The contents to transform
* @param        string   $type         Type (abbreviation: cz, eur, us, en)
* @return       string   the modified output
*/
function smarty_modifier_currency($string, $type="cz", $decimals=0)
{
    switch ($type) {
            case "cz":
                return((number_format($string, $decimals, ',', ' '))." Kč");
                break;
                
            case "eur":
                // TODO
                ;
                break;
                
            case "us":
                // TODO
                ;
                break;
                
            default:
                return($string);
                break;
        }
}
?>