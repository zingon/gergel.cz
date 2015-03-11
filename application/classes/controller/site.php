<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Zakladni "front" kontroler.
 */
class Controller_Site extends Controller {

    protected $allow_external_request = true;

    /**
     * @var View
     */
    public function action_index() {

        // zakladni nastaveni
        // trida input bude automaticky stripovat tagy - pouziva tuto tridu pro nacitani POST/GET dat  
        Input::$auto_strip_tags = true;

        // nastaveni zakladnich globalnich promennych sablonam
        View::set_global("url_base", url::base() . ((Kohana::$index_file) ? (Kohana::$index_file . "/") : ""));
        View::set_global("url_actual", url::base() . ((Kohana::$index_file) ? (Kohana::$index_file . "/") : "") . $this->application_context->get_actual_seo());
        $index_seo = Service_Route::get_language_index_seo($this->application_context->get_actual_language_id());
        View::set_global("url_homepage", url::base() . ($index_seo!=""?$index_seo:"index"));
        View::set_global("media_path", url::base() . "media/");
        View::set_global("controller", $this->application_context->get_main_controller());
        View::set_global("controller_action", $this->application_context->get_main_controller_action());
        $language_code = $this->application_context->get_actual_language_code();
        View::set_global("language_code", $language_code);
        $is_indexpage = ($this->application_context->get_main_controller() == "page" && $this->application_context->get_main_controller_action() == "index") ? true : false;
        View::set_global("is_indexpage", $is_indexpage);
        View::set_global("tpl_dir", "application/views/");


        // nastaveni jazykove verze - globalni
        i18n::lang($language_code);
        // nacteni zakladnich dat o strance
        if (!$this->application_context->is_page_available()) {
            $this->auto_render = false;
            // pokud je stranka nedostupna, vyhodim 404 - chybovou vyjimku, nebo jen specialni sablonu se statusem 404
            //throw new Kohana_Exception("Stránka nenalezena 404");

            Request::instance()->status = 404;
            $this->request->response = View::factory('errors/404');
            return;
        } elseif ($this->application_context->get_actual_seo() == 'zbozi') {
	    $view = View::factory('feed/zbozi');
	    $products = Service_Product_Category::get_products_all();
	    $view->products = $products;
	    $this->request->headers['Content-Type'] = 'text/xml';
	    ob_clean();
	    $this->request->response = $view;
	    return;
	} elseif ($this->application_context->get_actual_seo() == 'heureka') {
	    $view = View::factory('feed/heureka');
	    $products = Service_Product_Category::get_products_all();
	   
	    $view->products = $products;
	    //$view->name = 'karel';
	    $this->request->headers['Content-Type'] = 'text/xml';
	    ob_clean();
	    // print_r($products);
	    $this->request->response = $view;
	    return;
	} else  {
            $seo = $this->application_context->get_actual_seo();
            $route_id = $this->application_context->get_route_id();

            //if($seo=="index")              Request::instance ()->redirect (url::base(), 302);
            // volani DC
            $main_ajax = false;
            if (isset($_GET["main_ajax"]) && $_GET["main_ajax"] == 1)
                $main_ajax = true;
            $data_controller = $this->application_context->get_data_manipulation_controller();
            $data_controller_action = $main_ajax ? $this->application_context->get_main_controller_action() : $this->application_context->get_data_manipulation_controller_action();
            // parametr pro DC: prioritu ma poslany z formulare, neni-li uveden, bere se stejny jako pro hlavni kontroler (VC) tj. param uvedeny v tabulce routes - zpravidla jde o redirect po uspesnem zpracovani dat
            $data_controller_param = ($this->application_context->get_data_manipulation_controller_action_param()) ? ("/" . $this->application_context->get_data_manipulation_controller_action_param()) : (($this->application_context->get_main_controller_parameters()) ? ("/" . $this->application_context->get_main_controller_parameters()) : "");

            if ($data_controller_action) {
                // bezpecnostni overeni zda se vola spravna metoda ve spravnem kontroleru "HMAC"

                if (!$main_ajax && !$this->application_context->validate_data_manipulation_secure_code($data_controller_action, $data_controller)) {
                    throw new Kohana_Exception("Validační hash kód formuláře je chybný! akce:" . $data_controller_action . ", kontroler " . $data_controller);
                }

                $result = Request::factory("internal/" . $data_controller . "/" . $data_controller_action . /* "/".$seo. */$data_controller_param)->execute()->response;
                // na zaklade vysledku ze zpracovani dat se provedou nasledujici akce
                if ($this->application_context->is_ajax()) {
                    // ajaxovy pozadavek
                    $this->auto_render = false;

                    // vygenerovani vsech "zaregistrovanych" widgetu a jejich navrat ve forme jsonu
                    $widgets = Hana_Widgets::instance();
                    $widgets->add_to_process("message", "internal/site/message"); // message kontroler bude registrovan vzdy
                    $response_array = $widgets->process();
                    $response_array["main_content"] = $result;
                    ob_clean();
                    echo(json_encode($response_array));
                    exit();
                } else {
                    // neajaxovy pozadavek
                    $obj_response = Hana_Response::instance();
                    if ($obj_response->get_redirect()) {
                        $redirect = is_string($obj_response->get_redirect()) ? $obj_response->get_redirect() : url::base() . $this->application_context->get_actual_seo();
                        Request::instance()->redirect($redirect);
                    }
                }
            }
            $this->template = new View('base_template');

            $page_name = $this->application_context->get_name();
            $page_title = $this->application_context->get_title();
            $page_description = $this->application_context->get_description();
            $page_keywords = $this->application_context->get_keywords();

            // volani VC (volani vsech widgetu probehne v ramci teto akce automaticky)
            $main_controller = $this->application_context->get_main_controller();
            $main_controller_action = $this->application_context->get_main_controller_action();
            $main_controller_param = ($this->application_context->get_main_controller_parameters()) ? ("/" . $this->application_context->get_main_controller_parameters()) : "";

            $main_content = Request::factory("internal/" . $main_controller . "/" . $main_controller_action . /* "/".$seo. */$main_controller_param)->execute()->response;

            /*if ($this->application_context->get_actual_seo() == "index") {
                $main_content = new View('homepage');
            }*/


            if ($this->application_context->is_ajax()) {
                // ajaxovy GET pozadavek - jen se posle result na vystup
                $this->auto_render = false;

                // zpracovani vsech widgetu urcenych ke zpracovani (ovlivnenych ajax pozadavkem - je nutno urcit manualne v prislusnem kontroleru)
                $widgets = Hana_Widgets::instance()->process();

                ob_clean();
                echo(json_encode(
                        array(
                            "main_content" => $main_content,
                            "page_name" => $page_name,
                            "page_title" => $page_title,
                            "page_description" => $page_description,
                            "page_keywords" => $page_keywords,
                            "widgets" => $widgets
                        )
                ));
                exit();
            } else {
                // vlozeni generovaneho obsahu kontroleru do hlavni sablony
                $this->template->page_name = $page_name;
                $this->template->page_title = $page_title;
                $this->template->page_description = $page_description;
                $this->template->page_keywords = $page_keywords;
                $this->template->main_content = $main_content;
                $this->template->actual_page = $this->application_context->get_actual_seo();
            }
        }


        $web_owner = $this->application_context->get_web_owner_data();
        $this->template->web_owner = $web_owner;
        $this->template->ga_script = Googleanalytics::getCode($web_owner->ga_script);

        $this->request->response = $this->template->render();
        // tot vse...
    }

