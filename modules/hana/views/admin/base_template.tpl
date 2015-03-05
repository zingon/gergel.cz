{* zakladni sablona systemu Hana 2 - copyright 2011 Pavel Herink *}
<!DOCTYPE html>
<html lang=cs>	
  <head>		
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />		
    <meta name="author" content="Pavel Herink" />		
    <meta name="copyright" content="2011" />		
    <meta name="description" content="Systém pro správu obsahu Hana verze 2" />		
    <meta name="keywords" content="" />	
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    	
    <link rel="stylesheet" href="{$media_path}admin/css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="{$media_path}admin/css/style-print.css" type="text/css" media="print" />
      <link rel="stylesheet" href="{$media_path}admin/css/jquery-ui-1.8.6.custom.css" type="text/css" />
    <link rel="stylesheet" href="{$media_path}admin/css/showLoading.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="{$media_path}admin/css/agile-uploader.css" type="text/css" media="screen" />


    <link rel="stylesheet" href="{$media_path}admin/js/jquery-lightbox/css/jquery.lightbox.css" type="text/css" />
    <link rel="stylesheet" href="{$media_path}admin/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="{$media_path}admin/css/bootstrap-datetimepicker.min.css" type="text/css" />
    <link rel="stylesheet" href="{$media_path}admin/css/bootstrap-colorpicker.min.css" type="text/css" />
      {*<link rel="stylesheet" href="{$media_path}admin/css/bootstrap-theme.css" type="text/css" />*}

      <script type="text/javascript" src="{$media_path}admin/js/jquery-1.7.1.min.js"></script>
      <script type="text/javascript" src="{$media_path}admin/js/jquery-ui-1.8.18.custom.min.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/bootstrap.min.js"></script>
    {*<script type="text/javascript" src="{$media_path}admin/js/fckeditor/fckeditor.js"></script>*}
    <script type="text/javascript" src="{$media_path}admin/js/ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="{$media_path}admin/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/locales/bootstrap-datetimepicker.cs.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/daterangepicker.jQuery.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/jquery.showLoading.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/jquery.tristateCheckbox.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/jquery.tablednd.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/jquery-lightbox/js/jquery.lightbox.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/bootstrap-colorpicker.min.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/jquery.uploadify.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="{$media_path}admin/js/admin.js"></script>
    
    <title>{$title} - administrační rozhranní</title>	
    
    <script type="text/javascript">
    /* <![CDATA[ */ 
    $(function(){
     $.Lightbox.construct({
        "base_url":    "{$url_base}"  
    });


    /* ]]> */

    });
    </script>{literal}
          <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart', 'geochart']});
    </script>
      {/literal}
  </head>
  <body>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
		  <!-- hlavicka -->
		      <header>
			<!--  hlavni menu L1 -->
                {if !empty($admin_menu_L1_L2)}				
	              <nav class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{$url_base}" data-toggle="popover" data-trigger="hover" data-content="You will be redirected to the frontend.">{$web_owner.default_title}</a>
                    </div>
                    <div class="collapse navbar-collapse" id="main-navbar-collapse-1">
                        <ul class="navbar-nav nav">
                        {foreach key=k item=link name=nav from=$admin_menu_L1_L2}
                            {if $link.global_access_level<=$role_level}
                                <li class="{if $link.has_childs}dropdown {/if}{if isset($link.sel)}active{/if}">
                                    <a href="{if $link.has_childs}#{else}{$link.href}{/if}" {if $link.has_childs}class="dropdown-toggle" data-toggle="dropdown"{/if}>{$link.nazev} {if $link.has_childs}<b class="caret"></b>{/if}</a>
                                    {if $link.has_childs}
                                        <ul class="dropdown-menu">
                                            <li><a href="{$link.href}">{$link.nazev}</a></li>
                                            <li class="divider"></li>
                                            {foreach from=$link.childs item=child}
                                            <li class="{if isset($child.sel)}active{/if}"><a href="{$child.href}">{$child.nazev}</a>
                                            {/foreach}
                                        </ul>
                                    {/if}
                                </li>
                                
                            {/if}
                        {/foreach}
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            {* odkaz na odhlaseni - staticky *}
                            <li><a href="{$url_base}admin/logout">Odhlásit</a></li>
                        </ul>
                    </div>   
		          </nav>
	            {/if}	
		      </header>
		  </div>
        </div>
		<!-- submenu L2 -->
		{if !empty($admin_menu_L2)}
		<div id="SubnavSection">			
  		<ul>
        {foreach key=k item=link name=nav from=$admin_menu_L2}
          {if $link.global_access_level<=$role_level}
          <li>
            <a href="{$link.href}" {if isset($link.sel)}class="sel"{/if}>{$link.nazev}</a>
          </li>
          {/if}
        {/foreach}
  		</ul>
		</div>
		{/if}
		
		<!-- stredni cast -->	
		<div class="row">	
		  {if !empty($center_section)}{$center_section}{/if}		  
		  <!-- leve menu -->
  		  {if !empty($admin_menu_L3)} 
         
		  <div class="col-md-2 sidebar-offcanvas">
              <div class="well">
            <ul class="nav nav-pills nav-stacked">
    		      {foreach key=k item=link from=$admin_menu_L3 name=admLeft}
    			     {if $link.global_access_level<=$role_level}
                         <li {if isset($link.sel)}class="active"{/if}><a href="{$link.href}">{$link.nazev}</a></li>
                    {/if}
                  {/foreach} 
            </ul>
          </div>
              </div>
  		  {/if}		
			<!-- hlavni obsah -->
          <div class="col-md-{if !empty($admin_menu_L3)}10{else}12{/if}" id="ContentSection">
		     {if !empty($admin_content)}{$admin_content}{/if}
		  </div>
          <!--  patička -->
          <div class="col-xs-12">
  	                        <footer>
  			   <p class="text-right">Powered by <a href="#" title="">HANA 2</a> CMS (v2.6)</p>
  			   {*<div class="right"><a href="#" title="Realizace">Realizace</a></div>*}
  	         </footer>
          </div>
		</div>
      </div>
    </body>
</html>