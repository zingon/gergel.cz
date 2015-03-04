<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Servisni trida obsluhujici zpracovani a odeslani (kontaktnich) formularu na verejne casti
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Service_Hana_Forms
{
    public static function generate_captcha(){
        $captcha = new Captcha;
        return $captcha->render(true);

    }

    public static function validate_captcha($input){
        return Captcha::valid($input);
    }

    public static function make_secure($data)
    {
        foreach($data as $key=>$value)
        {
            if (is_array($value))
                $data[$key] = self::make_secure($value);
            else
                $data[$key] = strip_tags($value);
        }

        return $data;
    }
    
    /**
     * Metoda obsluhujici validaci a posilani formulare.
     * @param array $form_data data z formulare
     * @param string $form_code typ formulare (na zaklade tohoto jednotneho atributu se urci model pro validaci, sablona i typ formulare) napr: Model_Email_Form_[Contact], emails/contact.tpl, typ emailu "form_contact" 
     * @param string $response_object Hana_Response response objekt 
     * @param string $mail_to_email e-mail pokud je potreba zaslat dynamicky na specifickou adresu (uvedenou v formulari)
     * @param string $mail_to_name jmeno pokud je potreba zaslat dynamicky na specifickou adresu (uvedenou v formulari)
     * @param string $sender_email e-mail pokud je potreba dynamicky zadat email odesilatele
     * @param string $sender_name jmeno pokud je potreba dynamicky zadat jmeno odesilatele
     * $param array $data pole dodatecnych dat
     * @return boolean 
     */
    public static function send_default_form($form_data, $form_code, Hana_Response $response_object, $mail_to_email="", $mail_to_name="", $sender_email="", $sender_name="", $data=array()){

        $form_orm = orm::factory("Email_Form_".ucfirst($form_code));
        
        // nejprve validace dat
        if(!$form_orm->check($form_data)){
            $response_object->set_errors(array($form_code=>$form_orm->validate()->errors('form_errors')));
            $response_object->set_data($form_data);
            $response_object->set_status(false);
            return false;
        }else{
            // validace probehla - sestaveni e-mailu
            $mail_template = new View("emails/".$form_code);

            $form_data = self::make_secure($form_data);

            $mail_template->data = $form_data;
            $message = $mail_template->render();
            if(!empty($sender_email)) $data["queue_from_email"] = $sender_email;
            if(!empty($sender_name)) $data["queue_from_name"] = $sender_name;

            $result = Service_Email::process_email($message, "form_".$form_code, $mail_to_email, $mail_to_name, $data);

            if($result)
            {
                $response_object->set_status(true);
                return true;
            }
            else
            {
                $response_object->set_status(false);
                //Kohana::$log->add(Log::ERROR, "Chyba zaslání e-mailu (podrobnosti v email_queue)")->write();
                Kohana_Log::instance()->add("error", 'Chyba zaslání e-mailu');
                return false;
            }
        }
    }
}

?>
