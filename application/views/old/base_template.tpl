{* 
   CMS system Hana ver. 2.6 (C) Pavel Herink 2012
   zakladni spolecna sablona layoutu stranek
   
   automaticky generovane promenne spolecne pro vsechny sablony:
   -------------------------------------------------------------
   $url_base      - zakladni url
   $tpl_dir       - cesta k adresari se sablonama - pro prikaz {include}
   $url_actual    - autualni url
   $url_homepage  - cesta k homepage
   $media_path    - zaklad cesty do adresare "media/" se styly, obrazky, skripty a jinymi zdroji
   $controller
   $controller_action
   $language_code - kod aktualniho jazyku
   $is_indexpage  - priznak, zda jsme na indexove strance
   
   $web_setup     - pole se zakladnim nastavenim webu a udaji o tvurci (DB - admin_setup)
   $web_owner     - pole se zakladnimi informacemi o majiteli webu - uzivatelske informace (DB owner_data)
   -------------------------------------------------------------
   
   doplnujici custom Smarty funkce 
   -------------------------------------------------------------
   {translate str="nazev"}                                      - prelozeni retezce
   {static_content code="index-kontakty"}                       - vlozeni statickeho obsahu 
   {widget name="nav" controller="navigation" action="main"}    - vlozeni widgetu - parametr "name" je nepovinny, parametr "action" je defaultne (pri neuvedeni) na hodnote "widget" 
   {hana_secured_post action="add_item" [module="shoppingcart"]}        nastaveni akce pro zpracovani formulare (interni overeni parametru))
   {hana_secured_multi_post action="obsluzna_akce_kontroleru" [submit_name = ""] [module="nazev_kontoleru"]}
   {$product.cena|currency:$language_code} 
   
   Promenne do base_template:
   -------------------------------------------------------------  
   {$page_description} 
   {$page_keywords}
   {$page_name} - {$page_title}
   {$main_content}

   {include file="`$tpl_dir`dg_footer.tpl"}

   {if !empty($web_owner.ga_script)}

    {$web_owner.ga_script}

    {/if}
   
   
*}

<!DOCTYPE html>
<html lang="cs">
  <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <meta name="copyright" content="{$web_owner.copyright}" />
      <meta name="keywords" content="{$page_keywords}" />
      <meta name="description" content="{$page_description} " />
      <meta name="robots" content="all,follow" />
      <meta name="googlebot" content="snippet,archive" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      {*<meta name="theme-color" content="#3F51B5">*}
      <link type="text/css" href="{$media_path}css/normalize.css" rel="stylesheet" media="all" />
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700&amp;subset=latin-ext' rel='stylesheet' type='text/css'>
      <link type="text/css" href="{$media_path}css/foundation-icons.css" rel="stylesheet" media="all" />
      <link type="text/css" href="{$media_path}css/foundation.css" rel="stylesheet" media="all" />
      <link type="text/css" href="{$media_path}css/helpers/jquery.fancybox-thumbs.css" rel="stylesheet" media="all" />
      <link type="text/css" href="{$media_path}css/jquery.fancybox.css" rel="stylesheet" media="all" />
      <link type="text/css" href="{$media_path}css/responsive-tables.css" rel="stylesheet" media="all" />
      <link type="text/css" href="{$media_path}css/jcarousel.css" rel="stylesheet" media="all" />
      <link type="text/css" href="{$media_path}css/fonts.css" rel="stylesheet" media="all" />
      <link type="text/css" href="{$media_path}css/style.css" rel="stylesheet" media="all" />

      <!--[if lte IE 9]>
      <script type="text/javascript" src="{$media_path}/js/jquery-1.11.1.min.js"></script>
      <script type="text/javascript" src="{$media_path}/js/respond.min.js"></script>
      <![endif]-->
      <!--[if !IE]> -->
      <script type="text/javascript" src="{$media_path}/js/jquery-2.1.1.min.js"></script>
      <!-- <![endif]-->
      <script type="text/javascript" src="{$media_path}js/modernizr.min.js"></script>
      <script type="text/javascript" src="{$media_path}js/jquery.fancybox.pack.js"></script>
      <script type="text/javascript" src="{$media_path}js/helpers/jquery.fancybox-thumbs.js"></script>
      <script type="text/javascript" src="{$media_path}js/foundation.min.js"></script>
      <script type="text/javascript" src="{$media_path}js/responsive-tables.js"></script>
      <script type="text/javascript" src="{$media_path}js/jcarousel.min.js"></script>
      <script type="text/javascript" src="{$media_path}js/main.js"></script>

      <title>{$page_name} - {$page_title}</title>
      
  </head>
  <body>
  {widget controller=site action=message}
  <header>
      <div class="row">
          <div class="small-12 column">
              <section class="row" id="top">
                  <div class="small-6 columns">
                      <a href="{$url_homepage}">
                          <img src="{$media_path}img/logo.jpg" alt="{$web_owner.default_title}" id="main-logo">
                      </a>
                  </div>
                  <div class="small-6 columns">
                      <a href="https://orbtrack.eu"><img src="{$media_path}img/portal.png"></a>
                  </div>
              </section>
          </div>
      </div>
  </header>
  {widget controller=navigation action=main}
  <section id="content">
      {$main_content}
  </section>
  <footer>
      <div class="row">
          <div class="small-8 text-left columns">
              Copyright {$web_owner.copyright} Orbcomm Czech republic s.r.o.
          </div>
          <div class="small-4 text-right columns dg">
              {translate str="Realizace"}: <a href="http://www.dgstudio.cz"><img src="{$media_path}img/dg_logo.png" alt="dg studio" title="DG Studio" id="dg-logo"></a>
          </div>
      </div>
  </footer>


  {if !empty($web_owner.ga_script)}
      {$web_owner.ga_script}
  {/if}
  <script type="text/javascript" src="{$media_path}/js/rem.js"></script>

  </body>
</html>