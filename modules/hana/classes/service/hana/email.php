<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Servisni trida obsluhujici obecne pozadavky na praci s emaily.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Service_Hana_Email{

    private static $default_html_email=true;
    private static $WordWrap = 50;            //  zalomení (po x znacích)
    private static $CharSet = "utf-8";

    
    
    /**
     * Zpracovani emailu podle nastavenych pravidel e-mail do fronty pro odeslani. Metoda vyuziva Email_Queue_Model;
     * 
     * @param string $message telo zpravy
     * @param string $message_code typ zpravy
     * @param string $mail_to_email e-mailova adresa prijemce
     * @param string $mail_to_name jmeno prijemce
     * $param array $data pole doplnujicich dat (podle db tabulky email_queue)
     * @return boolean priznak uspesneho ulozeni, pripadna chyba dostupna pres getMailError()
     */
    public static function process_email($message, $message_code ,$mail_to_email="", $mail_to_name="", $data=array())
    {
        $message_type=orm::factory("email_type")->where("code","=",$message_code)->find();

        if(!$message_type->code)
        {
           Kohana_Log::instance()->add("error", 'Neplatný (nepřiřazený) kód emailu: '.$message_code);
           return false;
        }
        
        // rozeslani emailu na vsecky adresy
        $receivers=array();
        if($mail_to_email) $receivers[]=array("name"=>$mail_to_name,"email"=>$mail_to_email);
        foreach($message_type->email_receivers->find_all() as $copy_receiver)
        {
            if($copy_receiver->email) $receivers[]=array("name"=>$copy_receiver->nazev,"email"=>$copy_receiver->email);
        }

        if(empty($receivers))
        {
            Kohana_Log::instance()->add("error", 'Chyba nejsou nastaveni příjemci k typu emailu: '.$message_code);  
            return false;
        }

        if($message_type->use_email_queue || $message_type->send_by_cron)
        {
            $message_type->use_email_queue=1;
            $email_queue = orm::factory("email_queue");
            // zalozeni zaznamu o zprave
            $data["queue_body"]=$message;
            $data["queue_subject"]=(isset($data["subject"]))?$data["subject"]:$message_type->subject;
            $data["queue_from_email"]=!empty($data["queue_from_email"])?$data["queue_from_email"]:$message_type->from_email;
            $data["queue_from_name"]=!empty($data["queue_from_name"])?$data["queue_from_name"]:$message_type->from_nazev;
            $data["queue_html"]=isset($data["is_html"])?$data["is_html"]:self::$default_html_email;
            $data["queue_send_by_cron"]=$message_type->send_by_cron;
            $data["queue_attached_file"]=isset($data["file_attachment"])?$data["file_attachment"]:null;
                
            $email_queue_id=$email_queue->addNewRecordToQueue($data);            
        }
        
        foreach($receivers as $receiver)
        {
            // zapsani do fronty
            if($message_type->use_email_queue && $email_queue_id)
            {
                $data["queue_to_email"]=$receiver["email"];
                $data["queue_to_name"]=$receiver["name"];
                $eq_id=$email_queue->addNewReceiverToQueue($email_queue_id, $data);    
            }
            
            if(!$message_type->send_by_cron && $message_type->use_email_queue)
            {
                $from_email=($message_type->from_email)?$message_type->from_email:(isset($data["queue_from_email"])?$data["queue_from_email"]:"");
                $from_nazev=($message_type->from_nazev)?$message_type->from_nazev:(isset($data["queue_from_name"])?$data["queue_from_name"]:"");    
                //zkouska odeslani
                
                $mail_error=self::send_mail($message, $data["queue_subject"], $receiver["email"], $receiver["name"],$from_email, $from_nazev, $data); 
                if($mail_error===true)
                {
                    $email_queue->setSendFlag($eq_id);
                }
                elseif(!empty($mail_error))
                {
                    $email_queue->setErrorFlag($eq_id, $mail_error);
                    //die($message."-".$data["queue_subject"]."-".$receiver["email"]."-".$receiver["name"]."-".$message_type->from_email."-".$message_type->from_nazev."-".$data);
                    //die(print_r($data));
                }  
            }
        }
        
        return true;
    }
    
    /**
     * Primo odesle e-mail dle nastaveneho STMP.
     * @param string $message telo zpravy
     * @param string $subject predmet zpravy
     * @param string $mail_to_email e-mailova adresa prijemce
     * @param string $mail_to_name jmeno prijemce
     * @param string $from_email e-mailova adresa odesilatele
     * @param string $from_name jmeno odesilatele
     * @param string $data dodatecna data
     * @return boolean priznak uspesneho ulozeni, , pripadna chyba dostupna pres getMailError()
     */
     public static function send_mail($message,$subject,$mail_to_email,$mail_to_name,$from_email, $from_name, $data){
        include_once("modules/hana/external_libraries/PHPMailer/class.phpmailer.php");
        $mail = new Phpmailer(true); // true - vyhazuje vyjimku i kvuli externim chybam

        try {
        $mail_settings=orm::factory("email_settings",1);  
        if($mail_settings->mailer=="smtp")
        {
            $mail->IsSMTP();
        }
        
        $mail->Host     = $mail_settings->host;
        $mail->SMTPAuth = $mail_settings->SMTPAuth;
        $mail->Username = $mail_settings->username;
        $mail->Password = $mail_settings->password;
        $mail->From     = $from_email;
        $mail->FromName = $from_name;
        $mail->Priority = isset($data["priority"])?$data["priority"]:2;

        $mail->AddAddress($mail_to_email, $mail_to_name);  // příjemce, včetně jména
        if(isset($data["file_attachment"]) && $data["file_attachment"]) $mail->AddAttachment($data["file_attachment"]);
        //$mail->AddAttachment($path);
        $mail->IsHTML(isset($data["is_html"])?$data["is_html"]:self::$default_html_email);
        $mail->Subject = $subject;
        $mail->Body = $message;
        if(isset($data["is_html"])?$data["is_html"]:self::$default_html_email); 
        $mail->WordWrap = self::$WordWrap;
        $mail->CharSet = self::$CharSet;

        $mail->Send();

        } catch (phpmailerException $e) {
          $mailError = $e->errorMessage();
         
          return $mailError;
        } catch (Exception $e) {
          $mailError = $e->getMessage();
          return $mailError;
        }
        return true;
    } 
    
    /**
     * Zasle neposlane polozky z fronty_emailu
     * @param type $max_items maximalni pocet emailu, ktere budou zaslany
     */
    public static function send_stored_emails_from_queue($max_items)
    {
        
    }
    
    /**
     * Znovuzaslani mailu na vyzadani.
     * @param array $email_queue_ids 
     */
    public static function resend_mail_from_queue(array $email_queue_ids)
    {
    
        foreach($email_queue_ids as $eq_id)
        {
            $email_queue=orm::factory("email_queue", $eq_id);
            $email_queue_body=$email_queue->email_queue_body;
            
            $data=$email_queue->as_array(); //TODO
            
            $result=self::send_mail($email_queue_body->queue_body, $email_queue_body->queue_subject, $email_queue->queue_to_email, $email_queue->queue_to_email, $email_queue_body->queue_from_email, $email_queue_body->queue_from_name, $data); 
            
            if($result===true)
            {
                $email_queue->setSendFlag($eq_id);
            }
            else
            {
                $email_queue->setErrorFlag($eq_id, $result);
            }
        }    
    }


    
    /**
     * @deprecated
     * Pokud se e-mail nepodarilo zaslat tato funkce vraci chybovou zpravu.
     * @return string chybova zprava
     */
    public static function get_mail_error() {
        return "";
    }

}
?>

