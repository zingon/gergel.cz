<?php defined('SYSPATH') or die('No direct access allowed.');

abstract class Auth extends Kohana_Auth
{

    const READ=1;
    const WRITE=2;

    /**
     * Testuje, zda ma uzivatel opravneni pro operaci v danem modulu. TODO
     * @param <type> $module_code
     * @param <type> $submodule_code
     * @param <type> $module_controller
     */
    public function user_action_authorization($module_code,$submodule_code,$module_controller)
    {
       return self::WRITE;
    }

}
?>
