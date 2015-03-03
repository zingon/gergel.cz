<?php defined('SYSPATH') or die('No direct script access.');

class Model_Email_Form_Contact extends Model
{
    protected $validate_object;
    protected $form_errors;
    
    public function check($form_data)
    {
        $this->validate_object = Validate::factory($form_data)
            ->filters(TRUE,array('strip_tags' => NULL))
            ->rule('jmeno', 'not_empty')
            ->rule('prijmeni', 'not_empty')
            //->rule('telefon', 'not_empty')
            ->rules('email', array('not_empty'=>NULL,'email'=>NULL))
            ->rule('zprava', 'not_empty');
        
        if($this->validate_object->check()){
            return true;
        }else{
            return false;
        }
    }
    
    public function validate()
    {
       return $this->validate_object;
    }


 
}
?>

