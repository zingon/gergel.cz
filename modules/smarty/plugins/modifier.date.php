<?php
/**
* Specialni modifikator pro generovani datumu.
* Autor: Pavel Herink
*
* Example
*   <!--[$myvar|date:'cz']-->
* 
* @author       Erik Spaan [espaan]
* @since        11/12/2008
* @param        array    $string       The contents to transform
* @param        string   $type         Type (abbreviation: cz, eur, us, en)
* @return       string   the modified output
*/
function smarty_modifier_date($string, $type="cz")
{

    switch ($type) {
            case "cz":
            default:
                $time=strtotime($string);
                $dt_array=getdate($time);
                $dt_array_current=getdate();

                //if($dt_array["year"]==$dt_array_current["year"] && $dt_array["yday"]==$dt_array_current["yday"]) return "dnes";

                //if($dt_array["year"]==$dt_array_current["year"] && $dt_array["yday"]==$dt_array_current["yday"]-1) return "včera";

                return date("j.n.Y",$time);
                
                
                break;
                

        }
}
?>