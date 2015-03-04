<?php defined('SYSPATH') or die('No direct script access.');

class Model_Email_Form_Visitform extends Model
{
    protected $validate_object;
    protected $form_errors;
    
    public function check($form_data)
    {
        $this->validate_object = Validate::factory($form_data)
                                                ->filters(TRUE,array('strip_tags' => NULL))
                                                ->rule('jmeno', 'not_empty')
                                                ->rule('tema', 'not_empty')
                                                ->rule('adresa', 'not_empty')
                                                ->rules('email', array('not_empty'=>NULL,'email'=>NULL));
        
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

