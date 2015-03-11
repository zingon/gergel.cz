<?php 

/**
 * 
 * {input type="select" name="jmeno"}
 *
 * nepovinne hodnoty 
 * value="vychozi hodnota"
 * norepopulate - priznak ktery zamezuje standardnimu chovani - znovuvyplneni prvku v pripade znovuzobrazeni formulare po neuspesnem odeslani 
 * 
 * data v promenne $form_data
 * chyby v promenne $form_errors  
 *   
 * @param <type> $params
 * @param <type> $smarty
 */
function smarty_function_form_select(array $params, Smarty_Internal_Template $template)
{
    $name         =($params["name"]);
    $type         =(!empty($params["type"])?$params["type"]:"text");
    
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
    $values         =isset($params["values"])?$params["values"]:array();
    $errors       =isset($params["errors"])?$params["errors"]:array();
    $disabled     =isset($params["disabled"])?true:false; 
    $table_row    =isset($params["table_row"])?true:false;
    
    $sel_value=(isset($data[$name])?$data[$name]:($default?$default:""));
    
    $label=$label?"<label for=\"input_$name\" class=\"$class\">".__($label)."</label>":"";
    $form_item="<select name=\"$full_name\" id=\"input_$name\" class=\"$class\"".($disabled?" disabled=\"disabled\"":"").">";
    foreach($values as $value)
    {
    if($value==$sel_value) $selected=" selected=\"selected\""; else $selected="";
    $form_item.="<option value=\"$value\" $selected>$value</option>\n";
    }
    $form_item.="</select>";//"<input type=\"".$type."\" name=\"$full_name\" value=\"$value\" id=\"input_$name\" class=\"$class\"".($disabled?" disabled=\"disabled\"":"").($checked?" checked=\"checked\"":"")."/>";
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
