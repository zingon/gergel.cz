<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Zakladni kontroler pro editaci zaznamu - sablona.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

abstract class Controller_Hana_Default extends Controller_Hana_Auth
{
    public $template="admin/admin_content";

    public function before() {
        parent::before();

        // reset nastaveny verze z editu, pokud byla
        Session::instance()->set("admlang","");

        $content_template=new View("admin/homepage");

        if(isset($_GET["message"])) $content_template->message=$_GET["message"];
        if(isset($_GET["error_rows"])) $content_template->error_rows=$_GET["error_rows"];

        $this->template->admin_content=$content_template;
    }
}

