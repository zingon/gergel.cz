<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace produktu - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Environment_Module_Default extends Controller_Hana_Auth
{
    
    public function action_index()
    {
        $this->template->admin_content="Vítejte v administračním rozhranní";
        

    }

}

?>