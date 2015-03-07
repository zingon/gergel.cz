<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generovani statickych obsahovych stranek a textu.
 */
class Controller_Reference extends Controller {


	public function action_index() {
		$reference = new View('reference/index');
		$reference->page= Service_Page::get_page_by_route_id($this->application_context->get_actual_route());
		$reference->items = Service_Reference::get_reference_list($this->application_context->get_actual_language_id());
		$this->request->response=$reference->render();
    }

    public function action_detail()
    {
    	$reference = new View('reference/detail');
    	$reference->item = Service_Reference::get_reference_by_route_id($this->application_context->get_actual_route());
    	$this->request->response=$reference->render();
    }
}