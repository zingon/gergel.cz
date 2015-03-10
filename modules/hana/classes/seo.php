<?php defined('SYSPATH') OR die('No direct access allowed.');

class seo{

  public static function StripDiacritic($string, $german=false) {
   // Single letters
   $single_fr = explode(" ", "Ť Ŕ Á Â Ă Ä Ĺ &#260; &#258; Ç &#262; &#268; &#270; &#272; Đ Č É Ę Ë &#280; &#282; &#286; Ě Í Î Ď &#304; &#321; &#317; &#313; Ń &#323; &#327; Ň Ó Ô Ő Ö Ř &#336; &#340; &#344; Š &#346; &#350; &#356; &#354; Ů Ú Ű Ü &#366; &#368; Ý Ž &#377; &#379; ť ŕ á â ă ä ĺ &#261; &#259; ç &#263; &#269; &#271; &#273; č é ę ë &#281; &#283; &#287; ě í î ď &#305; &#322; &#318; &#314; ń &#324; &#328; đ ň ó ô ő ö ř &#337; &#341; &#345; &#347; š &#351; &#357; &#355; ů ú ű ü &#367; &#369; ý ˙ ž &#378; &#380;");
   $single_to = explode(" ", "T A A A A A A A A C C C D D D C E E E E E G E I I D I L L L N N N N O O O O R O R R S S S T T U U U U U U Y Z Z Z t a a a a a a a a c c c d d c e e e e e g e i i d i l l l n n n o n o o o o r o r r s s s t t u u u u u u y y z z z");
   $single = array();
   for ($i=0; $i<count($single_fr); $i++) {
       $single[$single_fr[$i]] = $single_to[$i];
   }
   // Ligatures
   $ligatures = array("Ć"=>"Ae", "ć"=>"ae", "Ś"=>"Oe", "ś"=>"oe", "ß"=>"ss");
   // German umlauts
   $umlauts = array("Ä"=>"Ae", "ä"=>"ae", "Ö"=>"Oe", "ö"=>"oe", "Ü"=>"Ue", "ü"=>"ue");
   // Replace
   $replacements = array_merge($single, $ligatures);
   if ($german) $replacements = array_merge($replacements, $umlauts);
   $string = strtr($string, $replacements);
   return $string;
	}
  
 public static function uprav_fyzicky_nazev($nazev)
      {
       if(!isset($nazev)) return false;

       $nazev = self::uprav_fyzicky_nazev_souboru($nazev, ".");
       return($nazev);
      }
  
  public static function uprav_fyzicky_nazev_souboru($nazev, $znak="")
  {
   if(!isset($nazev)) return false;
  
   $nazev = trim($nazev);
  
   // nyní zlikvidujeme nebezpečné koncovky (a v podstatě pak všechny odstraněním tečky níže)   
   $_badsigns = Array('\'','{','+','=',')','(','*','!','@','$','%','#',"\\",'}','[',']','<','>','|','/',',','?','§',';','~','&','^',':','´',"\"","„","“",$znak);
   $nazev = str_replace($_badsigns,"",$nazev);
   $nazev = str_replace(" ","-",$nazev);
   $nazev = self::StripDiacritic($nazev);
   $nazev = strtolower($nazev);
   
   return($nazev);
  }
}
?>
