<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generovani statickych obsahovych stranek a textu.
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Controller_Page extends Controller
{
    /**
     * Staticka promenna kvuli urceni typu subnavigace v navaznosti na hlavni stranku.
     * @var type
     */
    public static $current_page_category_id=3;
    
    /**
     * Metoda generujici obsah uvodni stranku.
     */
    public function action_index()
    {
        $route_id=$this->application_context->get_actual_route();
        $template=new View("page/homepage");
        $template->item  = Service_Page::get_page_by_route_id($route_id);
        $this->request->response=$template->render();
    }
    
    /**
     * Metoda generujici vsechny stranky vkladane do hlavniho obsahu.
     */
    public function action_detail()
    {
        $route_id=$this->application_context->get_actual_route();
        $page=Service_Page::get_page_by_route_id($route_id);
        
        if($page["indexpage"])
        {
            return $this->action_index();
        } 
        else if($page["show_child_pages_index"])
        {
            $template=new View("page/list");
            $page["childrens"] = Service_Page::get_pages_with_parent($this->application_context->get_actual_language_id(),$page['id'],3);
        }
        else
        {
            $template=new View("page/detail");
        }
        
        $template->item=$page;
        $sublinks=((Hana_Navigation::instance()->get_navigation($this->application_context->get_actual_language_id(),self::$current_page_category_id)));
        $template->sublinks=isset($sublinks[$this->application_context->get_actual_seo()]["children"])?$sublinks[$this->application_context->get_actual_seo()]["children"]:array();

        self::$current_page_category_id=$page["page_category_id"];
        
        if(isset($_POST["unlock"])){Session::instance()->set("page_unlock", true);}
        
        /* chranene stranky */
        if($page["protected"])
        {
            if(Session::instance()->get("page_unlock", false))
            {
                $template->protected=false; 
            }
            else
            {
                $template->protected=true;
            }
        }
        else
        {
            $template->protected=false;
        }
        
        
        $this->request->response=$template->render();
    }

    public function action_static($kod)
    {
        
        $language_id=$this->application_context->get_actual_language_id();
        $this->request->response=Service_Page::get_static_content_by_code($kod, $language_id)->popis;
    }

    /* 
     * @deprecated -> action_detail
     */
    public function action_unrelated($nazev_seo)
    {
        
    }
    
    public function action_page_subnav($nazev_seo)
    {
        $subnav=new View("navigation/secondary");
        $links     = Hana_Navigation::instance()->get_navigation($this->application_context->get_actual_language_id(),self::$current_page_category_id);
        $sel_links = Hana_Navigation::instance()->get_navigation_breadcrumbs();
        //die(print_r($links));
        //die(print_r($sel_links));
        $sel_link=array_pop($sel_links);
        $subnav->title=$sel_link["nazev"];
        
        $subnav->links = !empty($links[$sel_link["nazev_seo"]]["children"])?$links[$sel_link["nazev_seo"]]["children"]:array();
        $subnav->sel_links = $sel_links;
        end($sel_links);
        $subnav->prev = current($sel_links);
        $this->request->response=$subnav->render();
    }

    public function action_widget()
    {
        $widget= new View('page/widget');
        $widget->links=Service_Page::get_pages_with_parent($this->application_context->get_actual_language_id(),16);
        $this->request->response=$widget->render();
    }

    public function action_sitemap()
    {
        $template=new View("page");
        $route_id=$this->application_context->get_actual_route();
        $page=Service_Page::get_page_by_route_id($route_id);
        
        // vylistovani vsech viditelnych "struktur"
        $sitemap=new View("sitemap");
        $sitemap->zarazene = Hana_Navigation::instance()->get_navigation($this->application_context->get_actual_language_id(),3);
        $sitemap->nezarazene = Hana_Navigation::instance()->get_navigation($this->application_context->get_actual_language_id(),2);
        
        $page["popis"]=$sitemap->render();
        
        $template->item=$page;
        $this->request->response=$template->render();
    }

    
}

?>
