<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Prelozi zadany string podle tabulky i18n v Kohane (aktualni jazyk se zvoli automaticky)
 * {translate str="..."}
 *
 * @param <type> $params
 * @param <type> $smarty
 */
function smarty_function_translate($params, &$smarty)
{
    return __($params["str"]);   
}
?>
