<?php defined('SYSPATH') or die('No direct script access.');

class Model_Email_Form_Sponsor extends Model
{
    protected $validate_object;
    protected $form_errors;
    
    public function check($form_data)
    {

        $this->validate_object = Validate::factory($form_data)
                                                ->filters(TRUE,array('strip_tags' => NULL))
                                                ->rule('jmeno', 'not_empty')
                                                ->rule('firma', 'not_empty')
                                                ->rule('ulice', 'not_empty')
                                                ->rule('mesto', 'not_empty')
                                                ->rule('telefon', 'not_empty')
                                                ->rules('email', array('not_empty'=>NULL,'email'=>NULL))
                                                
                                                ->rule('castka', 'not_empty')
                                                ->rule('zpuson_platba', 'not_empty')
                                                ->rule('jmeno_tabule', 'not_empty')
                                                
                                                ;
                                                //->rule('text', 'not_empty');
        
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

