<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generovani statickych obsahovych stranek a textu.
 */
class Controller_Article extends Controller
{
    /**
     * Metoda generujici seznam clanku.
     */
    public function action_index($page = 1)
    {
        $template=new View("article/list");
        $language_id=$this->application_context->get_actual_language_id();
        $route_id=$this->application_context->get_route_id();
        $page_orm=Service_Page::get_page_by_route_id($route_id);
        
        //die(print_r($page));
        $template->item=$page_orm;
        $items_per_page=5;
        $pagination = Pagination::factory(array(
          'current_page'   => array('source' => $this->application_context->get_actual_seo(), 'value'=>$page),
          'total_items'    => Service_Article::get_article_total_items_list($language_id, 0),
          'items_per_page' => $items_per_page,
          'view'              => 'pagination/basic',
          'auto_hide'      => TRUE
        ));

        $template->items = Service_Article::get_article_list($language_id,0,$items_per_page,$pagination->offset);
        $template->pagination=$pagination->render();
        $this->request->response=$template->render();
    }
    
    /**
     * Metoda generujici seznam clanku na uvodce.
     */
    public function action_widget()
    {
        $template=new View("article/widget");
        $language_id=$this->application_context->get_actual_language_id();
        $template->items=Service_Article::get_article_banner_list($language_id,2);
        //die(print_r(Service_Article::get_article_banner_list($language_id,0,3)));
        $this->request->response=$template->render();
    }
    
    /**
     * Metoda generujici seznam clanku - uvodka.
     */
  /*  public function action_homepage_list()
    {
        $template=new View("article_homepage_list");
        $language_id=$this->application_context->get_actual_language_id();
        $template->items=Service_Article::get_article_list($language_id,0,2,0,true);
        $this->request->response=$template->render();
    }
    */
    
    /**
     * Metoda generujici vsechny stranky vkladane do hlavniho obsahu.
     */
    public function action_detail()
    {
        $route_id=$this->application_context->get_route_id();
        $template=new View("article/detail");
        $sel_links = Hana_Navigation::instance()->get_navigation_breadcrumbs();
        end($sel_links);
        
        $template->item=Service_Article::get_article_by_route_id($route_id);
        $template->prev = current($sel_links);
        $this->request->response=$template->render();
    }
    
   /* public function action_article_subnav($nazev_seo)
    {
        $subnav=new View("subnav");
        $links     = Service_Article::get_navigation($this->application_context->get_actual_language_id());
        $sel_links = Hana_Navigation::instance()->get_navigation_breadcrumbs();

        $sel_link=array_pop($sel_links);
        $subnav->links = $links;
        $subnav->sel_links = $sel_links; 
        $this->request->response=$subnav->render();
    }
*/
    
}

?>
