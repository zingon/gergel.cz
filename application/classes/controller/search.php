<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Controller_Search extends Controller
{
    /**
     * Zobrazi samostatnou stranku pro vyhledavani.
     */
    public function action_index()
    {
        $search_text=Input::post("search_text");
        
        if($search_text)
        {
            $language = $this->application_context->get_actual_language_id();

            $search_message="";
            $search_results=array();

            if(strlen($search_text)>1)
            {
                $search_results = Service_Search::search($search_text, $language);
                if(empty($search_results)) $search_message=__("Pro zvolené klíčové slovo nebylo nic nalezeno");
            }
            else
            {
                $search_message=__("Hledaný řetězec musí mít alespoň 2 znaky");
            }

            //print_r($search_results);
            $search_results_template=new View("search_results");
            $search_results_template->item = Service_Page::get_page_by_route_id($this->application_context->get_route_id());
            $search_results_template->keyword=$search_text;
            $search_results_template->search_results=$search_results;
            $search_results_template->search_message=$search_message; 
            $this->request->response=$search_results_template->render();
        }
        else
        {
            Request::instance()->redirect(url::base());
        }
    }
    
    /**
     * Zobrazi nezavisly box s vyhledavanim.
     */
    public function action_widget()
    {
       $search=new View("search_widget");
       $this->request->response=$search->render();
    }
    
    /** 
     * Ajaxove zasilani navrhu
     */ 
    public function action_show_suggestions()
    {
       $search_str = Input::get("term");
       $search_language_id=$this->application_context->get_actual_language_id();
       $sugestions=Service_Search::quick_search($search_str, $search_language_id);
       $this->request->response=$sugestions;
    }
    
    /**
     * Vlastni obsluha hledani.
     * @param type $on_success_redirect_to 
     */
//    public function action_perform_search($on_success_redirect_to="")
//    {
//        
//    }
}

?>

