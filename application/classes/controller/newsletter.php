<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Controller_Newsletter extends Controller
{
    public function action_index()
    {
        
    }
    
    public function action_widget()
    {
        $newsletter=new View("newsletter_widget");
        $data=$this->response_object->get_data();
        $newsletter->sender_email=!empty($data["sender_email"])?$data["sender_email"]:"";
        $this->request->response = $newsletter->render();
    }
    
    public function action_subscribe_to_newsletter($on_success_redirect_to="")
    {
        $sender_email=Input::post("newsletter_email");
       
       // nesmi byt vyplneno, nebo je to robot
        if(!empty($_POST["kontrolni_cislo"])) return;
        
        $result=Service_Newsletter::subscribe_to_newsletter($sender_email);
        
        if($result){
            $this->response_object->set_redirect(url::base());
            $this->response_object->set_message(__("Děkujeme, Vaše e-mailová adresa byla zaregistrována pro zasílání novinek"), Hana_Response::MSG_PROCESSED);
            $this->response_object->set_redirect(url::base().$this->application_context->get_actual_seo());
        }else{
            $this->response_object->set_redirect=false;
            $this->response_object->set_message(__("Chyba, email má špatný tvar, nebo již existuje."), Hana_Response::MSG_ERROR);
            $this->response_object->set_data(array("sender_email"=>$sender_email));
        }
    }
    
    
    public function action_unsubscribe_to_newsletter()
    {
        $email_hash=Input::get("user_h",false);
        if($email_hash)
        {
            $response = Service_Newsletter::unsubscribe_to_newsletter($email_hash);
        }
        else
        {
            $response = false;
        }
        
        $this->response_object->set_redirect(url::base().__("odhlaseni-z-newsletteru"));
        
        if($response)
        {
            $this->response_object->set_message(__("Byli jste úspěšně odhlášeni z odběru novinek"), Hana_Response::MSG_PROCESSED);
        }
        else
        {
            $this->response_object->set_message(__("Došlo k chybě při odhlašování z odběru novinek. K vyřešení tohoto problému nás prosím kontaktujte."), Hana_Response::MSG_ERROR);
        } 
        
        Request::instance()->redirect(url::base().__("odhlaseni-z-newsletteru"));
        return;
        exit();
    }
    
    public function action_send_newsletters()
    {
        $no_of_items=Input::get("items",10000);
        $newsletter_id=Input::get("newsletter_id", false);
        return Service_Newsletter::send_newsletters($no_of_items, $newsletter_id);
        exit();
    }
    
    
}
?>