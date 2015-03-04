<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Ustredni trida generujici a shromazdujici aktualni kontext aplikace na zaklade aktualni routy.
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Hana_Application
{
    private static $instance;

    private $secure_string="gdfvm540";

    private $actual_route;

    private $route_id;

    private $is_available=false;

    private $actual_seo;

    private $data_manipulation_controller;
    private $data_manipulation_controller_action;
    private $data_manipulation_controller_action_param;
    private $data_manipulation_secure_code;

    private $main_controller;
    private $main_controller_action;
    private $main_controller_parameters="";
    private $parameter_2="";

    private $actual_language_id=1;

    private $web_name;
    private $page_title;
    private $page_description;
    private $page_keywords;

    private $web_setup_data;
    private $web_owner_data;


    /**
     *
     * @return Hana_Application
     */
    public static function instance()
    {
        if (self::$instance === NULL) {
            self::$instance=new Hana_Application;
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->web_setup_data=orm::factory("admin_setting",1);
        $this->web_owner_data=orm::factory("owner",1);

        $this->web_name=$this->web_owner_data->default_title;


        $this->actual_seo=Service_Route::get_actual_nazev_seo();
        if($this->actual_seo=="") $this->actual_seo="index";

        $this->actual_route=Service_Route::get_page_route_by_nazev_seo($this->actual_seo);

        $this->actual_language_id=$this->actual_route->language_id?$this->actual_route->language_id:1;

        if($this->actual_route->zobrazit==1 && $this->actual_route->deleted==0)
        {
            $this->is_available=true;

            $this->route_id=$this->actual_route->id;

            $this->page_title=$this->actual_route->title;
            $this->page_description=($this->actual_route->description)?$this->actual_route->description:$this->web_owner_data->default_description;
            $this->page_keywords=($this->actual_route->keywords)?$this->actual_route->keywords:$this->web_owner_data->default_keywords;

            // PRG system urceni DMC a VC
            $this->main_controller=DB::select("kod")->from("modules")->where("id","=",$this->actual_route->module_id)->as_object()->execute()->current()->kod;
            $this->data_manipulation_controller=(isset($_GET["h_module"]))?$_GET["h_module"]:((isset($_POST["h_module"]))?$_POST["h_module"]:$this->main_controller);

            $this->data_manipulation_controller_action=(isset($_GET["h_action"]))?$_GET["h_action"]:((isset($_POST["h_action"]))?$_POST["h_action"]:false);
            $this->main_controller_action=$this->actual_route->module_action;

            $this->data_manipulation_controller_action_param=isset($_POST["h_param"])?$_POST["h_param"]:false;//(isset($_GET["h_param"]))?$_GET["h_param"]:((isset($_POST["h_param"]))?$_POST["h_param"]:false);
            // prednost bude mit parametr zadany v url adrese
            $this->main_controller_parameters=(Service_Route::get_route_parameter())?Service_Route::get_route_parameter():$this->actual_route->param_id1;
            $this->parameter_2=(Service_Route::get_route_parameter_2())?Service_Route::get_route_parameter_2():$this->actual_route->param_id1;

            $this->data_manipulation_secure_code=(isset($_GET["h_secure"]))?$_GET["h_secure"]:((isset($_POST["h_secure"]))?$_POST["h_secure"]:false);

            if(is_array($this->data_manipulation_controller_action))
            {
                // opatreni pro obsluho vice submitu v jednom formulari
                $possible_actions=array_keys($this->data_manipulation_controller_action);

                foreach($possible_actions as $possible_action)
                {
                    if(isset($_POST[$possible_action]))
                    {
                        $this->data_manipulation_controller_action=$possible_action;
                        $this->data_manipulation_controller=$this->data_manipulation_controller[$possible_action];
                        $this->data_manipulation_secure_code=$this->data_manipulation_secure_code[$possible_action];
                    }
                }
            }
        }
    }

    /**
     * Vraci data ohledne zakladniho nastaveni fungovani webove aplikace
     * @return orm
     */
    public function get_web_setup_data()
    {
        return $this->web_setup_data;
    }

    /**
     * Vraci zakladni uzivatelska data o strankach
     * @return orm
     */
    public function get_web_owner_data()     {
        return $this->web_owner_data;
    }

    /**
     * Vrati aktualni hodnotu url segmentu se seo nazvem.
     * @return string
     */
    public function get_actual_seo()
    {
        return $this->actual_seo;
    }

    /**
     * Vrati kod aktualniho hlavniho kontroleru.
     * @return string
     */
    public function get_main_controller()
    {
        return $this->main_controller;
    }

    /**
     * Vrati nazev pozadovane akcni metody hlavniho kontroleru.
     * @return string
     */
    public function get_main_controller_action()
    {
        return $this->main_controller_action;
    }

    /**
     * Vrati parametry pro aktualni hlavni kontroller.
     * @return string
     */
    public function get_main_controller_parameters()
    {
        return $this->main_controller_parameters;
    }

    /**
     * Vrati 3. parametry pro aktualni hlavni kontroller.
     * @return string
     */
    public function get_main_controller_parameter_2()
    {
        return $this->parameter_2;
    }

    /**
     * Vrati kod aktualniho DM kontroleru.
     * @return string
     */
    public function get_data_manipulation_controller()
    {
        return $this->data_manipulation_controller;
    }

    /**
     * Vrati nazev pozadovane akcni metody DM kontroleru.
     * @return string
     */
    public function get_data_manipulation_controller_action()
    {
        return $this->data_manipulation_controller_action;
    }

    /**
     * Vrati parametry pro aktualni DM kontroller.
     * @return string
     */
    public function get_data_manipulation_controller_action_param()
    {
        return $this->data_manipulation_controller_action_param;
    }

    /**
     * Vrati bezpecnostni kod z formulare.
     * @return string
     */
    public function get_data_manipulation_secure_code()
    {
        return $this->data_manipulation_secure_code;
    }

    /**
     *
     * @param string $action
     * @param string $controller
     * @return string
     */
    public function create_data_manipulation_secure_code($action, $controller=null)
    {
        if(!$controller) $controller=$this->main_controller;
        return(md5($this->secure_string.$action.$controller));
    }

    /**
     *
     * @param type $action nazev akcni metody kontroleru
     * @param type $controller nazev kontroleru
     * @param type $secure_code kod z formulare
     * @return type
     */
    public function validate_data_manipulation_secure_code($action, $controller=null, $secure_code=null)
    {
        if(!$secure_code) $secure_code=$this->get_data_manipulation_secure_code();
        return ($secure_code==$this->create_data_manipulation_secure_code($action, $controller));
    }



    /**
     * Vrati id jazykove verze na zaklade aktualni routy.
     * @return int
     */
    public function get_actual_language_id()
    {
        return $this->actual_language_id;
    }

    /**
     * Vrati id jazykove verze na zaklade aktualni routy.
     * @return int
     */
    public function get_actual_language_code()
    {
        $languages=Kohana::config('languages');
        return $languages["mapping"][$this->actual_language_id];
    }

    /**
     * Vrati hlavni nazev stranek (projektu)
     * @return string
     */
    public function get_name()
    {
        return $this->web_name;
    }

    /**
     * Vrati aktualni <title> hodnotu, jinak defaultni.
     * @return string
     */
    public function get_title()
    {
        return $this->page_title;
    }

    /**
     * Vrati aktualni <description> hodnotu, jinak defaultni.
     * @return string
     */
    public function get_description()
    {
        return $this->page_description;
    }

    /**
     * Vrati aktualni <keywords> hodnotu, jinak defaultni.
     * @return string
     */
    public function get_keywords()
    {
        return $this->page_keywords;
    }

    function get_full_url()
    {
        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
        $protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
        $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
        $uri = $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
        $segments = explode('?', $uri, 2);
        $url = $segments[0];
        return $url;
    }

    /**
     * Vrati true, pokud je routa urcena k zobrazeni na verejne casti (zobrazena, nesmazana)
     * @return boolean
     */
    public function is_page_available()
    {
        return $this->is_available;
    }

    /**
     * Vraci id nactene routy. Pro pouziti v modulech, ktere uz nemusi joinovat tabulku routes.
     * @return int
     */
    public function get_route_id()
    {
        return $this->route_id;
    }

    /**
     * Vrati orm aktualne nactene routy.
     * @return orm
     */
    public function get_actual_route(){
        return $this->actual_route;
    }


    /**
     * Priznak ajaxoveho pozadavku
     * @return boolean
     */
    public function is_ajax()
    {
        return request::$is_ajax;
    }

}
?>
