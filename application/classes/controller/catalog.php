<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generovani statickych obsahovych stranek a textu.
 */
class Controller_Catalog extends Controller
{
    /**
     * Metoda generujici seznam clanku.
     */
    public function action_index($page=1)
    {
        $template = new View("catalog/category_homepage");
        $route_id = $this->application_context->get_route_id();
        $page_orm  = Service_Page::get_page_by_route_id($route_id);


        $template->items = Service_Catalog_Category::get_categories_by_parent_id(0, $this->application_context->get_actual_language_id());
        $template->item = $page_orm;
        $this->request->response=$template->render();
    }
    
    public function action_category()
    {  
        $route_id=$this->application_context->get_actual_route();
        $category = Service_Catalog_Category::get_product_category_by_route_id($route_id);
        $sel_links = Hana_Navigation::instance()->get_navigation_breadcrumbs();
        end($sel_links);
        $template = new View("catalog/detail");
        $template->item = $category;
        $template->prev = current($sel_links);
        $this->request->response=$template->render();
    }
    
    /**
     * Metoda generujici seznam clanku - uvodka.
     */
    public function action_homepage_list()
    {
        $template=new View("catalog/homepage_list");
        $categories = Service_Catalog_Category::get_categories_by_parent_id(0, $this->application_context->get_actual_language_id(), 2, 3);
        $template->categories = $categories;
        $this->request->response = $template->render();
    }
    
    
    /**
     * Metoda generujici vsechny stranky vkladane do hlavniho obsahu.
     */
    public function action_detail()
    {
        $route_id=$this->application_context->get_actual_route();
        $template=new View("catalog/detail");
        $sel_links = Hana_Navigation::instance()->get_navigation_breadcrumbs();
        array_pop($sel_links);
        $category=array_pop($sel_links);
        $template->link_back=$category["nazev_seo"];
        $item=Service_Catalog::get_catalog_item_by_route_id($route_id);
        $template->item=$item;
        $this->request->response=$template->render();
    }
    
    public function action_main_subnav($nazev_seo)
    {
        $subnav=new View("catalog_top_subnav");
        $links     = Service_catalog::get_navigation($this->application_context->get_actual_language_id(),1,1);
        $sel_links = Hana_Navigation::instance()->get_navigation_breadcrumbs();
        $subnav->links = $links;
        $subnav->sel_links = $sel_links;
        $subnav->prev = prev(end($sel_links));
        $this->request->response=$subnav->render();
    }
    
     /**
     * Specificka navigace 
     * @param type $nazev_seo 
     */
    public function action_second_subnav($nazev_seo)
    {
        $subnav=new View("navigation/secondary");
        $links     = Service_catalog::get_navigation($this->application_context->get_actual_language_id(),1,3,array());
        $sel_links = Hana_Navigation::instance()->get_navigation_breadcrumbs();

        $subnav->links = $links;
        $subnav->sel_links = $sel_links;
        end($sel_links);
        $subnav->prev = current($sel_links);
        $this->request->response=$subnav->render();
    }
    
    /**
     * Specificka navigace 
     * @param type $nazev_seo 
     */
    public function action_third_subnav($nazev_seo)
    {
        $subnav=new View("catalog_second_subnav");
        $route_id  = $this->application_context->get_actual_route();

        $links1     = Service_catalog::get_navigation($this->application_context->get_actual_language_id(),1,2,array());
        
        $sel_links = Hana_Navigation::instance()->get_navigation_breadcrumbs();
        $sel_link=array_pop($sel_links);
        

        if(!empty($sel_link["nazev_seo"]) && !empty($links1[$sel_link["nazev_seo"]]["children"]))
        {
            $links=$links1[$sel_link["nazev_seo"]]["children"];
        }
        else
        {
           $links=array(); 
        }

        $subnav->links = $links;
        $subnav->sel_links = $sel_links; 
        $this->request->response=$subnav->render();
    }

    public function action_homepage_widget()
    {
        $template = new View("catalog/homepage_widget");
        $products = Service_Catalog_Category::get_for_homepage();

        $template->products = $products;
        $this->request->response = $template->render();
    }
    
}

?>
