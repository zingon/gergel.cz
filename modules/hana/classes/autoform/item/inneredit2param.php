<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Objekt vlozeneho editu pro editaci pripojenych parametru M:N (cen produktu, parametru produktu), oproti MicroEditParamu neotevira modalni dialog, ale vylistuje vsechny dostupne parametry v tabulce s pripojenymi edity pro zmenu.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Item_Inneredit2Param extends AutoForm_Item
{
 // TODO nastavitelna popisy
 public function generate($data_orm, $template=false)
 {
     //$result = parent::generate($data_orm, $template);

     $result="<div class=\"innerEdit2P\" /> \n";
     $rowdara=array();
     $n=0;
     if(isset($_POST["level"]) && count($_POST["level"])>0)
     {
         foreach($_POST["level"] as $key=>$item)
         {
             //$rowdata[$key]=array("level"=>$item,"value"=>$_POST["value"][$key]);
             $n=$key+1;
             $result.=$this->_insert_row(array("count"=>$key,"remove"=>true,"level"=>$item,"value"=>$_POST["value"][$key]));
         }
     }
     elseif($data_orm->id)
     {
        $dbresult=db::select("level","value")->from("shipping_pricelevels")->order_by("level")->where("shipping_id","=",$data_orm->id)->execute();
        $n=1;
        foreach($dbresult as $row){
            $result.=$this->_insert_row(array("count"=>$n,"remove"=>true,"level"=>$row["level"],"value"=>$row["value"]));
            $n++;
        }
     }

     if(!$n) $n=1;

     $result.="</div><a href=\"#\" id=\"ie2p_add\" class=\"correct left\">přidat hladinu</a> \n";
     $result.="<br /><br /> \n";
     $result.="<script type=\"text/javascript\">
               $(function(){
               var n=".$n.";
                $('#ie2p_add').click(function(){
                    $('.innerEdit2P').append(\"".$this->_insert_row(array("count"=>"x","remove"=>true))."\");
                    //var n = ($('.innerEdit2P .item').length);
                    n++;
                    $('.innerEdit2P .item:last').removeClass('ie2pItx');
                    $('.innerEdit2P .item:last').addClass('ie2pIt'+n);

                    $('.innerEdit2P .item:last .ie2pL').attr('name','level['+n+']');
                    $('.innerEdit2P .item:last .ie2pV').attr('name','value['+n+']');

                    return false;
                });

                $('.ie2pRemove').live('click',function(){
                    $(this).parent().remove();
                    return false;
                });

               });
               </script>
            ";

     return $result;
    }

    private function _insert_row(array $params=array())
    {
        $result="<div class='item ie2pIt".$params["count"]."'> Hranice ceny zboží <= ";
        $result.="<input type='text' class='ie2pL' name='level[".$params["count"]."]' value='".(isset($params["level"])?$params["level"]:"")."' />";
        $result.=" Kč s DPH - hodnota = ";
        $result.="<input type='text' class='ie2pV' name='value[".$params["count"]."]' value='".(isset($params["value"])?$params["value"]:"")."' />";
        $result.=" Kč s DPH";
        if(isset($params["remove"]) && $params["remove"])
        {
            $result.=" <a href='#' class='ie2pRemove'><img src='".url::base()."media/admin/img/delete.png' alt='smazat' /></a>";
        }
        $result.="</div>";

        return $result;
    }

}
?>
