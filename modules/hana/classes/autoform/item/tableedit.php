<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Trida reprezentujici editacni pole (edit).
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

 class AutoForm_Item_Tableedit extends AutoForm_Item
 {

     public function generate($data_orm, $template=false)
     {
         
         if(is_object($data_orm))
         {
             $data_orm=$data_orm->as_array();
         }
         else
         {
             $data_orm["time1"]=$_POST["time1"];
             $data_orm["time2"]=$_POST["time2"];
             $data_orm["time3"]=$_POST["time3"];
             $data_orm["time4"]=$_POST["time4"];
             
             $data_orm["group_a1"]=$_POST["group_a1"];
             $data_orm["group_a2"]=$_POST["group_a2"];
             $data_orm["group_a3"]=$_POST["group_a3"];
             $data_orm["group_a4"]=$_POST["group_a4"];
             
             $data_orm["group_b1"]=$_POST["group_b1"];
             $data_orm["group_b2"]=$_POST["group_b2"];
             $data_orm["group_b3"]=$_POST["group_b3"];
             $data_orm["group_b4"]=$_POST["group_b4"];
             
             
         }
         
         $value="";
         $response="";
         
         $response.="<table>";
         $response.="<tr><th></th> <th>1. časové pásmo</th> <th>2. časové pásmo</th> <th>3. časové pásmo</th> <th>4. časové pásmo</th> </th>";
         
         $response.=("<tr><td>Časové rozpětí</td>");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"time1\" ".($data_orm["time1"]?"value=\"".$data_orm["time1"]."\"":"")."/></td>\n");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"time2\" ".($data_orm["time2"]?"value=\"".$data_orm["time2"]."\"":"")."/></td>\n");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"time3\" ".($data_orm["time3"]?"value=\"".$data_orm["time3"]."\"":"")."/></td>\n");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"time4\" ".($data_orm["time4"]?"value=\"".$data_orm["time4"]."\"":"")."/></td>\n");
         $response.=("</tr>");
         
         $response.=("<tr><td>1. skupina</td>");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"group_a1\" ".($data_orm["group_a1"]?"value=\"".$data_orm["group_a1"]."\"":"")."/></td>\n");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"group_a2\" ".($data_orm["group_a2"]?"value=\"".$data_orm["group_a2"]."\"":"")."/></td>\n");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"group_a3\" ".($data_orm["group_a3"]?"value=\"".$data_orm["group_a3"]."\"":"")."/></td>\n");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"group_a4\" ".($data_orm["group_a4"]?"value=\"".$data_orm["group_a4"]."\"":"")."/></td>\n");
         $response.=("</tr>");
         
         $response.=("<tr><td>2. skupina</td>");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"group_b1\" ".($data_orm["group_b1"]?"value=\"".$data_orm["group_b1"]."\"":"")."/></td>\n");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"group_b2\" ".($data_orm["group_b2"]?"value=\"".$data_orm["group_b2"]."\"":"")."/></td>\n");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"group_b3\" ".($data_orm["group_b3"]?"value=\"".$data_orm["group_b3"]."\"":"")."/></td>\n");
         $response.=("<td><input type=\"text\" style=\"width:98%\" name=\"group_b4\" ".($data_orm["group_b4"]?"value=\"".$data_orm["group_b4"]."\"":"")."/></td>\n");
         $response.=("</tr>");

         $response.="</table>";
         return $response;
     }
     
     



 }


 ?>
