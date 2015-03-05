<?php 

/**
 * 
 * {input}
 *
 * @param <type> $params
 * @param <type> $smarty
 */
function smarty_function_input(array $params, Smarty_Internal_Template $template)
{
    return __($params["str"]);   
}
?>
