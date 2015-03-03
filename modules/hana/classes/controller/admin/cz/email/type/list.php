<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace typu emailu - seznam.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2011 Pavel Herink
 */

class Controller_Admin_Cz_Email_Type_List extends Controller_Hana_List
{
    protected $with_route=false;


    public function before() {
        $this->orm=new Model_Email_Type();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název typu emailu")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->sequenceable()->filterable()->set();    
        $this->auto_list_table->column("code")->label("Kód")->css_class("txtLeft")->width(150)->sequenceable()->filterable()->set();
        $this->auto_list_table->column("use_email_queue")->type("indicator")->label("Použít frontu")->item_settings(array("states"=>array(0=>array("image"=>"drive_delete.png","label"=>"neukládat do fronty"),1=>array("image"=>"drive_add.png","label"=>"ukládat do fronty"))))->css_class("txtCenter")->sequenceable()->filterable()->width(120)->set();
        $this->auto_list_table->column("email_receiver")->label("Příjemci (kopií)")->data_src(array(/*"column_name"=>"pcd_nazev"*/"related_table_1"=>"email_receivers","column_name"=>"nazev","order_by"=>array("email_receivers.nazev","asc"),"orm_tree"=>false,"multiple"=>true))->width(150)->sequenceable("email_receivers.nazev")->filterable(array("col_name"=>"email_receivers.id","orm_tree"=>false))->set();
        
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(20)->set();
    }
    
    protected function _orm_setup()
    {
        $this->orm->join("email_types_receivers","left")->on("email_types.id","=","email_types_receivers.email_type_id");
        $this->orm->join("email_receivers","left")->on("email_receivers.id","=","email_types_receivers.email_receiver_id");
    }
 
}
?>