<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Upraveny vychozi kontroler.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller extends Kohana_Controller
{
    protected $allow_external_request = false;
    
    /**
     *
     * @var Hana_Application
     */
    protected $application_context;
    
    /**
     *
     * @var Hana_Response
     */
    protected $response_object;

     public function before()
     {
            parent::before();
            if (!$this->allow_external_request && $this->request == Request::instance()) 
            {
                throw new Kohana_Exception("externí request není povolen");
            }
            
            $this->application_context=Hana_Application::instance();
            $this->response_object=Hana_Response::instance();
    }


}

?>
