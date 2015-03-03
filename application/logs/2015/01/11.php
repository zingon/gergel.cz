<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-01-11 23:03:09 --- ERROR: Kohana_Exception [ 0 ]: Smarty - Widget Error: (url):catalog/homepage_widget/index: exception 'ErrorException' with message 'Undefined index: sec_src' in /var/www/dgsbeta.cz/domains/orbcomm/application/cache/smarty/compile/3aeabe66c961f056154dc2110e03b8e4675a1a81.file.homepage_widget.tpl.php:61
Stack trace:
#0 /var/www/dgsbeta.cz/domains/orbcomm/application/cache/smarty/compile/3aeabe66c961f056154dc2110e03b8e4675a1a81.file.homepage_widget.tpl.php(61): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/dgsbet...', 61, Array)
#1 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/vendor/smarty/sysplugins/smarty_internal_templatebase.php(180): content_54a0ade6553f58_91363556(Object(Smarty_Internal_Template))
#2 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(118): Smarty_Internal_TemplateBase->fetch()
#3 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(40): View::capture(Object(Smarty_Internal_Template), Array)
#4 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/catalog.php(126): View->render()
#5 [internal function]: Controller_Catalog->action_homepage_widget('index')
#6 /var/www/dgsbeta.cz/domains/orbcomm/system/classes/kohana/request.php(1112): ReflectionMethod->invokeArgs(Object(Controller_Catalog), Array)
#7 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.widget.php(50): Kohana_Request->execute()
#8 /var/www/dgsbeta.cz/domains/orbcomm/application/cache/smarty/compile/b38d4718d10b1580412b6991864337e38b3b7c94.file.homepage.tpl.php(60): smarty_function_widget(Array, Object(Smarty_Internal_Template))
#9 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/vendor/smarty/sysplugins/smarty_internal_templatebase.php(180): content_54a0ade640ddc3_28328553(Object(Smarty_Internal_Template))
#10 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(118): Smarty_Internal_TemplateBase->fetch()
#11 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(40): View::capture(Object(Smarty_Internal_Template), Array)
#12 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/page.php(25): View->render()
#13 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/page.php(38): Controller_Page->action_index()
#14 [internal function]: Controller_Page->action_detail()
#15 /var/www/dgsbeta.cz/domains/orbcomm/system/classes/kohana/request.php(1112): ReflectionMethod->invokeArgs(Object(Controller_Page), Array)
#16 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/site.php(121): Kohana_Request->execute()
#17 [internal function]: Controller_Site->action_index()
#18 /var/www/dgsbeta.cz/domains/orbcomm/system/classes/kohana/request.php(1112): ReflectionMethod->invokeArgs(Object(Controller_Site), Array)
#19 /var/www/dgsbeta.cz/domains/orbcomm/application/bootstrap.php(139): Kohana_Request->execute()
#20 /var/www/dgsbeta.cz/domains/orbcomm/index.php(103): require('/var/www/dgsbet...')
#21 {main} ~ MODPATH/smarty/plugins/function.widget.php [ 54 ]
2015-01-11 23:03:09 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:11 --- ERROR: Kohana_Exception [ 0 ]: Smarty - Widget Error: (url):catalog/homepage_widget/index: exception 'ErrorException' with message 'Undefined index: sec_src' in /var/www/dgsbeta.cz/domains/orbcomm/application/cache/smarty/compile/3aeabe66c961f056154dc2110e03b8e4675a1a81.file.homepage_widget.tpl.php:61
Stack trace:
#0 /var/www/dgsbeta.cz/domains/orbcomm/application/cache/smarty/compile/3aeabe66c961f056154dc2110e03b8e4675a1a81.file.homepage_widget.tpl.php(61): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/dgsbet...', 61, Array)
#1 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/vendor/smarty/sysplugins/smarty_internal_templatebase.php(180): content_54a0ade6553f58_91363556(Object(Smarty_Internal_Template))
#2 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(118): Smarty_Internal_TemplateBase->fetch()
#3 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(40): View::capture(Object(Smarty_Internal_Template), Array)
#4 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/catalog.php(126): View->render()
#5 [internal function]: Controller_Catalog->action_homepage_widget('index')
#6 /var/www/dgsbeta.cz/domains/orbcomm/system/classes/kohana/request.php(1112): ReflectionMethod->invokeArgs(Object(Controller_Catalog), Array)
#7 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.widget.php(50): Kohana_Request->execute()
#8 /var/www/dgsbeta.cz/domains/orbcomm/application/cache/smarty/compile/b38d4718d10b1580412b6991864337e38b3b7c94.file.homepage.tpl.php(60): smarty_function_widget(Array, Object(Smarty_Internal_Template))
#9 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/vendor/smarty/sysplugins/smarty_internal_templatebase.php(180): content_54a0ade640ddc3_28328553(Object(Smarty_Internal_Template))
#10 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(118): Smarty_Internal_TemplateBase->fetch()
#11 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(40): View::capture(Object(Smarty_Internal_Template), Array)
#12 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/page.php(25): View->render()
#13 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/page.php(38): Controller_Page->action_index()
#14 [internal function]: Controller_Page->action_detail()
#15 /var/www/dgsbeta.cz/domains/orbcomm/system/classes/kohana/request.php(1112): ReflectionMethod->invokeArgs(Object(Controller_Page), Array)
#16 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/site.php(121): Kohana_Request->execute()
#17 [internal function]: Controller_Site->action_index()
#18 /var/www/dgsbeta.cz/domains/orbcomm/system/classes/kohana/request.php(1112): ReflectionMethod->invokeArgs(Object(Controller_Site), Array)
#19 /var/www/dgsbeta.cz/domains/orbcomm/application/bootstrap.php(139): Kohana_Request->execute()
#20 /var/www/dgsbeta.cz/domains/orbcomm/index.php(103): require('/var/www/dgsbet...')
#21 {main} ~ MODPATH/smarty/plugins/function.widget.php [ 54 ]
2015-01-11 23:03:12 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:12 --- ERROR: Kohana_Exception [ 0 ]: Smarty - Widget Error: (url):catalog/homepage_widget/index: exception 'ErrorException' with message 'Undefined index: sec_src' in /var/www/dgsbeta.cz/domains/orbcomm/application/cache/smarty/compile/3aeabe66c961f056154dc2110e03b8e4675a1a81.file.homepage_widget.tpl.php:61
Stack trace:
#0 /var/www/dgsbeta.cz/domains/orbcomm/application/cache/smarty/compile/3aeabe66c961f056154dc2110e03b8e4675a1a81.file.homepage_widget.tpl.php(61): Kohana_Core::error_handler(8, 'Undefined index...', '/var/www/dgsbet...', 61, Array)
#1 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/vendor/smarty/sysplugins/smarty_internal_templatebase.php(180): content_54a0ade6553f58_91363556(Object(Smarty_Internal_Template))
#2 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(118): Smarty_Internal_TemplateBase->fetch()
#3 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(40): View::capture(Object(Smarty_Internal_Template), Array)
#4 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/catalog.php(126): View->render()
#5 [internal function]: Controller_Catalog->action_homepage_widget('index')
#6 /var/www/dgsbeta.cz/domains/orbcomm/system/classes/kohana/request.php(1112): ReflectionMethod->invokeArgs(Object(Controller_Catalog), Array)
#7 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.widget.php(50): Kohana_Request->execute()
#8 /var/www/dgsbeta.cz/domains/orbcomm/application/cache/smarty/compile/b38d4718d10b1580412b6991864337e38b3b7c94.file.homepage.tpl.php(60): smarty_function_widget(Array, Object(Smarty_Internal_Template))
#9 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/vendor/smarty/sysplugins/smarty_internal_templatebase.php(180): content_54a0ade640ddc3_28328553(Object(Smarty_Internal_Template))
#10 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(118): Smarty_Internal_TemplateBase->fetch()
#11 /var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/classes/view.php(40): View::capture(Object(Smarty_Internal_Template), Array)
#12 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/page.php(25): View->render()
#13 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/page.php(38): Controller_Page->action_index()
#14 [internal function]: Controller_Page->action_detail()
#15 /var/www/dgsbeta.cz/domains/orbcomm/system/classes/kohana/request.php(1112): ReflectionMethod->invokeArgs(Object(Controller_Page), Array)
#16 /var/www/dgsbeta.cz/domains/orbcomm/application/classes/controller/site.php(121): Kohana_Request->execute()
#17 [internal function]: Controller_Site->action_index()
#18 /var/www/dgsbeta.cz/domains/orbcomm/system/classes/kohana/request.php(1112): ReflectionMethod->invokeArgs(Object(Controller_Site), Array)
#19 /var/www/dgsbeta.cz/domains/orbcomm/application/bootstrap.php(139): Kohana_Request->execute()
#20 /var/www/dgsbeta.cz/domains/orbcomm/index.php(103): require('/var/www/dgsbet...')
#21 {main} ~ MODPATH/smarty/plugins/function.widget.php [ 54 ]
2015-01-11 23:03:13 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:32 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: media/photos/catalog/category/images-24/-t1.png ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:32 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: media/photos/catalog/category/images-1/-t1.png ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:34 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:41 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:43 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:49 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:52 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:54 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:56 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:03:58 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:03 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:05 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:08 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:15 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:15 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:21 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:28 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:35 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:42 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:43 --- ERROR: Kohana_Exception [ 0 ]: The contact_form property does not exist in the Model_Catalog_Category class ~ MODPATH/orm/classes/kohana/orm.php [ 375 ]
2015-01-11 23:04:43 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:58 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:04:58 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:05:46 --- ERROR: ErrorException [ 2 ]: mkdir() [function.mkdir]: Unable to access /var/www/dgsbeta.cz/domains/orbcomm/media/photos/catalog/category/images-26/ ~ MODPATH/hana/classes/service/hana/file.php [ 81 ]
2015-01-11 23:05:47 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:06:21 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:06:21 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:06:23 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:06:25 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:06:26 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:06:31 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:06:35 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:06:38 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: media/img/product-image-cointainer-big-white.png ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:06:38 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:07:39 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:07:40 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:07:50 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:07:58 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:08:03 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: media/img/product-image-cointainer-big-white.png ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:08:03 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:08:26 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:08:30 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: media/admin/js/fileman/Upload ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:08:30 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]
2015-01-11 23:08:32 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: favicon.ico ~ SYSPATH/classes/kohana/request.php [ 674 ]