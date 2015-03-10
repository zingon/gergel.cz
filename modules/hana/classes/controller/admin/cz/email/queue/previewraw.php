<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Preview emailu - prizpusoben do otevreni do samostatneho okna
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2011 Pavel Herink
 */

class Controller_Admin_Cz_Email_Queue_Previewraw extends Controller_Hana_Auth
{
 
    public function action_index()
    {
       $email_queue=orm::factory("email_queue",$this->item_id);
       $email_queue_body=$email_queue->email_queue_body;
       $this->request->response=$email_queue_body->queue_body;
    }
    
    public function after(){}
    
   
}
?>
