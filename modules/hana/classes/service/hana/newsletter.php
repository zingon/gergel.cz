<?php defined('SYSPATH') or die('No direct script access.');


/**
 *
 *
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Service_Hana_Newsletter
{
    protected static $newsletter_message_code = "newsletter";
    protected static $secure_code="sdfsdfe"; // mente pouze pred spustenim aplikace do ostreho provozu!


    public static function subscribe_to_newsletter($email)
    {
       $newsletter_recipient = orm::factory("newsletter_recipient");
       $newsletter_recipient->email=$email;
       
       if($newsletter_recipient->check())
       {
           $duplicate=db::select("id")->from("newsletter_recipients")->where("email","=",$email)->execute()->get("id");
           
           if(empty($duplicate))
           {
               $newsletter_recipient->allowed=1;
               $newsletter_recipient->hash=md5(static::$secure_code.$email);
               $newsletter_recipient->save();
           }
           else
           {
           
               // znovu povolime jiz jednou zaregistrovany email
               db::update("newsletter_recipients")->set(array("allowed"=>1))->where("email","=",$email)->execute();
               //echo("duplicitní e-mail:".$email."<br />");
           }
           
           return true;
       }
       else
       {
           return false;
       }
    }
    
    public static function unsubscribe_to_newsletter($email_hash)
    {
        $newsletter_recipient = orm::factory("newsletter_recipient")->where("hash","=",$email_hash)->find();
        if($newsletter_recipient->id)
        {
            $newsletter_recipient->allowed=0;
            $newsletter_recipient->save();
            return true;
        }
            return false;
    }
    
    public static function create_newsletters($newsletter_id)
    {
        // zalozeni newsletteru a vlozeni do fronty - pro kompatibilitu bude obsluzny kod email_queue zde
        // todo pripadne vyresit jazykove verze - muselo by se rozdelit na vice email_queue_bodies... s vyuzitim queue_language_id
        $newsletter=orm::factory("newsletter")->where("newsletters.id","=",$newsletter_id)->where("zobrazit","=",1)->where("generovan","=",0)->find();
        
        if(!$newsletter->id) return false;
        
        $message_code=  static::$newsletter_message_code;
        $message_type=orm::factory("email_type")->where("code","=",$message_code)->find();
        
        if(!$message_type->code)
        {
           Kohana_Log::instance()->add("error", 'Neplatný (nepřiřazený) kód emailu: '.$message_code);
           return false;
        }
        
        // rozeslani emailu na vsecky adresy
        
        $receivers_orm=orm::factory("newsletter_recipient")->where("allowed","=",1)->find_all();
        
        $receivers=array();
        
        // registrovani adresati
        foreach($receivers_orm as $receiver)
        {
            $receivers[]=array("name"=>$receiver->email,"email"=>$receiver->email);
        }
        
        // admini
        foreach($message_type->email_receivers->find_all() as $copy_receiver)
        {
            if($copy_receiver->email) $receivers[]=array("name"=>$copy_receiver->nazev,"email"=>$copy_receiver->email);
        }        
        
//        if(empty($receivers))
//        {
//            Kohana_Log::instance()->add("error", 'Chyba nejsou nastaveni příjemci k typu emailu: '.$message_code);  
//            return false;
//        }
        
        $message=$newsletter->popis; // vlozime text bez sablony - dalsi veci se budou generovat az pri odeslani (pro kazdeho uzivatele zvlast)

        $message_type->use_email_queue=1;
        $email_queue = orm::factory("email_queue");
        // zalozeni zaznamu o zprave
        $data["queue_body"]=$message;
        $data["queue_subject"]=(isset($data["subject"]))?$data["subject"]:$message_type->subject."-".$newsletter->nazev;
        $data["queue_from_email"]=!empty($data["queue_from_email"])?$data["queue_from_email"]:$message_type->from_email;
        $data["queue_from_name"]=!empty($data["queue_from_name"])?$data["queue_from_name"]:$message_type->from_nazev;
        $data["queue_html"]=1;
        $data["queue_send_by_cron"]=$message_type->send_by_cron;
        $data["queue_newsletter_id"]=$newsletter_id;
        $email_queue_id=$email_queue->addNewRecordToQueue($data);            
        
        
        foreach($receivers as $receiver)
        {
            // zapsani do fronty
            $data["queue_to_email"]=$receiver["email"];
            $data["queue_to_name"]=$receiver["name"];
            $eq_id=$email_queue->addNewReceiverToQueue($email_queue_id, $data);    

            
            if(!$message_type->send_by_cron)
            {        
                self::send_newsletters(1000, $newsletter_id);
            }
        }
        
        $newsletter->generovan=1;
        $newsletter->save();
        
        return true;    
    }
    
    /**
     * Zasle dosud nezaslane newslettery.
     * @param type $no_of_items pocet polozek k zaslani
     * @param type $newsletter_id specifikace cisla newsletteru (nebude-li uvedeno posilaji se vsechny od nizsich cisel)
     */
    public static function send_newsletters($no_of_items=1000, $newsletter_id=false)
    {
        // zasleme nezaslane newslettery - chybove jiz znovu posilat nebudeme
        $email_queue=db::select("*")->select(array("email_queue.id","eq_id"))->from("email_queue")->join("email_queue_bodies")->on("email_queue.email_queue_body_id","=","email_queue_bodies.id")->join("newsletters")->on("email_queue_bodies.queue_newsletter_id","=","newsletters.id")
                ->where("queue_sent","=",0)->where("queue_errors_count","=",0)->where("newsletters.zobrazit","=",1); 
        if($newsletter_id)
        {
            $email_queue->where("queue_newsletter_id","=",$newsletter_id);
        }

        $email_queue=$email_queue->order_by("queue_newsletter_id","ASC")->limit($no_of_items)->as_object()->execute();
        
        
        $count=0;
        foreach($email_queue as $item)
        {
            $newsletter=new View("emails/newsletter/default");
            $newsletter->body=$item->queue_body;
            $newsletter->email_hash=md5(static::$secure_code.$item->queue_to_email);
            $message=$newsletter->render();
            
            $result=  Service_Email::send_mail($message, $item->queue_subject, $item->queue_to_email, $item->queue_to_email, $item->queue_from_email, $item->queue_from_name,array()); 
            
            if($result===true)
            {
                db::update("email_queue")->set(array("queue_sent"=>1,"queue_sent_date"=>date("Y-m-d H:i:s")))->where("id","=",$item->eq_id)->execute();
                $count++;
            }
            else
            {  
                db::update("email_queue")->set(array("queue_errors_count"=>1))->where("id","=",$item->eq_id)->execute();
            }
        }
        
        echo($count." newsletters successfully sent");
        exit();
    } 
}

?>