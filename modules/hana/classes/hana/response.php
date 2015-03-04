<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Objektov data - holder pro stavove-informacni data "data kontroleru"
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Hana_Response
{
    private static $instance;
    
    private $status=null;    // boolean
    private $message=array();   // array(msg_type=>message_string)
    private $errors=array();
    private $data=array();
    private $redirect;  // redirect_string
    
    const MSG_ERROR = "error";
    const MSG_INFO = "info";
    const MSG_PROCESSED = "processed";
    
    /**
     *
     * @return Hana_Response
     */
    public static function instance()
    { 
            if (self::$instance === NULL) {
                self::$instance=new Hana_Response;
            }
            
            return self::$instance;
    }
    
    /**
     * Vysledek operace data kontroleru;
     * @return boolean 
     */
    public function get_status()     
    {
        $sess_stat= Session::instance()->get("hana_status", array());
        if(!empty($sess_stat)) $this->status=$sess_stat;
        return $this->status;
    }
    
    /**
     * Nastaveni vysledku data kontroleru.
     * @param boolean $status 
     */
    public function set_status($status)
    {
        $this->status = $status;
        Session::instance()->set("hana_status", $this->status);
    }
    
    /**
     * Vrati boolean hodnotu, zda pouzit pro inicializaci hlavniho kontroleru presmerovani. (bollean, nebo string)
     * @return boolean/string 
     */
    public function get_redirect()
    {
        return $this->redirect;
    }
    
    /**
     * Nastavi presmerovani.
     * @param type $redirect 
     */
    public function set_redirect($redirect)
    {
        $this->redirect = $redirect;
        $this->process_messages();
    }

    /**
     * Nastavi zpravu z data kontroleru.
     * @param string $message
     * @param type $msg_type 
     */    
    public function set_message($message, $msg_type=false)     
    {
        $this->message = $msg_type?array($msg_type=>$message):$message;
        $this->process_messages();
    }
    
    /**
     * Ziska zpravu z data kontroleru.
     * @param type $msg_type
     * @return type 
     */
    public function get_message($msg_type=false)     
    {
         $sess_msg= Session::instance()->get("hana_message", array());
         if(!empty($sess_msg)) $this->message=$sess_msg;
         
         if($msg_type)
         {
             return $this->message[$msg_type];
         }
         else
         {
             return $this->message;
         }
    }
    
    /*
     * Vymaze vsechny zpravy z data kontroleru.
     */
    public function delete_messages()
    {
        $this->message=array();
        Session::instance()->delete("hana_message");
    }
    
    /**
     * Ziska zpravy z data kontroleru a smaze je.
     * @param type $msg_type
     * @return string 
     */
    public function get_and_delete_message($msg_type=false)
    {
        $response=$this->get_message($msg_type);
        $this->delete_messages();
        return $response;
    }
    
    private function process_messages()
    {
        if($this->redirect)
        {
            Session::instance()->set("hana_message", $this->message); 
            Session::instance()->set("hana_status", $this->status); 
        }
        else
        {
            Session::instance()->delete("hana_message");
            Session::instance()->delete("hana_status");
        }
    }
    
    public function get_errors()     
    {
        return $this->errors;
    }

    public function set_errors($errors)
    {
        $this->errors = $errors;
    }
    
    public function get_data()     
    {
        return $this->data;
    }

    public function set_data($data)
    {
        $this->data = $data;
    }




}

?>
