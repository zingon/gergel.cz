<?php
/**
 * Obsluha zakladnich spolecnych prvku vkladanych do stranek.
 */
class Controller_Common extends Controller
{
    /**
     * Testovaci widget
     * @param type $nazev_seo
     * @param type $param 
     */
    public function action_widget($nazev_seo, $param="")
    {
       $this->request->response="<br />---<br />Testovací widget<br /> SEO: ".$nazev_seo.", param:".$param."<br />---<br />\n";
    }
    
    /**
     * Testovaci widget 2
     * @param type $nazev_seo
     * @param type $param 
     */
    public function action_widget2($nazev_seo, $param="")
    {
       $this->request->response="<br />---<br />Testovací widget 2<br /> SEO: ".$nazev_seo.", param:".$param."<br />---<br />\n";
    }
    
    /**
     * Zajisti vykresleni Smarty debug okna.
     */
    public function action_smdebug()
    {
        //$this->request->response="obsah widgetu";
    }
}

?>
