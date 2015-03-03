<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Zakladni administracni zabezpeceny kontroler.
 */

abstract class Controller_Hana_Auth extends Controller_Template{

        public $template="admin/admin_content";

        protected $cache=true; // globalni nastaveni, pokud je na frontendu pouzita cache, musim se v seznamech i v editech postarat o jeji mazani

        // spolecne automaticky generovane interni promenne
        protected $item_id; // id editovane polozky ziskane ze segmentu adresy
        protected $item_page;

        // ormko s informacemi o konkretnim editu
        protected $module_informations_orm;

        protected $module_key; // modulovy klic
        protected $submodule_key; // submodulovy klic
        protected $subaction_key;

        protected $submodule_description; // strucny popis cinnosti kontroleru
        
        protected $owner;

        protected $language = "cz";


        // Controls access for the whole controller, if not set to FALSE we will only allow user roles specified
        // Can be set to a string or an array, for example 'login' or array('login', 'admin')
        // Note that in second(array) example, user must have both 'login' AND 'admin' roles set in database
        public $auth_required = array('login', 'admin');

        
        public function before()
        {
          parent::before();

          // zjisteni informaci z requestu a nacteni informaci o pozadovanem modulu
            $this->segment1=Request::instance()->param("page");
            $this->item_page=$this->segment1?$this->segment1:1;
            $this->item_id=$this->segment1=Request::instance()->param("id");
            $this->language=Request::instance()->param("language");
            $this->module_key=Request::instance()->param("module");
            $this->submodule_key=Request::instance()->param("submodule");
            $this->subaction_key=Request::instance()->param("subaction");

            $languages = Kohana::config('languages');
            $language_id = array_search($this->language, $languages["mapping"]);

            $this->module_informations_orm=orm::factory("admin_structure")
                ->where("module_code","=",$this->module_key)
                ->where("submodule_code","=",$this->submodule_key)
                ->language($language_id)
                ->order_by("admin_menu_section_id","desc")
                ->find();

          
          $this->session= Session::instance();

          // validace a uvereni bezpecnostnich pravidel
          $action_name = Request::instance()->action;
          if (Auth::instance()->logged_in($this->auth_required) === FALSE && Auth::instance()->logged_in(array("global_admin")) === FALSE)
    	  {
	  	  if (Auth::instance()->logged_in()){
			  Request::instance()->redirect('admin/noaccess');
		  }else{
			  Request::instance()->redirect('admin/login');
		  }
	  }

          // nastaveni nazvu a zakladni konfigurace
          $this->template->submodule_title=$this->module_informations_orm->nadpis;
          $this->template->submodule_description=$this->submodule_description;
          
          $this->owner=orm::factory("owner",1);


      }


}
