<?php
/**
 * Smarty {widget} function plugin
 *
 * Type:     function<br>
 * Name:     static_content<br>
 * Date:     Sep 1, 2012
 * Purpose:  Kohana 3 widget loading (via HMVC request).<br>
 * Input:<br>
 *         - controller = controller name
 *         - action = controller action
 *         - param = [optional] parameter
 *         - url = [optional] HMVC url
 *         - name = [optional] widget name - important!: required for "dynamic widget" (you will be allowed to change widget content source from controller) or ajax request content modification  
 *
 * Examples:
 * <pre>
 * {widget name="MujWidget" controller="common" action="widget"}	
 * </pre>
 * @version  1.0
 * @author   Pavel Herink
 * @param    array
 * @param    Smarty
 * @return   string
 */
function smarty_function_widget(array $params, Smarty_Internal_Template $template)
{
    $allowed=true;
    
    if(isset($params["name"]) && Hana_Widgets::instance()->is_assigned($params["name"]))
    {
        // dynamicke prirazeni z kontroleru ma prednost
        $params["url"]=Hana_Widgets::instance()->get_assigned($params["name"]);
        if($params["url"]===false) $allowed=false;
    }
    
    if($allowed)
    {
        if(!isset($params["action"])) $params["action"]="widget";
           
        if(!isset($params["url"]))
        {
            if(!isset($params["param"])) $params["param"]="";
            $seo=Hana_Application::instance()->get_actual_seo();
            $params["url"]=$params["controller"]."/".$params["action"]."/".$seo.($params["param"]?"/".$params["param"]:"");
        }

        try
        {
            $widget_content=Request::factory("internal/".$params["url"])->execute()->response;
        } 
        catch (Exception $e)
        {
            throw new Kohana_Exception("Smarty - Widget Error: (url):".$params["url"].": <pre>".$e->__toString()."</pre>");
        }


        //echo("<div id=\"".ucfirst($params["name"]).ucfirst($params["action"])."Widget\">\n");
        if(isset($params["name"])) echo("<div id=\"".ucfirst($params["name"])."Widget\">\n");
        echo ($widget_content);
        if(isset($params["name"])) echo("</div>");
    }
    
}


?>
