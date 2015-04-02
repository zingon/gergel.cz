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
<html>
    <head>
        <meta charset="UTF-8">
        <title>{$page_name} - {$page_title}</title>
        <link rel="stylesheet" href="{$media_path}css/main.css"/>
        <link rel="stylesheet" href="{$media_path}css/lightbox.css">
        <script src="{$media_path}js/jquery.js" type="application/javascript"></script>
        <script src="{$media_path}js/jqueryUI.js" type="application/javascript"></script>
        <script src="{$media_path}js/bxSlider/plugins/jquery.easing.1.3.js" type="application/javascript"></script>
        <script src="{$media_path}js/bxSlider/jquery.bxslider.min.js" type="application/javascript"></script>
        <script src="{$media_path}js/lightbox.js" type="application/javascript"></script>
        <script src="{$media_path}js/main.js" type="application/javascript"></script>
        <script src="{$media_path}js/pin.js" type="application/javascript"></script>
    </head>
    <body>
    <div id="pinned">
        <header class="wrapper row">
            <div class="col-sm-5">
                <a href="{$url_base}"><img src="{$media_path}img/layout/logo.png" alt="{$web_owner.default_title}"/></a>
            </div>
            <div class="col-sm-4">
                <h2>{translate str=$web_owner.default_description}</h2>
            </div>
            <div class="col-lg-3 pullRight">
                {widget controller="site" action="languagebox"}
            </div>
            
        </header>
        {widget controller="navigation" action="main"}
        {if $controller eq "catalog" and $controller_action eq "category"}
            {widget controller="navigation" action="category"}    
        {/if}
    </div>
        {if $url_actual!=$url_homepage}
            {widget controller="navigation" action="breadcrumbs"}
        {/if}

        {$main_content}

        <footer>
            <div class="footerTop">
                <div class="wrapper row">
                    <div class="col-sm-6">
                        {widget controller="contact" action="show"}
                    </div>
                    <div class="col-sm-6">
                        <h2>{translate str="Kde nás najdete"}</h2>
                        <div class="row">
                            <div class="col-sm-8">
                                <iframe src="{$web_owner.map_url}" height="186" frameborder="0" style="border:0"></iframe>
                            </div>
                            <div class="col-sm-4">
                                <p>
                                <strong>{$web_owner.default_title}</strong>
                                <br/>
                                {$web_owner.ulice}
                                <br/>
                                {$web_owner.psc}  {$web_owner.mesto}
                                <br/>
                                <br/>
                                email: {$web_owner.email}
                                <br/>
                                tel.: {$web_owner.tel}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="footerBottom">
                <div class="wrapper">
                    <strong>{$web_owner.copyright}</strong>
                    <div class="row">
                        <div class="col-sm-9">{translate str="realizace"}:
                            <a href="http://www.dgstudio.cz/" title="tvorba www stránek">{translate str="tvorba www stránek"}</a> |
                            <a href="http://www.virtualni-prohlidky.eu/" title="virtuální prohlídky">{translate str="virtuální prohlídky"}</a> |
                            <a href="http://validator.w3.org/check/referer" title="HTML validátor">HTML5</a> |
                            <a href="http://jigsaw.w3.org/css-validator/" title="CSS validator">CSS 3</a>
                        </div>
                        <div class="col-sm-3">
                            <a href="http://www.dgstudio.cz/" title="DG Studio" id="dgLogo"><div></div></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>