<?php defined('SYSPATH') or die('No direct script access.');

/**
 * By Pavel Herink 2012
 * Vlozi get parametry s bezpecnostnim kodem pro vyvolani specificke akcni metody.
 * {hana_secured_get action="obsluzna_akce_kontroleru" [module="nazev_kontoleru"] }
 *  pokud neni uveden parametr "module" bere se aktualni kontroler (obsluzna akcni metoda je ve stejnem kontroleru)
 * 
 * @param <type> $params
 * @param <type> $smarty
 */
function smarty_function_hana_secured_get($params, &$smarty)
{  
    $controller=!empty($params["module"])?$params["module"]:null;
    $action=$params["action"];
    
    if(!$controller) $controller=Hana_Application::instance()->get_main_controller();
    
    $secure_code = Hana_Application::instance()->create_data_manipulation_secure_code($action, $controller);
    
    return ("h_module=$controller&h_action=$action&h_secure=$secure_code");
    
       
}
?>