    /**
     * Akcni metoda pro widget "message"
     */
    public function action_message() {
        $message = new View("message");
        $response = Hana_Response::instance();
        $message->status = $response->get_status();
        $message->messages = $response->get_and_delete_message();
        $this->request->response = $message->render();
    }

    /**
     * Zobrazi jazykovy selectbox
     */
    public function action_languagebox() {
        $languagebox = new View("language_box_widget");
        $languagebox->languages = Service_Route::get_baselang_links_group($this->application_context->get_actual_route());
        $languagebox->index_languages = Service_Route::get_baselang_links_group(Service_Route::get_page_route_by_nazev_seo('index'));
        $languagebox->all_langs = Kohana::$config->load('languages')->get("mapping");
        $this->request->response = $languagebox->render();
    }

    /**
     * Obecna akce na redirect (po vyberu jazykove verze apod)
     */
    public function action_redirect() {
        $redirect = Input::post("redirect", "");
        if ($redirect)
            Request::instance()->redirect(url::base() . $redirect);
    }

    

    public function after() {
        parent::after();

        // zobrazeni profileru (nutno povolit db profiler v config/database
        if ($this->application_context->get_web_setup_data()->kohana_debug_mode) {
            $this->request->response .= View::factory('profiler/stats');
        }

        // zobrazeni smarty debug okna
        if ($this->application_context->get_web_setup_data()->smarty_console) {
            
        }
    }

}

?>
