<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Zakladni administracni kontroler - sestavi stranku na zaklade obdrzeneho pozadavku. Provede volani na sub-kontrolery.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class Controller_Admin_Site extends Controller_Template
{
    public $template = 'admin/base_template';

    public function before() {
        parent::before();
        // TODO overeni - autentizace

    }

    public function action_index()
    {
        $ajax_element=isset($_GET["ajaxelement"])?$_GET["ajaxelement"]:isset($_POST["ajaxelement"])?$_POST["ajaxelement"]:false;
        $admin_service = new Service_Administrator();

        // sestaveni okno adminu z jednotlivych casti:

        // 1) vygenerovani hlavni navigace:
        $main_menu = "";

        // 2) vygenerovani subnevigace
        $sub_menu = "";

        // 3) vygenerovani contentu - subrequest
        $content = Request::factory("hanaAdmin/".$admin_module_controller)->execute()->response;

        // posklada


    }

}
?>
