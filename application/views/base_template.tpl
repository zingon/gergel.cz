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
	<title></title>
</head>
<body>
   Gergel <br>
   {widget controller="navigation" action="main"} 

	{$main_content}
</body>
</html>