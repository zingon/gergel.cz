<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">	
  <head>		
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />		
    <meta http-equiv="content-language" content="cs" />		
    <meta name="author" content="" />		
    <meta name="copyright" content="" />		
    <meta name="description" content="" />		
    <meta name="keywords" content="" />	
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
    	
    <link rel="stylesheet" href="{$media_path}admin/css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="{$media_path}admin/css/jquery-ui-1.8.6.custom.css" type="text/css" />
    <link rel="stylesheet" href="{$media_path}admin/css/showLoading.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="{$media_path}admin/js/ui.daterangepicker.css" type="text/css" />
    
    <script type="text/javascript" src="{$media_path}admin/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/jquery-ui-1.8.5.custom.min.js"></script>  
    <script type="text/javascript" src="{$media_path}admin/js/fckeditor/fckeditor.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/ui.datepicker-cs.js"></script>
    <script type="text/javascript" src="{$media_path}admin/js/daterangepicker.jQuery.js"></script>
    
    <script type="text/javascript" src="{$media_path}js/jquery.showLoading.js"></script>
    
    <script type="text/javascript" src="{$media_path}admin/js/admin.js"></script>
    
    
    
    <title>{$title} - administrační rozhranní</title>	
    
    {*
    <script type="text/javascript" src="{$media_path}js/jquery-ui-1.7.2.custom/js/jquery-1.3.2.min.js"></script> 
    <script type="text/javascript" src="{$media_path}js/jquery-ui-1.7.2.custom/js/jquery-ui-1.7.2.custom.min.js"></script> 
    
    <script type="text/javascript" src="{$media_path}js/jquery.js"></script>
    <script type="text/javascript" src="{$media_path}js/jquery-ui-personalized.js"></script>
     
    <script type="text/javascript" src="{$media_path}js/jquery-localscroll.js"></script>
    <script type="text/javascript" src="{$media_path}js/alert-dialog.js"></script>
    <script type="text/javascript" src="{$media_path}js/tablednd.js"></script>
    <script type="text/javascript" src="{$media_path}js/ui.datepicker-cs.js"></script>
    
    *}
    
  </head>
  <body>
  {if $main_logo}
  <div id="MainLogo"><a href="{$main_logo.url}" target="_blank"><img src="{$media_path}{$main_logo.src}" alt="{$main_logo.title}" title="{$main_logo.title}" /></a></div>
  {/if}
  
  
  <div id="Page">
		<!-- hlavicka -->
		<div id="Header">
			<div class="left">
			
			</div>
      <div class="right"> 
        
      <!--  hlavni menu L1 -->
      {if count($admin_menu_L1)}				
				<ul id="Nav">
          {foreach key=k item=link name=nav from=$admin_menu_L1}
            {if $link.global_access_level<=$role_level}
            <li{if isset($link.sel)} class="sel"{/if}>
              <a href="{$link.href}">{$link.nazev}</a>
            </li>
            {/if}
          {/foreach}
            {* odkaz na odhlaseni - staticky *}
            
            <li>
              <a href="{$url_base}admin/logout">odhlásit</a>
            </li>
            
				</ul>
			{/if}	
			</div>
		</div>
		
		<!-- submenu L2 -->
		{if count($admin_menu_L2)>0}
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
		{else}
		<div id="SubnavSectionSpacing"></div>
		{/if}
		
		<!-- stredni cast -->	
		<div id="CenterSection">	
		  {$center_section}
		  
			{if $admin_title}<h1>{$admin_title}</h1>{/if}
		  
		  <!-- leve menu -->
		  <div id="LeftSection">
  		  {if count($admin_menu_L3)>0}
  		  <div class="box" id="ModuleLinks">
  			  <div class="top"></div>
  			  <div class="content">
            <ul>
    					{foreach key=k item=link from=$admin_menu_L3 name=admLeft}
    					    {if $link.global_access_level<=$role_level}
                  <li {if $smarty.foreach.admLeft.last}class="last"{/if}>
                    <a {if isset($link.sel)}class="sel"{/if} href="{$link.href}">{$link.nazev}</a>
                  </li>
                  {/if}
                {/foreach}
    				</ul>
  				</div>
  				<div class="bottom"></div>
  			</div>
  			{/if}
			</div>
			
			<!-- hlavni obsah -->
      <div id="ContentSection">
		     {$admin_content}
			</div>

		</div>

		

		<div class="correct"></div>
		
		<!--  patička -->
  
    {*
		<div id="Footer">
			<div class="left">Powered by <a href="#" title="">HANA</a> system</div>
			<div class="right"><a href="#" title="Realizace">Realizace</a></div>
			<div class="correct"></div>
		</div>
		*}

	</div><!-- MainBox -->

</body>

</html>