<?php defined('SYSPATH') or die('No direct script access.');

/**
 * navigation widgets
 *
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Controller_Navigation extends Controller
{  
    public function action_main($nazev_seo)
    {
        //die(print_r(Hana_Navigation::instance()->get_navigation($this->application_context->get_actual_language_id())));
        $nav=new View("navigation/main");
        $links = Hana_Navigation::instance()->get_navigation($this->application_context->get_actual_language_id());
        $nav->index_link = array_shift($links);
        $nav->links     =  $links;
        $nav->sel_links = Hana_Navigation::instance()->get_navigation_breadcrumbs();
        $this->request->response=$nav->render();  
    }
    
    public function action_secondary($nazev_seo)
	{
		$nav = new View("nav");
		
		$links = Hana_Navigation::instance()->get_navigation($this->application_context->get_actual_language_id(), 4);
		$nav->links = $links;
        $nav->sel_links = Hana_Navigation::instance()->get_navigation_breadcrumbs();
		
		$this->request->response = $nav->render();
	}
    
    public function action_breadcrumbs(){
        // mimo uvodku
        if(!($this->application_context->get_main_controller()=="page" && $this->application_context->get_main_controller_action()=="index"))
        {
            $breadcrumbs=new View("breadcrumbs");
            $navigation_items=Hana_Navigation::instance()->get_navigation_breadcrumbs();
            //die(print_r($navigation_items));
            $breadcrumbs->items=array_reverse($navigation_items, true);
            $this->request->response=$breadcrumbs->render();
        }
    }
    
    public function action_site_index()
    {
        $site_index=new View("site_index");
        $raw_links = Hana_Navigation::instance()->get_navigation($this->application_context->get_actual_language_id());
        //$nav->links= $raw_links;
        
        // vyjimka: rozdelim linky na ty bez subodkazu a se subodkazy
        $links_alone=array();
        $links=array();
        
        foreach($raw_links as $key=>$link)
        {
            if(empty($link["children"]))
            {
                $links_alone[$key]=$link;
            }
            else
            {
                $links[$key]=$link;
            }
        }
        
        $site_index->empty_links=$links_alone;
        $site_index->links=$links;
        
        $site_index->sel_links = array();//Hana_Navigation::instance()->get_navigation_breadcrumbs();
        $this->request->response=$site_index->render();
    }
}

?>
