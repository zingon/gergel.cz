<?php
/**
 * Smarty {mailto} function plugin
 *
 * Type:     function<br>
 * Name:     static_content<br>
 * Date:     Jan 10, 2011
 * Purpose:  Kohana 3 automatic static page loading (via HMVC request).<br>
 * Input:<br>
 *         - code = static content code
 *
 * Examples:
 * <pre>
 * {static_content code="index-kontakty"}
 * </pre>
 * @version  1.0
 * @author   Pavel Herink
 * @param    array
 * @param    Smarty
 * @return   string
 */
function smarty_function_static_content(array $params, Smarty_Internal_Template $template)
{
    return (Request::factory("internal/page/static/".$params["code"])->execute()->response);
}


?>
