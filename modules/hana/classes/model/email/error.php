<?php defined('SYSPATH') or die('No direct script access.');

class Model_Email_Error extends Model
{
    private $send_to_email="pherink@seznam.cz";
    private $send_to_name="technická podpora";
    private $send_from_email;
    private $send_from_name;
    private $subject = 'Kontaktní formulář z www stránek';
    private $form_errors;
    private $form_data=array();

    private $post;

    public function __construct($db = NULL) {
        parent::__construct($db);

        $this->post = Validate::factory($_POST)->rules('dotaz_captcha', array('not_empty'=>NULL,'Captcha::valid'=>NULL))
                                                ->rule('dotaz_jmeno', 'not_empty')
                                                ->rules('dotaz_email', array('not_empty'=>NULL,'email'=>NULL))
                                                ->rule('text_dotazu', 'not_empty');

    }

    public function check()
    {
        if($this->post->check()){
            $this->send_from_email = $_POST["dotaz_email"]; // email zaslany z kontaktniho formulare
            $this->send_from_name = $_POST["dotaz_jmeno"]; // jmeno zaslane z kontaktniho formulare
            return true;
        }else{
            // validace dat neprobehly uspesne
            $this->form_errors = $this->post->errors('default_errors');

            return false;
        }
    }


    public function getSend_to_email() {
        return $this->send_to_email;
    }

    public function setSend_to_email($send_to_email) {
        $this->send_to_email = $send_to_email;
    }

    public function getSend_to_name() {
        return $this->send_to_name;
    }

    public function getSend_from_email() {
        return $this->send_from_email;
    }

    public function getSend_from_name() {
        return $this->send_from_name;
    }

    public function setSend_to_name($send_to_name) {
        $this->send_to_name = $send_to_name;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function getForm_errors() {
        return $this->form_errors;
    }

    public function setForm_errors($form_errors) {
        $this->form_errors = $form_errors;
    }

    public function getForm_data() {
        return $this->form_data;
    }

    public function setForm_data($form_data) {
        $this->form_data = $form_data;
    }
}
?>