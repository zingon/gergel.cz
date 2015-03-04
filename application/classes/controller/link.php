<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Controller_Link extends Controller
{
    public function action_index()
    {
        $route_id=$this->application_context->get_actual_route_id();
        $page=Service_Page::get_page_by_route_id($route_id);
        Request::instance()->redirect($page["url"]);
    }
    
}
?>
