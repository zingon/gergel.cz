<?php defined('SYSPATH') or die('No direct script access.');

class Model_Email_Queue extends ORM
{
    protected $_belongs_to = array('email_queue_body' => array());
    
    protected $_table_name="email_queue";
    //protected $primary_key = 'queue_id';

    private $priority=2; // defaultni priorita zaznamu ukladanych do fronty
    private $count_limit=100; // defaultni limit poctu naraz odesilanych mailu z fronty
    private $delete_after_send = 0;
    
    
    public function addNewRecordToQueue($data)
    {
        //$queue_body=$this->email_queue_body;
        $queue_body=orm::factory("email_queue_body");
        $queue_body->values($data);
        $id=$queue_body->save()->id;
        return $id;
    }
    
    /**
     * Ulozi zaznam do databaze.
     * @param array $data data ve formatu sloupec=>hodnota (dle aktualnich sloupcu v db email_queue), cas ulozeni a priorita se prida automaticky
     * @param boolean $delete_after_send priznak, zda mazat zaznamy po uplynuti zadane doby, pri nevyplneni se ridi defaultnim nastavenim
     */
    public function addNewReceiverToQueue($email_queue_id, $data)
    {
        $queue=orm::factory("email_queue");
        
        $queue->email_queue_body_id=$email_queue_id;
        
        $queue->values($data);
        
        $queue->queue_create_date = date("Y-m-d H:i:s");
        $queue->queue_date_to_be_send = date("Y-m-d H:i:s");
        $queue->queue_priority = isset($data["priority"])?$data["priority"]:2;
        return $queue->save()->id;
        
        
    }

    /**
     * Obecna metoda pro ziskani zaznamu z databaze
     * @param array $filter_rules
     * @param array $order_by
     * @param array $limit
     * @param array $offset
     * @return orm
     */
    public function getFromQueue($filter_rules, $order_by=array("id","asc"), $limit=false, $offset=false){
                            $orm =  $this;
                            $orm->select("*");
         if($condition)     $orm->where($condition);
         if(count($orderby))$orm->order_by($orderby);
         if($limit)         $orm->limit($limit, $offset);
         return             $orm->find_all();

    }

    public function getItemsToSend($limit){
        if(!$limit) $limit=$this->count_limit;
        return $this->where("queue_sent","=",0)->where("queue_date_to_be_send","<",date("Y-m-d H:i:s"))->order_by("queue_date_to_be_send","asc")->order_by("queue_priority","asc")->order_by("id","asc")->limit($limit)->find_all();
    }

    /**
     * Nastavi priznak u odeslane polozky (queue_sent=1) a datum odeslani
     * @param int $queue_id id polozky, pokud false - aktualni nahrana polozka
     */

    public function setSendFlag($queue_id=false)
    {
        if(!$queue_id)
            $orm=$this;
        else
            $orm=$this->where("id","=",$queue_id)->find();
        $orm->queue_sent_date = date("Y-m-d H:i:s");
        $orm->queue_sent=1;
        $orm->queue_errors_count=0;
        if(!empty($orm->queue_error))
        {
            $orm->queue_error="";
        }
        $orm->save();
    }
    
    /**
     * Nastaví chybu u záznamu.
     * 
     * @param type $queue_id
     * @param type $queue_error_text 
     */
    public function setErrorFlag($queue_id=false, $queue_error_text="")
    {
        if(!$queue_id)
            $orm=$this;
        else
            $orm=$this->where("id","=",$queue_id)->find();
        
        $error_count=$orm->queue_errors_count;
        $orm->queue_errors_count=$error_count+1;
        $orm->queue_error=$queue_error_text;
        $orm->save();
    }

    /**
     * Obecna metoda na odstranovani zaznamu z email_queue
     * @param int $item_id
     */
    public function removeFromQueue($item_id){
        if(!$item_id)
            $this->delete();
        elseif(!is_array($item_id))
            $this->delete(array($item_id));
        else
            $this->delete_all($item_id);

    }

    /**
     * Odstrani zaznamy z email_queue pokud byly uspesne odeslany, maji priznak "delete_after_send" nastaven na 1 a ubehla dana casova perioda od jejich odeslani.
     * @param int $distance casovy interval (ve dnech) po kterem se odeslane maily smazou
     */
    public function cleanQueue($distance){
        $now=strtotime("now");
        $incerased_timestamp=$now+(86400 * $distance);
        $incerased_datetime=date("Y-m-d H:i:s",$incerased_timestamp);
        $orm=$this->where("queue_sent","=",1)->where("queue_delete_after_send","=",1)->where("queue_sent_date","<",$incerased_datetime)->find_all();
    }

    // vymaze celou frontu - prozatim neimplementovano
    public function deleteQueue(){

    }
}

?>
