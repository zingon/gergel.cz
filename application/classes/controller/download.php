<?php defined('SYSPATH') or die('No direct script access.');

/**
* 
*/
class Controller_Download extends Controller
{

	public function action_index()
    {
        $template = new View("download/detail");
        $route_id = $route_id=$this->application_context->get_actual_route();
       	$template->item = Service_Download::get_page_by_route_id($route_id);
       	$template->files = Service_Download::get_files_by_page_id($this->application_context->get_actual_language_id(),$template->item['id']);
        $this->request->response=$template->render();
    }
}

