<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Testovaci kontroler systemu Hana.
 *
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class Controller_Test extends Controller
{

    public function action_index()
    {
        // TEST 0 - testovani jazykoveho ORMka
        $page=orm::factory("page",1);//->find_all();

        
        echo($page->route->page_type->nazev);

        echo($page->route->nazev_seo);
        echo("<br />-------------------");
        //die(print_r($page));
//        foreach($page as $item)
//        {
//            echo($item->nadpis."-".$item->popis."<br />");
//        }

        


//        // TEST 1 - kontejner s jednim koncovym prvkem
//
//        // vytvorim kontejner
//        $container=new AutoForm_Container("vnejsi");
//
//        // vlozim polozku
//        $container->add(AutoForm_Item::factory("text","nazev_seo"));
//
//        // predgenerovani
//        $container->pregenerate($_POST);
//
//        // vytvorime nejaka data
//        $data = orm::factory("route",3);
//
//        // generovani do sablony
//        $template = new View("admin/test");
//
//        $container->generate($data, $template);
//
//        // konec
//        echo $template->render();
//        echo("<br /><br /> --- konec skriptu ---");


        // TEST 2 - kontejner s vlozenym kontejnerem ve kterem je koncovy prvek
//
//        // vytvorim kontejner
//        $vnejsi=new AutoForm_Container("vnejsi");
//
//        // vlozim polozku
//        $vnejsi->add(AutoForm_Item::factory("text","nazev_seo"));
//
//        // vytvorim vnitrni kontejner
//        $vnitrni = new AutoForm_Container("vnitrni");
//
//        // vlozim polozku do vnitrniho
//        $vnitrni->add(AutoForm_Item::factory("text","id"));
//        //$vnitrni->add(AutoForm_Item::factory("text","lb_popis")); // zalozim polozku nenapojenou na databazi
//        $vnitrni->add(AutoForm_Item::factory("text","lb_popis")->value("původní hodnota")); // primo nastavim hodnotu
//
//        // vlozim podrizeny kontejner
//        $vnejsi->add($vnitrni);
//
//        // predgenerovani
//        $vnejsi->pregenerate($_POST);
//
//        // vytvorime nejaka data
//        $data = orm::factory("route",3);
//
//        // zjisteni hodnoty
//        $mydata = $vnejsi->vnitrni->lb_popis->value;
//
//        // dodatecna uprava koncoveho prvku v podrizenem kontejneru
//        $vnejsi->vnitrni->lb_popis->value($mydata." - doplněk po předgenerování: ".$vnejsi->nazev_seo->value);
//
//        // generovani do sablony
//        $template = new View("admin/test");
//
//        $vnejsi->generate($data, $template);
//
//        // konec
//        echo $template->render();
//        echo("<br /><br /> --- konec skriptu ---");

//        // TEST 3 - kontejner s agregovanymi polozkami
//
//        // nastaveni sablony
//        $template = new View("admin/test");
//
//        // vytvorim kontejner
//        $vnejsi=new AutoForm_MultipleContainer("vnejsi", $template);
//
//        // vlozim polozku do vnitrniho
//        $vnejsi->add(AutoForm_Item::factory("text","id"));
//        $vnejsi->add(AutoForm_Item::factory("text","nazev_seo"));
//
//        // predgenerovani
//        $vnejsi->pregenerate($_POST);
//
//        // vytvorime nejaka data
//        $data = orm::factory("route")->find_all();
//
//        $vnejsi->generate($data, $template);
//
//        // konec
//        echo $template->render();
//        echo("<br /><br /> --- konec skriptu ---");

        // TEST 4 - kontejner s vnorenym kontejnerem agregovanymi polozkami

    }

}
?>
