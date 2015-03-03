<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace clanku - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Environment_Langstrings_List extends Controller_Hana_List
{
    protected $with_route=true;

    protected $default_order_by = "string";
    protected $default_order_direction= "asc";
    protected $save_button="použít překlady";

    public function before() {
        $this->orm=new Model_Language_String();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("string")->type("link")->label("Výraz")->item_settings(array("hrefid"=>$this->base_path_to_edit))->css_class("txtLeft")->filterable()->sequenceable()->set();
        $this->auto_list_table->column("available_languages")->type("languages")->item_settings(array("hrefid"=>$this->base_path_to_edit))->width(58)->set();
        //$this->auto_list_table->column("zobrazit")->type("switch")->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"routes.zobrazit"))->label("")->width(32)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->width(30)->exportable(false)->printable(false)->set();
    }
    
    protected function _form_action_save($data)
    {
        // generovani vsech prekladu do jazykovych tabulek
        
        $languages=Kohana::config('languages');
        $language_array = $languages["mapping"];//[$this->actual_language_id];
        
        $baselang_orm=orm::factory("language_string")->language(1)/*->where("zobrazit","=",1)*/->order_by("string","asc")->find_all();
        $baselang_array=array();
        foreach($baselang_orm as $item)
        {
            $baselang_array[$item->id]=$item->string;
        }
        
        
        foreach ($language_array as $language_id => $language_str)
        {
            if($language_id==1) continue;
            $lang_orm=orm::factory("language_string")->language($language_id)/*->where("zobrazit","=",1)*/->order_by("string","asc")->find_all();
            $lang_array=array();
            foreach($lang_orm as $item)
            {
                $lang_array[$baselang_array[$item->id]]=htmlspecialchars($item->string,ENT_QUOTES);
            }
            
            $lang_tpl=new View("admin/language_strings");
            $lang_tpl->items=$lang_array;
            $content=$lang_tpl->render();
            
            //die($lang_tpl->render());
            
            $output = fopen(str_replace('\\', '/',DOCROOT)."application/i18n/".$language_str.".php", "w");
            fwrite ($output ,$content);
            fclose($output);
            
            
        }
        
        
    }

}
?>
