<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Controller_Contact extends Controller
{
    /**
     * Zobrazi kontaktni formular (samostatna stranka vcetne formulare).
     */
    public function action_index()
    {
       $route_id=$this->application_context->get_route_id();
       $template=new View("contact/detail");
       $template->item=Service_Page::get_page_by_route_id($route_id);
       $this->request->response=$template->render(); 
    }
    
    /**
     * Zobrazi samostatny kontaktni formular.
     */
    public function action_show()
    {
       $form=new View("contact/form");
       $form->data=$this->response_object->get_data();
       $errors=$this->response_object->get_errors();
       $form->errors=!empty($errors["contact"])?$errors["contact"]:array();
       $form->send=$this->response_object->get_status();
       $this->request->response=$form->render();
    }
    
    public function action_send($on_success_redirect_to="")
    {
        // nesmi byt vyplneno, nebo je to robot
        if(!empty($_POST["kontrolni_cislo"])) return;
        
        $sender_email=!empty($_POST["contactform"]["email"])?$_POST["contactform"]["email"]:"";
        $sender_name =!empty($_POST["contactform"]["jmeno"])?$_POST["contactform"]["jmeno"]:$sender_email; 
        $form_data=$_POST["contactform"]; // strip tags probehne pri validaci modelu
        $form_data["nazev_projektu"]=$this->application_context->get_name();
        $form_data["nazev_stranky"]=$this->application_context->get_title();
        $form_data["url"]=$this->application_context->get_full_url();
         
        $result=Service_Forms::send_default_form($form_data, "contact", $this->response_object,"","",$sender_email,$sender_name);
        if($result){
            $this->response_object->set_redirect(!empty($on_success_redirect_to)?$on_success_redirect_to:true);
            $this->response_object->set_message(__("Zpráva z kontaktního formuláře byla zaslána"), Hana_Response::MSG_PROCESSED);
        }else{
            $this->response_object->set_redirect=false;
            $this->response_object->set_message(__("Chyba při zpracování zprávy. Zkontrolujte prosím zadané údaje."), Hana_Response::MSG_ERROR);
        }
    }
}

?>
