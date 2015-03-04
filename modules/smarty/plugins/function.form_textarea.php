<?php 

/**
 * 
 * {input}
 *
 * @param <type> $params
 * @param <type> $smarty
 */
function smarty_function_form_textarea(array $params, Smarty_Internal_Template $template)
{
    $name         =($params["name"]);
    
    if(strpos($name, "."))
    {
        $name=explode(".", $name);
        $full_name=$name[0]."[".$name[1]."]";
        $name=$name[1];
    }
    else
    {
        $full_name=$name;
    }
    
    $class        =isset($params["class"])?$params["class"]:"";
    $label        =isset($params["label"])?$params["label"]:""; 
    $default =isset($params["default"])?$params["default"]:""; 
    $data         =isset($params["data"])?$params["data"]:array();
    $errors       =isset($params["errors"])?$params["errors"]:array();
    $disabled     =isset($params["disabled"])?true:false; 
    $table_row    =isset($params["table_row"])?true:false;
    
    $value=isset($data[$name])?$data[$name]:($default?$default:"");
    
    $label=$label?"<label for=\"input_$name\" class=\"$class\">".__($label)."</label>":"";
    $form_item="<textarea name=\"$full_name\" id=\"input_$name\" class=\"$class\" ".($disabled?"disabled=\"disabled\"":"").">".$value."</textarea>";
    $error=isset($errors[$name])?"<span class=\"error\">$errors[$name]</span>":"";
    
    if($table_row)
    {
       return("<tr><td>".$label."</td><td>".$form_item.$error."</td></tr>");
    }
    else
    {
       return($label.$form_item.$error);
    }
    
}
?>
