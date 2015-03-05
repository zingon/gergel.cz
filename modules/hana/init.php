<?php defined('SYSPATH') or die('No direct script access.');

//Route::set('default', '<directory>/<controller>/<action>/<id>', array('directory' => '.+?'))
//    ->defaults(array(
//        'directory'  => 'admin',
//        'controller' => 'welcome',
//        'action'     => 'index',
//        'id'         => '10',
//    ));

//Route::set('admin', 'admin/(<directory>(/<controller>))', array('directory' => '.+?'))
//    ->defaults(array(
//    'directory' => 'admin',
//    'controller' => 'default',
//    'action' => 'index',
//    ));

// routa zajistujici vstup do jednotlivych modulu adminu
//Route::set('admin', '<directory>/<controller>(/<id1>(/<id2>))', array('directory' => '^admin/.+?', 'controller' => 'default|list|edit|photoEdit'))
//  ->defaults(array(
//    'controller' => 'list',
//    'action'     => 'index',
//));

// zakladni routa smerujici pozadavky na admin
Route::set('admin', 'admin(/<action>)', array())
	->defaults(array(
		'controller' => 'admin',
		'action'     => 'login',
	));

     
Route::set('admin_internal', 'admin-internal/<directory>/<controller>(/<id>)', array('directory' => '.+?','id'=>'[0-9]+'))
  ->defaults(array(
    'controller' => 'list',
    'action'     => 'index',
));


// routa smerujici vsechny pozadavky s prvnim segmentem "admin" na zakladni kontroler adminu
Route::set('base_admin', '<controller>(/<language>(/<module>(/<submodule>(/<subaction>(/<page>(/<id>))))))',array('controller' => 'admin'))
  ->defaults(array(
        'controller' => 'admin',
        'action'     => 'index',
));
 
// docasna testovaci routa
Route::set('test', '<controller>(/<action>(/<id1>(/<id2>)))',array('controller' => 'test'))
  ->defaults(array(
        'action'     => 'index',
));

//Route::set('admin', '<directory>(/<controller>(/<id>))', array('directory' => '^admin/.+?'))
//  ->defaults(array(
//    'controller' => 'list',
//    'action'     => 'index',
//  ));



//// Static file serving (CSS, JS, images)
//Route::set('docs/media', 'guide/media(/<file>)', array('file' => '.+'))
//	->defaults(array(
//		'controller' => 'userguide',
//		'action'     => 'media',
//		'file'       => NULL,
//	));
//
//if (Kohana::config('userguide.api_browser') === TRUE)
//{
//	// API Browser
//	Route::set('docs/api', 'guide/api(/<class>)', array('class' => '[a-zA-Z0-9_]+'))
//		->defaults(array(
//			'controller' => 'userguide',
//			'action'     => 'api',
//			'class'      => NULL,
//		));
//}
//
//// Translated user guide
//Route::set('docs/guide', 'guide(/<page>)', array(
//		'page' => '.+',
//	))
//	->defaults(array(
//		'controller' => 'userguide',
//		'action'     => 'docs',
//	));

