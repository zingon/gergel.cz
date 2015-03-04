<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace objednavky - edit. Ponekud starsi implementace - TODO: predelat, separovat do servis dle zasad OOP.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Order_Edit extends Controller_Hana_Default
{
    public $template="admin/admin_content";
    
    // tlacitko zpet
    protected $back_link_url;
    protected $back_link_text="Zpět na seznam";
    
    protected $session;
    
    
    public function action_index()
    {
        $this->base_admin_path="admin/".$this->module_key."/".$this->submodule_key."/".$this->subaction_key."/".($this->item_page?"".$this->item_page:"").($this->item_id?"/".$this->item_id:"");

        $this->template->back_link=($this->back_link_url)?$this->back_link_url:url::base()."admin/".$this->module_key."/".$this->submodule_key."/list".($this->item_page?"/".$this->item_page:"/1");
        $this->template->back_link_text=$this->back_link_text;
    
        $order_template=new View("admin/edit/order_edit_template");
               
        $order=orm::factory("order")->find($this->item_id);
        
        $this->session=Session::instance();

        // cenova kategorie zakaznika, kteremu patri objednavka
        $shopper=orm::factory("shopper")->find($order->order_shopper_id);
        $price_code=$shopper->price_category->kod;

        $order_data=Service_Order::dump_order($order);
        //die(var_dump($order_data));
        $order_template->order=$order_data;
        
        // ########### doprava
        $order_shipping_id = false;
        if(isset($_POST["order_shipping_id"])){
           $order_shipping_id = $_POST["order_shipping_id"];
        }elseif(!$order_shipping_id){
           $order_shipping_id = $order_data["order_shipping_id"];
        }
        $shipping = orm::factory("shipping",$order_shipping_id);

        $order_template->order_shipping = Service_Shipping::get_shipping_types();
        $order_template->order_shipping_sel_id = $order_shipping_id;

        // ########### platba
        //$order_payment_id = $this->session->get("order_payment_id");
        $order_payment_id = false;
        if(isset($_POST["order_payment_id"])){
           $order_payment_id = $_POST["order_payment_id"];
        }elseif(!$order_payment_id){
           $order_payment_id = $order_data["order_payment_id"];
        }
        $payment = orm::factory("payment",$order_payment_id);

        $order_template->order_payment = Service_Payment::get_shipping_payment_types();
        $order_template->order_payment_sel_id = $order_payment_id;
        
        $track_code= Input::post("track_code");
        if(!$track_code){
           $track_code = $order_data["post_track_trace_code"];
        }
            

        // ########### vylistovani puvodnich produktu
        
        //die(print_r($order_data["products"]));

        // inicializace nakupniho kosiku - vlozeni starych produktu i s jejich puvodnimi cenami + vkladani novych produktu s novymi cenovymi podminkami
        $cart=Model_Order_Editcart::instance();
        //die(print_r($order));
        // pro vypocet cen novych produktu pouzijeme aktualni cenovou skupinu uzivatele
        Model_Product_Priceholder::$default_price_code=db::select("price_categories.kod")->from("price_categories")->join("shoppers")->on("price_categories.id","=","shoppers.price_category_id")->where("shoppers.id","=",$order->order_shopper_id)->execute()->get("kod");
            
        if(!Input::post("edit_process", false))
        {
            // prvni vstup do editu - inicalizuju kosik
            
            $cart->flush(); // pripadne stary obsah smazu
            foreach ($order_data["products"] as $old_product)
            {
                $cart->set_item($old_product["product_id"], (int)$old_product["units"], $old_product["varianta_id"]);
                $cart->set_old_product_id($old_product["product_id"], $old_product["id"]);
            }
        }
        else
        {
            // doplneni / editace produktu z pruchodu editem
            $cart_products=Input::post("order_product_quantity");
            //die(print_r($cart_products));
            foreach($cart_products as $product_id=>$quantity)
            {
                $st=$cart->set_item($product_id, $quantity, false, true);
                if(!$st) $status=false;
            }
            
            // pridani noveho produktu
            $new_product_id=Input::post("order_product_new",0);
            $new_product_quantity=Input::post("order_product_quantity_new",0);
            if($new_product_quantity>0){
                $st=$cart->set_item($new_product_id, $new_product_quantity, false, true);
            }
        }
        
        $cart_products=$cart->get_cart_products();
        $order_template->products=$cart_products;
        //die(print_r($cart_products));
        
        // ziskani dat pro selectbox pro pridani produktu
        $products = ORM::factory("product")->where("smazano","=",0)->order_by("nazev")->find_all();
        $order_template->new_products=$products;
        
        
        // vypocet cen kosiku dle platnych cenovych pravidel jako na verejne casti
        $price_array=Service_Order::generate_order_prices($cart, $order_shipping_id, $order_payment_id, $order->order_discount);
        //$price_array["order_discount"]=$order->order_discount;
        $order_template->prices=$price_array;
        //die(print_r($price_array));
        
        
        
        if(Input::post("updateOrder", false)){
            //ulozeni objednavky 
            $order->populate_prices($price_array, $cart, true);
            
            $data=array();
            $data["post_track_trace_code"]=$track_code;
                        
            $result = Service_Order::update_order($order, $data);
            
            if($result){
                Request::instance()->redirect(url::base()."admin/".$this->module_key."/".$this->submodule_key."/list".($this->item_page?"/".$this->item_page:"/1")."?message=ok");
            }else{
                $this->template->admin_content.="<div class=\"orderError\">".$form_error."</div>";
            }
            
        }
        


//        // inicializace dat pro vypocet hodnot objednavky
//        $cena_bez_dph_celkem=0;
//        $cena_s_dph_celkem=0;
//        $total_cart_products_price_no_vat=0; // soucet produktu s 0 DPH
//        $total_cart_products_price_low_vat=0; // soucet produktu s nizsi sazbou DPH
//        $total_cart_products_price_high_vat=0; // soucet produktu s vyssi sazbou DPH
//        $low_vat_total=0;                      // soucet hodnot dani zbozi zarazenych do nizsi sazby DPH
//        $high_vat_total=0;                     // soucet hodnot dani zbozi zarazenych do vyssi sazby DPH
//        $shopping_cart_weight=0;
//
//        // ############## GENEROVANI SELECTBOXU PLATBY A DOPRAVY
//        // doprava
//        //$order_shipping_id = $this->session->get("order_shipping_id");
//        $order_shipping_id = false;
//        if(isset($_POST["order_shipping_id"])){
//           $order_shipping_id = $_POST["order_shipping_id"];
//        }elseif(!$order_shipping_id){
//           $order_shipping_id = $order_data["order_shipping_id"];
//        }
//        $shipping = orm::factory("shipping",$order_shipping_id);
//
//        $order_template->order_shipping = Service_Shipping::get_shipping_types();
//        $order_template->order_shipping_sel_id = $order_shipping_id;
//
//        // platba
//        //$order_payment_id = $this->session->get("order_payment_id");
//        $order_payment_id = false;
//        if(isset($_POST["order_payment_id"])){
//           $order_payment_id = $_POST["order_payment_id"];
//        }elseif(!$order_payment_id){
//           $order_payment_id = $order_data["order_payment_id"];
//        }
//        $payment = orm::factory("payment",$order_payment_id);
//
//        $order_template->order_payment = Service_Payment::get_shipping_payment_types();
//        $order_template->order_payment_sel_id = $order_payment_id;
//
//        // ############## ZPRACOVANI PUVODNICH PRODUKTU V OBJEDNAVCE
//        //$old_products=$this->session->get("old_products");
//        $old_products=isset($_POST["old_products"])?unserialize(htmlspecialchars_decode($_POST["old_products"])):array();
//
//        foreach($order_data["products"] as $item){
//            // zjistim, zda nedoslo k odeslani noveho poctu
//            if(isset($post["order_product_quantity"][$item["id"]])){
//                $units=$post["order_product_quantity"][$item["id"]];
//                $old_products[$item["id"]]=$units;
//            }
//
//            $units=isset($old_products[$item["id"]])?$old_products[$item["id"]]:$item["units"];
//            $o_products[$item["id"]]["item_units"]=$units;
//            $o_products[$item["id"]]["item_jednotka"]=$item["jednotka"];
//            $o_products[$item["id"]]["id"]=$item["id"];
//            $o_products[$item["id"]]["item_code"]=$item["code"];
//            $o_products[$item["id"]]["item_nazev"]=$item["nazev"];
//            $o_products[$item["id"]]["item_zmeneno"]=$item["item_change"];
//            $o_products[$item["id"]]["item_price_bez_dph"]=$item["price_without_tax"];
//            $o_products[$item["id"]]["item_price_s_dph"]=$item["price_with_tax"];
//            $o_products[$item["id"]]["item_cena_bez_dph_celkem"]=$units*$item["price_without_tax"];
//            $o_products[$item["id"]]["item_cena_s_dph_celkem"]=$units*$item["price_with_tax"];
//            $dph_code="order_".$item["tax_code"];
//
//            $dph_value = $order->$dph_code;                                  // Bere se dan v okamziku zalozeni objednavky
//
//            $cena_bez_dph_celkem+=$o_products[$item["id"]]["item_cena_bez_dph_celkem"];
//            $cena_s_dph_celkem+=$o_products[$item["id"]]["item_cena_s_dph_celkem"];
//
//            switch ($dph_code) {
//                case "order_no_vat_rate":
//                    $total_cart_products_price_no_vat+=$o_products[$item["id"]]["item_cena_bez_dph_celkem"];
//                break;
//                case "order_lower_vat_rate":
//                    $total_cart_products_price_low_vat+=$o_products[$item["id"]]["item_cena_bez_dph_celkem"];
//                    $low_vat_total+=$units*$item["price_without_tax"]*($dph_value/100);
//                break;
//                case "order_higher_vat_rate":
//                    $total_cart_products_price_high_vat+=$o_products[$item["id"]]["item_cena_bez_dph_celkem"];
//                    $high_vat_total+=$units*$item["price_without_tax"]*($dph_value/100);
//                break;
//                default:
//                    $total_cart_products_price_no_vat+=$o_products[$item["id"]]["item_cena_bez_dph_celkem"];
//                    break;
//            }
//            $shopping_cart_weight+=$item["total_weight"];
//        }
//
//        //$this->session->set("old_products",$old_products);
//        $order_template->old_products=htmlspecialchars(serialize($old_products));
//
////        // ############## ZPRACOVANI PRIDANYCH PRODUKTU V OBJEDNAVCE
//        $added_products=array();
//        $n_products=array();
//        //$added_products=$this->session->get("added_products",array());
//        $added_products=isset($_POST["added_products"])?unserialize(htmlspecialchars_decode($_POST["added_products"])):array();
//
//        // pridani produktu
//        if(isset($post["add_order_item"]) && $post["order_product_quantity_new"]>0){
//            // byl pridan novy produkt
//
//            $added_products[$post["order_product_new"]]=$post["order_product_quantity_new"];
//        }
//        //die(print_r($added_products));
//
//
//        // generovani orm a vylistovani
//        if($added_products && count($added_products)>0){
//            //print_r($added_products);
//            $npids=array();
//            foreach($added_products as $pid=>$quantity){
//               $npids[]=$pid;
//            }
//            //print_r($npids);
//
//            $added_products_orm = orm::factory("product")->where("products.id","IN",$npids)->find_all();
//
//            foreach($added_products_orm as $item){
//                // zjistim, zda nedoslo k odeslani noveho poctu
//            if(isset($post["order_product_quantity"][$item->id])){
//                $units=$post["order_product_quantity"][$item->id];
//                $added_products[$item->id]=$units;
//                }
//
//                $units=$added_products[$item->id];
//                $n_products[$item->id]["item_units"]=$units;
//                $n_products[$item->id]["id"]=$item->id;
//                $n_products[$item->id]["item_code"]=$item->code;
//                $n_products[$item->id]["item_nazev"]=$item->nazev;
//                $n_products[$item->id]["item_price_bez_dph"]=$price_bez_dph=Service_Product::instance()->get_product_price_without_tax($item, $price_code);
//                $n_products[$item->id]["item_price_s_dph"]=$price_s_dph=Service_Product::instance()->get_product_price_with_tax($item, $price_code);
//                $n_products[$item->id]["item_cena_bez_dph_celkem"]=$price_bez_dph*$units;
//                $n_products[$item->id]["item_cena_s_dph_celkem"]=$price_s_dph*$units;
//                $dph_code="order_".(($item->tax->code)?$item->tax->code:"higher_vat")."_rate";
//                
//                // dan (aktualni hodnota/stara hodnota) pozor - musi byt zvoleno stejne pro stare i nove produkty
//                //$dph_orm=orm::factory("tax")->where("code",$dph_code)->find(); // Bere se aktualni dan - v tom pripade je nutno ji preulozit i do order
//                //$dph_value=$dph_orm->hodnota;
//                $dph_value = $order->$dph_code;                                  // Bere se dan v okamziku zalozeni objednavky
//
//                $cena_bez_dph_celkem+=$n_products[$item->id]["item_cena_bez_dph_celkem"];
//
//                $cena_s_dph_celkem+=$n_products[$item->id]["item_cena_bez_dph_celkem"]*(1+($dph_value)/100);
//
//                switch ($dph_code) {
//                case "order_price_no_vat":
//                    $total_cart_products_price_no_vat+=$n_products[$item->id]["item_cena_bez_dph_celkem"];
//                break;
//                case "order_lower_vat_rate":
//                    $total_cart_products_price_low_vat+=$n_products[$item->id]["item_cena_bez_dph_celkem"];
//                    $low_vat_total+=$units*$price_bez_dph*($dph_value/100);
//                break;
//                case "order_higher_vat_rate":
//                    $total_cart_products_price_high_vat+=$n_products[$item->id]["item_cena_bez_dph_celkem"];
//                    $high_vat_total+=$units*$price_bez_dph*($dph_value/100);
//                break;
//                default:
//                    $total_cart_products_price_no_vat+=$n_products[$item->id]["item_cena_bez_dph_celkem"];
//                    break;
//                }
//                $shopping_cart_weight+=$item->hmotnost;
//            }
//        }
//
//        // ulozeni do sesny
//        //$this->session->set("added_products",$added_products);
//        $order_template->added_products=htmlspecialchars(serialize($added_products));
//
//        // ############## VYPOCET VYSLEDNYCH PROMENNYCH
//        $order_template->order_total_without_vat=$cena_bez_dph_celkem;
//        $order_template->order_total_with_vat=$cena_s_dph_celkem;
//
//        $order_template->order_total_vat=$cena_s_dph_celkem - $cena_bez_dph_celkem;
//
//        $order_template->order_shipping_price=$shipping->cena;
//        $order_template->order_payment_price=$payment->cena;
//
//        $order_template->order_total_CZK=$cena_s_dph_celkem + $shipping->cena + $payment->cena;
//
//        // ziskani dat pro selectbox pro pridani produktu
//        $products = ORM::factory("product")->where("smazano","=",0)->order_by("nazev")->find_all();
//        $order_template->new_products=$products;
//
//        $order_template->o_products=$o_products;
//        $order_template->n_products=$n_products;
//
////        $this->template->admin_content ="<div class=\"niLeft\"><a href=\"".url::base()."admin_objednavky/itemList/".$return_to_page.".php\"><img src=\"".url::base()."application/views/admin/img/page_go.png\" alt=\"zpět na seznam objednávek\" title=\"zpět bez uložení\" /></a> <a href=\"".url::base()."admin_objednavky/itemList/".$return_to_page."php\" class=\"newItem\">Zpět na seznam objednávek</a></div>";
//
//
//        // ############## OBSLUHA ULOZENI OBJEDNAVKY
//        if(isset($post["updateOrder"])){
//            //die("ulozeno".print_r($old_products)." ".print_r($added_products));
//
//            // pocatecni kontroly pred ulozenim
//            $form_error="";
//            if(false) {$form_error .= "Chyba! Špatná kombinace způsobu dopravy a platby.";}
//
//            if(!$form_error){
//
//            // proces updatovani objednavky -> servisa
//            $order=Service_Order::update_order($order, $order_data["products"], $old_products, $added_products);
//
//            // zmena hodnot v samotne objednavce
//            $order->order_price_no_vat      = $total_cart_products_price_no_vat; // soucet produktu s 0 DPH
//            $order->order_price_lower_vat   = $total_cart_products_price_low_vat; // soucet produktu s nizsi sazbou DPH
//            $order->order_price_higher_vat  = $total_cart_products_price_high_vat; // soucet produktu s vyssi sazbou DPH
////            $tax=ORM::factory("tax",2);
////            $order->order_lower_vat_rate    =$tax->hodnota;
////            $tax=ORM::factory("tax",3);
////            $order->order_higher_vat_rate   =$tax->hodnota;
//            $order->order_lower_vat 	    = $low_vat_total;            // soucet hodnot dani zbozi zarazenych do nizsi sazby DPH
//            $order->order_higher_vat        = $high_vat_total;           // soucet hodnot dani zbozi zarazenych do vyssi sazby DPH
//            $order->order_total_without_vat = $cena_bez_dph_celkem; // cena bez DPH veskereho zbozi
//            $order->order_total_with_vat    = $cena_s_dph_celkem;   // cena s DPH veskereho zbozi
//            $order->shipping_id             = $shipping->id;        // id dopravy
//            $order->order_shipping_price    = $shipping->cena;      // cena dopravy
//            $order->payment_id              = $payment->id;         // id platby
//            $order->order_payment_price     = $payment->cena;         // cena za zvolenou platebni metodu
//            $order->order_total             = $order->order_total_with_vat + $order->order_shipping_price + $order->order_payment_price; // celkova vysledna nezaokrouhlena cena s DPH
//            $order->order_total_CZK 	    = round($order->order_total);
//            $order->order_correction        = $order->order_total_CZK - $order->order_total;
//            $order->order_weight 	    = $shopping_cart_weight;
//            $order->last_modified           = date("Y-m-d H:i:s");
//
//            $order->save();
//
//            Request::instance()->redirect(url::base()."admin/".$this->module_key."/".$this->submodule_key."/list".($this->item_page?"/".$this->item_page:"/1")."?message=ok");
//            
//            }else{
//                $this->template->admin_content.="<div class=\"orderError\">".$form_error."</div>";
//            }
//
//        }

//        $this->template->admin_content.="<div class=\"defaultTable correct\">";
//        $this->template->admin_content.=$order_template;
//        $this->template->admin_content.="</div>";



        $this->template->admin_content=$order_template;

        $this->request->response=$this->template->render();
   }

    
}