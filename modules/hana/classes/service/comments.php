<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Servisa pro obsluhu navstevni knihy.
 *
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class Service_Comments extends Service_Hana_Module_Base
{

    protected static $navigation_module="page";
    
    public static function insert_message($form_data, $response_object)
    {
        $form_orm=orm::factory("comment");
        $form_orm->values($form_data);
        if(!$form_orm->check()){
            $response_object->set_errors(array("commentform"=>$form_orm->validate()->errors('form_errors')));
            $response_object->set_data($form_data);
            $response_object->set_status(false);
            return false;
        }
        else
        {
            //$form_orm->email=$form_data["email"];
            //$form_orm->text_question=$message_data["text_question"];
            $form_orm->product_id=$form_data["product_id"];
            $form_orm->datetime=date("Y-m-d H:i:s");
            $form_orm->save();
            
            $response_object->set_status(true);
            return true;
        }
        
    }
    
    
    public static function get_all_authorized_messages($product_id,$limit=100,$offset=0)
    {
        $comments=orm::factory("comment")->where("product_id","=",$product_id)->where("authorized","=",1)->order_by("datetime","DESC")->limit($limit)->offset($offset)->find_all();

        return $comments;
        
    }
    
    public static function get_all_authorized_messages_count()
    {
        return DB::select(db::expr("COUNT(comments.id) as pocet"))->from("comments")->where("authorized","=",1)->execute()->get("pocet");   
    }
        
  
}
?>

