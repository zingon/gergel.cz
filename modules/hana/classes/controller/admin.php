<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * Vstupni kontroler administracniho rozhranni. Provadi obsluhu menu a routovani na subkontrolery.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class Controller_Admin extends Controller_Template{

    protected $allow_external_request=true;
    
    // zakladni nastaveni adminu
    public $main_logo=false; //array("url"=>"http://www.dgstudio.cz","src"=>"admin/img/dg-img/logo_dg.gif","title"=>"DG Studio");
    
    // privatni promenne
    public $template = 'admin/base_template';
    private $project_properties;
    
    private $index_file;


    public function before() {
        parent::before();
        if(Kohana::$index_file){Kohana::$index_file=Kohana::$index_file."/";}else{Kohana::$index_file="";}

        // nastaveni globalnich promennych do view
        View::set_global("url_base", url::base().((Kohana::$index_file)?(Kohana::$index_file."/"):""));
        View::set_global("media_path", url::base()."media/");
        View::set_global("web_owner",orm::factory("owner",1));
        $language = is_null(Request::instance()->param("language")) ? "cz" : Request::instance()->param("language");
        View::set_global("language_code", $language);
        i18n::lang($language);
        $this->template->media_path=url::base()."media/";
        $this->template->main_logo=$this->main_logo;
        $this->template->title=orm::factory("owner",1)->default_title;

    }
    public function action_index()
    {
        // nastaveni hlavicek odezvy
        Request::instance()->headers=array_merge(Request::instance()->headers, Expires::set(false));
        // zakladni vykonna metoda administracniho kuntroleru bude osetrena proti nedovolenemu vstupu
        if (Auth::instance()->logged_in(array('login', 'admin')) === FALSE && Auth::instance()->logged_in(array("global_admin")) === FALSE)
        {
            if (Auth::instance()->logged_in()){
                Request::instance()->redirect(url::base().Kohana::$index_file.'admin/noaccess');
            }else{
                Request::instance()->redirect(url::base().Kohana::$index_file.'admin/login');
            }
        }

        // zakladni metoda pro odchytavani a routovani url pozadavku na admin
        $module=Request::instance()->param("module");
        $submodule=Request::instance()->param("submodule");
        $controller=Request::instance()->param("subaction");
        $id=Request::instance()->param("id");
        $languages = Kohana::config('languages');
        $language = i18n::lang();
        $language_id = array_search($language, $languages["mapping"]);
        /*$actual_structure = ORM::factory("admin_structure")->where("module", "=", $module)->where("submodule", "=", $submodule)->
        $language_id = $this->actual_route->language_id ? $this->actual_route->language_id : 1;
        $language = Kohana::config('languages');
        $language_code = $language["mapping"][$language_id];
        i18n::lang($language_code);*/
        // pro akci previewraw nastavim prazdnou sablonu
        if($controller=="previewraw")
        {
            $this->template=new View("admin/raw_template");
        }
        if(request::$is_ajax)
        {
            $this->auto_render=false;
        }
        else
        {
            // vygenerovani hlavni navigace - uroven L1
//            $this->template->admin_menu_L1 = Cache::instance()->get('navigation_structure');
//            Cache::instance()->set('navigation_structure', $result_data);
            if(true /*!Cache::instance()->get($module."-".$submodule."-".$controller."-L1")*/)
            {
                $admin_menu_L1 = Service_Hana_Administration::get_main_navigation_links($module, $submodule, $controller, $language_id);
                $admin_menu_L3 = Service_Hana_Administration::get_module_links($language_id);
                $admin_menu_L1_L2 = Service_Hana_Administration::get_main_navigation_links_sublinks($language_id);
            }
            else
            {
                $admin_menu_L1 = Cache::instance()->get($module."-".$submodule."-".$controller."-L1");
                $admin_menu_L2 = Cache::instance()->get($module."-".$submodule."-".$controller."-L2");
                $admin_menu_L3 = Cache::instance()->get($module."-".$submodule."-".$controller."-L3");

            }
            // vzkaz pro nekoho kdo to bude bastlit bez myho svoleni po mne - prava je potreba udelat podstatne lip ;-)
            $xuser=Auth::instance()->get_user();
            $user_role=$xuser->roles->select(array("roles.id","role_id"))->order_by("roles.id","desc")->find();
            $this->template->role_level = $user_role->role_id;

            // vygenerovani navigace - uroven L1 a L2 (dropdown menu)
            $this->template->admin_menu_L1_L2 = $admin_menu_L1_L2;
            // vygenerovani sub-moduloveho menu - uroven L3
            $this->template->admin_menu_L3 = $admin_menu_L3;
        }
        // provedeni a vlozeni hlavniho modulu
        //die($module."-".$submodule."-".$controller);
        if($module && $submodule && $controller)
        {
            if(Kohana::$environment !== Kohana::PRODUCTION)
            {
                if(request::$is_ajax)
                {
                    $response = (Request::factory("admin-internal/admin/".$language."/".$module."/".$submodule."/".$controller."/".$id)->execute()->response);
                    $response.="<script type=\"text/javascript\">setup_hana_js_functionality();</script>";
                    echo $response;
                }
                else
                    $this->template->admin_content=Request::factory("admin-internal/admin/".$language."/".$module."/".$submodule."/".$controller."/".$id)->execute()->response;
            }
            else
            {
                try
                {
                    if(request::$is_ajax)
                    {
                        $response = (Request::factory("admin-internal/admin/".$language."/".$module."/".$submodule."/".$controller."/".$id)->execute()->response);
                        $response.="<script type=\"text/javascript\">setup_hana_js_functionality();</script>";
                        echo $response;
                    }
                    else
                        $this->template->admin_content=Request::factory("admin-internal/admin/".$language."/".$module."/".$submodule."/".$controller."/".$id)->execute()->response;

                } catch (Exception $e) {
                    Kohana::$log->add(Kohana::ERROR, Kohana::exception_text($e));
                    // modul je zarazen ve strukture, ale fyzicky neexistuje
                    $this->template->admin_content="Modul není nainstalován, nebo došlo k chybě při zpracování dat.";
                }
            }
        }
        else
        {
            throw new Kohana_Exception("Chybná URL adresa, nelze vyvolat administraci modulu!");
        }
    }

    public function action_login()
    {
        $login_template=new View("admin/login");
        $username=""; $password="";
        if(isset($_POST["username"]))$username=$_POST["username"];
        if(isset($_POST["password"]))$password=$_POST["password"];
        $login_template->show_login_error=false;
        if($username || $password)
        {
            if(Auth::instance()->login($username, $password))
            {
                // staticky to redirectnu na uvodni kontroler
                Request::instance()->redirect(url::base().Kohana::$index_file.'admin/'.i18n::lang().'/environment/module/default');
            }
            else
            {
                $login_template->show_login_error=true;
            }
        }
        //echo(Auth::instance()->hash_password("test"));
        $this->template->center_section=$login_template;
    }

    public function action_noaccess(){
        throw new Kohana_Exception("nemáte potřebná uživatelská práva");
    }

    public function action_logout(){
        Auth::instance()->logout();
        Request::instance()->redirect(url::base().Kohana::$index_file.'admin/login');
    }

    public function action_exit(){
        $this->template->center_section="<br /><p>Byli jste odhlášeni ze systému. Znovu se můžete přihlásit <a href=\"".url::base()."admin/login\">ZDE</a>.</p>";
    }

    // Vstupní bod pro filemanager
    public function action_file_manager() {
        if (Auth::instance()->logged_in(array('login', 'admin')) === FALSE && Auth::instance()->logged_in(array("global_admin")) === FALSE) {
            if (Auth::instance()->logged_in()){
                Request::instance()->redirect(url::base().Kohana::$index_file.'admin/noaccess');
            }else{
                Request::instance()->redirect(url::base().Kohana::$index_file.'admin/login');
            }
        } else {
            $this->template = new View("admin/filemanager/response");
            if (isset($_GET['mode']) && $_GET['mode']!='') {
                $this->template->response = json_encode(Service_Filemanager::process_get($_GET["mode"]));
            } elseif (isset($_POST['mode']) && $_POST['mode']!='') {
                $this->template->response = json_encode(Service_Filemanager::process_post($_POST["mode"]));
            } else
                $this->template = new View("admin/filemanager/index");
        }
    }
    public function after()
    {
        parent::after();
        // Showing the profiler if using debug mode
        //$this->request->response .= View::factory('profiler/stats');
    }

}
?>
