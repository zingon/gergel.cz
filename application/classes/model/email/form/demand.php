<?php
class Model_Email_Form_Demand extends Model
{
    public function check($form_data)
    {
        /*$this->validate_object = Validate::factory($form_data)
            ->filters(TRUE,array('strip_tags' => NULL))
            ->rule('jmeno', 'not_empty')
            //->rule('telefon', 'not_empty')
            ->rules('email', array('not_empty'=>NULL,'email'=>NULL))
            ->rule('zprava', 'not_empty');

        if($this->validate_object->check()){
            return true;
        }else{
            return false;
        }*/
        return true;
    }
}
?>