<?php defined('SYSPATH') or die('No direct script access.');

/**
 * By Pavel Herink 2012
 * Vlozi hidden prvky s bezpecnostnim kodem pro vyvolani specificke akcni metody. Pro formular s vice submity.
 * {hana_secured_multi_post action="obsluzna_akce_kontroleru" [submit_name = ""] [module="nazev_kontoleru"] }
 *  pokud neni uveden parametr "submit_name" - vezme se hodnota "action"
 *  pokud neni uveden parametr "module" bere se aktualni kontroler (obsluzna akcni metoda je ve stejnem kontroleru)
 * 
 * @param <type> $params
 * @param <type> $smarty
 */
function smarty_function_hana_secured_multi_post($params, &$smarty)
{
    $action=$params["action"];
    $submit_name=!empty($params["submit_name"])?$params["submit_name"]:$action;
    $controller=!empty($params["module"])?$params["module"]:null;
    
    if(!$controller) $controller = Hana_Application::instance()->get_main_controller();
    $secure_code = Hana_Application::instance()->create_data_manipulation_secure_code($action, $controller);
    
    return ("
    <input type=\"hidden\" name=\"h_module[$submit_name]\" value=\"$controller\" /> \n
    <input type=\"hidden\" name=\"h_action[$submit_name]\" value=\"$action\" /> \n
    <input type=\"hidden\" name=\"h_secure[$submit_name]\" value=\"$secure_code\" /> \n
           ");
    
       
}
?>