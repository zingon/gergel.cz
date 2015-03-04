<?php defined('SYSPATH') or die('No direct script access.');

//-- Environment setup --------------------------------------------------------
$development_base_url="http://localhost/";
$production_base_url="/"; // pokud neni pouzit mod rewrite, je nutno nastavit nazev domeny

/**
* Set the environment string by the domain (defaults to 'development').
*/
Kohana::$environment = Kohana::PRODUCTION; //($_SERVER['SERVER_NAME'] !== 'localhost') ? Kohana::PRODUCTION : Kohana::DEVELOPMENT
/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Prague');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

//-- Configuration and initialization -----------------------------------------

/**
 * Initialize Kohana, setting the default options. (Initialise Kohana based on environment)
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
  
  Kohana::init(array(
    'base_url'   => '/',
    'index_file' => false,
    'profile'    => Kohana::$environment !== Kohana::PRODUCTION,
    'caching'    => Kohana::$environment === Kohana::PRODUCTION,
  ));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

i18n::lang('cs-cz');

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
  'smarty'       => MODPATH.'smarty',   // Smarty module
  'auth'       => MODPATH.'auth',       // Basic Authentication
  'shauth'       => MODPATH.'shauth',   // Basic Authentication - shopper
  'cache'      => MODPATH.'cache',      // Caching with multiple backends
// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
  'database'   => MODPATH.'database',   // Database access
  'image'      => MODPATH.'image',      // Image manipulation
  'orm'        => MODPATH.'orm',        // Object Relationship Mapping
// 'oShauth'      => MODPATH.'oShauth',      // OShauth Shauthentication
  'pagination' => MODPATH.'pagination', // Paging of results
  'purifier' => MODPATH.'purifier',     // Purifier
// 'unittest'   => MODPATH.'unittest',   // Unit testing
  'captcha' => MODPATH.'captcha',       // Captcha
  'sitemap' => MODPATH.'sitemap',       // Google Sitemap
  'hana'       => MODPATH.'hana',       // Hana module
  'googleanalytics'       => MODPATH.'googleanalytics',       // GA

  'userguide'  => MODPATH.'userguide',  // User guide and API documentation
 ));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

// routa smerujici vsechny subrequesty (HMVC) na prislusny kontorler
Route::set('internal', 'internal/<controller>/<action>(/<id1>(/<id2>(/<id3>(/<id4>(/<id5>(/<id6>(/<id7>)))))))')
	->defaults(array(
		'action'     => 'index',
	));

// routa smerujici vsechny subrequesty (HMVC) na prislusny kontorler
Route::set('external', 'external/<action>(/<id1>(/<id2>(/<id3>(/<id4>(/<id5>(/<id6>(/<id7>)))))))')
	->defaults(array(
		//'controler'     => 'external',
                'action'     => 'index',
	));

// zakladni routa smerujici pozadavky z url adresy na zakladni HMVC kontroler "site"
Route::set('default', '(<id1>(/<id2>(/<id3>)))')
	->defaults(array(
		'controller' => 'site',
		'action'     => 'index',
	));


if ( ! defined('SUPPRESS_REQUEST'))
{
	/**
	 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
	 * If no source is specified, the URI will be automatically detected.
	 */
	 try
         {
             $request=Request::instance();
	 
             // Attempt to execute the response
             $request->execute();
         }
         catch (Exception $e)
         {
             if (Kohana::$environment != Kohana::PRODUCTION)
             {
                 // Just re-throw the exception
                 throw $e;
             }
             echo $e;

             // Log the error
             Kohana::$log->add(Kohana::ERROR, Kohana::exception_text($e));

             // Create a 404 response
//             $uri="";
//             $request=Request::instance($uri);
             
             Request::instance()->status = 404;
             $request->response="Stránka nebyla nalezena 404";
             
             
//             $request->response = View::factory('base_template')
//             ->set('title', '404');
//             ->set('links',Service_Page::instance()->get_navigation_structure())
//             //->set('sel_links',Service_Page::instance()->get_selected_navigation_links("site"))
//             ->set('breadcrumb',View::factory('breadcrumbs'))
//             ->set('data',array(array("nazev"=>__("Domů"),"nazev_seo"=>"/"),array("nazev"=>__("Požadovaná stránka nebyla nalezena")." (404) ","nazev_seo"=>"404")))
//             ->set('sitemap', View::factory('sitemap'))
//             ->set('url_base', url::base())
//             ->set('media_path', url::base()."media/")
//             ->set('main_content', View::factory('errors/404'))
//             ->set('nav', View::factory('nav'))
//             ->set('contactform',Request::factory("internal/contactform/index/".urlencode(str_replace(".", "___","Stránka nenalezena"))."/error/error_form")->execute()->response);
         }

         echo $request->send_headers()->response;
}
