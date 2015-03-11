<?php defined('SYSPATH') or die('No direct script access.');

/**
 * By Pavel Herink 2012
 * Vlozi hidden prvky s bezpecnostnim kodem pro vyvolani specificke akcni metody. Pro formular s jednim submitem.
 * {hana_secured_post action="obsluzna_akce_kontroleru" [module="nazev_kontoleru"] }
 *  pokud neni uveden parametr "module" bere se aktualni kontroler (obsluzna akcni metoda je ve stejnem kontroleru)
 * 
 * @param <type> $params
 * @param <type> $smarty
 */
function smarty_function_hana_secured_post($params, &$smarty)
{
    $action=$params["action"];
    $controller=!empty($params["module"])?$params["module"]:null;
    
    if(!$controller) $controller = Hana_Application::instance()->get_main_controller();
    $secure_code = Hana_Application::instance()->create_data_manipulation_secure_code($action, $controller);
    
    return ("
    <input type=\"hidden\" name=\"h_module\" value=\"$controller\" /> \n
    <input type=\"hidden\" name=\"h_action\" value=\"$action\" /> \n
    <input type=\"hidden\" name=\"h_secure\" value=\"$secure_code\" /> \n
           ");
    
       
}
?>