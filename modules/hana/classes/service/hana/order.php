<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Servisni trida pro implementaci objednavky v navaznosti na nakupni kosik.
 * Rozsireni katalogu (Service_Products) o nákupní košík -> e-shop.
 * Tato servisa pocita s cenami s DPH.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 * 
 */
class Service_Hana_Order extends Service_Hana_Module_Base{
    
    protected static $navigation_module="page";
    protected static $processed_order_state_code="processed"; // stav objednavky, kdy ji povazujeme za uzavrenou a zaplacenou (pripisujeme cenovou hodnotu k uzivateli) 
    
    /**
     * Vrati ORM objekt objednavky s vyplnenyma datama na zaklade aktualniho kosiku, vybrane dopravy a platby
     * @param boolean $populate priznak, zda maji byt zaroven vyplneny ceny na zaklade aktualniho nakupniho kosiku
     * @return Model_Order objekt objednavky
     */
    public static function get_populated_order($populate=true)
    {
        $order=Model_Order::instance();
        
        if($populate && $order->are_prices_generated()===false)
        {
            $shopping_cart  = Service_ShoppingCart::get_cart();
            $shipping_id    = Service_Shipping::get_selected_shipping_id();
            $payment_id     = Service_Payment::get_selected_payment_id();
            
            $price_array=self::generate_order_prices($shopping_cart, $shipping_id, $payment_id);
            
            $order->populate_prices($price_array, $shopping_cart);
        }
        return $order;
    }
    

    /**
     * Vypocte vsechny potrebne cenove hodnoty pro objednavku.
     * @param Model_Cart $shopping_cart
     * @param int $shipping_id id zvolene dopravy
     * @param int $payment_id  id zvolene platby
     * @param int $raw_discount sleva objednavky - primo
     */
    static function generate_order_prices(Model_Cart $shopping_cart, $shipping_id=false, $payment_id=false, $raw_discount=0)
    {

        if($shopping_cart->total_cart_price_with_tax==0) return array();
        
        // nazvy indexu shodne s db tabulkou "order"
        
        // inicializace vsech promennych co se budou pocitat v kosiku
        
        $prices["order_price_no_vat"]=0;       // soucet cen produktu s nulovou dani
        $prices["order_price_lower_vat"]=0;    // soucet cen produktu s nizsi sazbou dane (vcetne dane)
        $prices["order_price_higher_vat"]=0;   // soucet cen produktu s vyssi sazbou dane (vcetne dane)

        // nasledujici se bude generovat az v create_order:
        $prices["order_no_vat_rate"]=0;        //  
        $prices["order_lower_vat_rate"]=db::select("hodnota")->from("taxes")->where("code","=","lower_vat")->execute()->get("hodnota");     // hodnota nizsi sazby dane
        $prices["order_higher_vat_rate"]=db::select("hodnota")->from("taxes")->where("code","=","higher_vat")->execute()->get("hodnota");    // hodnota vyssi sazby dane
        
        $prices["order_lower_vat"]=0;          // soucet vsech nizsich dani na produktech
        $prices["order_higher_vat"]=0;         // soucet vsech vyssich dani na produktech
        
        $prices["order_total_without_vat"]=0;  // celkova cena kosiku bez dane
        $prices["order_total_with_vat"]=0;     // celkova cena kosiku s dani
        
        $prices["order_discount"]=0;           // hodnota slevy na objednavce (vcetne dane)
        
        $prices["order_total_with_discount"]=0;// celkova cena kosiku s dani a zapoctenymi slevami 
        
        $prices["order_shipping_price"]=0;     // cena dopravy s dani
        $prices["order_payment_price"]=0;      // cena platby s dani
        
        $prices["order_total"]=0;              // cena celkem po zapocitani dopravy a platby
        $prices["order_correction"]=0;         // hodnota zaokrouhleni platby
        $prices["order_total_CZK"]=0;          // cena k zaplaceni celkem po zaokrouhleni
        
        // udaje k doprave, ktera byla pouzita k vypoctu objednavky
        $prices["order_shipping_id"]=0;
        $prices["order_shipping_nazev"]="";
        $prices["order_shipping_popis"]="";
        
        // udaje k platbe, ktera byla pouzita k vypoctu objednavky
        $prices["order_payment_id"]=0;
        $prices["order_payment_nazev"]="";
        $prices["order_payment_popis"]="";
        
        
        
        // generovani vyse uvedenych promennych
        
        $prices["order_price_no_vat"]        = $shopping_cart->total_cart_price_no_tax;
        $prices["order_price_lower_vat"]     = $shopping_cart->total_cart_price_lower_tax;
        $prices["order_price_higher_vat"]    = $shopping_cart->total_cart_price_higher_tax;
        
        $prices["order_lower_vat"]           = $shopping_cart->total_lower_tax_value;          
        $prices["order_higher_vat"]          = $shopping_cart->total_higher_tax_value;
        
        $prices["order_total_without_vat"]   = $shopping_cart->total_cart_price_without_tax; 
        $prices["order_total_with_vat"]      = $shopping_cart->total_cart_price_with_tax; 
        
        $prices["order_shipping_id"]               =$shipping_id;
        $prices["order_payment_id"]                =$payment_id;
        
        //////////////////////////////////////// 
        // vypocet slev na objednavce TODO podle potreb projektu:
        $prices=static::calculate_order_discount($prices, $shopping_cart, $raw_discount);
        
        // prirazeni voucheru k objednavce
        $voucher=Service_Voucher::get_voucher();
        if($voucher)
        {
            $prices["order_voucher_id"]=$voucher->id;
            $prices["order_voucher_discount"]=$shopping_cart->total_cart_voucher_discount;
        }
        
        ////////////////////////////////////////
        $prices["order_total_with_discount"] = $prices["order_total_with_vat"]-$prices["order_discount"];
        if($prices["order_total_with_discount"]<0) $prices["order_total_with_discount"]=0;
        
        // cena za dopdieravu
        if($shipping_id)
        {
            $shipping = orm::factory("shipping",$shipping_id);
            $prices["order_shipping_nazev"] = $shipping->nazev;
            $prices["order_shipping_popis"] = $shipping->popis;
            // cena dopravy
            if($shipping->cenove_hladiny)
            {
                $prices["order_shipping_price"] = Service_Hana_Shipping::get_level_price($shipping_id, round($prices["order_total_with_discount"]));
                if($prices["order_shipping_price"]==false) $prices["order_shipping_price"]=$shipping->cena;
            }
            else
            {    
                $prices["order_shipping_price"] = $shipping->cena;
            }    

        }

        // cena za platbu
        if($payment_id)
        {
            $payment = orm::factory("payment",$payment_id);
            $prices["order_payment_nazev"]=$payment->nazev;
            $prices["order_payment_popis"]=$payment->popis;
            
            // vypocet platby na zaklade typu
            if($payment->typ==2)
            {
                // TODO - platba na zaklade hodnoty objednaneho zbozi 
                $prices["order_payment_price"] = $price["order_total_with_discount"]($payment->cena/100); 
            }
            else
            {
                $prices["order_payment_price"] = $payment->cena;
            }
            
            $shp=$prices["order_shipping_price"] + $prices["order_payment_price"];
            if($shp<0) $prices["order_payment_price"]=$prices["order_shipping_price"]; // pokud je platba dana slevou, nelze se dostat do zaporu (jeji sleva je ve vysi max ceny dopravy)
            
        }
        
        //////////////////////////////////////////////
        $prices["order_total"]               = $prices["order_total_with_discount"] +  $prices["order_shipping_price"] +  $prices["order_payment_price"];
        $prices["order_total_CZK"]           =round($prices["order_total"]); 
        $prices["order_correction"]          =$prices["order_total_CZK"]-$prices["order_total"];        
        
        return $prices;
    }
    
    /**
     * Tuto metodu lze predefinovat v odvozene tride a implementovat potrebny zasah do cen s ohledem na pozadovane ceny; (voucher se nepocita za slevu na objednavce)
     * @param array $prices
     * @param Model_Cart $shopping_cart
     * @return int 
     */
    protected static function calculate_order_discount($prices, Model_Cart $shopping_cart, $raw_discount=0)
    {
        $prices["order_discount"]=$raw_discount;
        
        return $prices;
    }


    /**
     * Ulozi zvolenou dopravu a platbu po odeslani formulare pred prejitim na dalsi krok, provede validaci zadane kombinace.
     * @param int $selected_shipping_id
     * @param int $selected_payment_id
     * @return boolean
     */
    public static function process_selected_shipping_payment_types($selected_shipping_id, $selected_payment_id)
    {
        //
        Service_Shipping::set_shipping_id($selected_shipping_id);
        Service_Payment::set_payment_id($selected_payment_id);

        return true;
    }
    
    /**
     * Vrati vsechny dostupne objednávky.
     * @param int $shopper_id
     * @param string $order_state kod stavu
     * @param string $comparator porovnavaci retezec (napr. pro nalezeni vsech nevyrizenych stavu)   
     * @return array
     */
    public static function get_orders_list($shopper_id,$order_state,$comparator="=")
    {
       
        $orders=DB::select("orders.id","order_code","order_date",array("order_state_data.nazev","order_state_popis"),array("orders.order_date_finished","order_close_date"),"order_total_CZK")->from("orders")
                ->join("order_states","LEFT")->on("orders.order_state_id","=","order_states.id")
                ->join("order_state_data","LEFT")->on("order_states.id","=","order_state_data.order_state_id")
                ->where("order_shopper_id","=",$shopper_id)->where("order_states.code",$comparator,$order_state)->order_by("order_date","desc")->execute()->as_array();
        
        $result_array=array();
        $x=1;
        foreach($orders as $item)
        {
            $result_array[$x]=$item;
            
            $order_items=DB::select("order_items.id","order_items.nazev","products.photo_src",array("products.id","prodid"),"routes.nazev_seo")
                    ->from("order_items")
                    ->join("products","LEFT")->on("order_items.product_id","=","products.id")
                    ->join("product_data","LEFT")->on("products.id","=","product_data.id")
                    ->join("routes","LEFT")->on("product_data.route_id","=","routes.id")
                    ->where("order_items.order_id","=",$item["id"])
                    ->execute();
            
            foreach($order_items as $oi)
            {
                $result_array[$x]["products"][$oi["id"]]=$oi;
                $result_array[$x]["products"][$oi["id"]]["photo_src"]=url::base()."media/photos/product/item/images-".$oi["prodid"]."/".$oi["photo_src"]."-t5.jpg";
            }
            
            $x++;
        }
        //die(print_r($result_array));
        return $result_array;
//        return $orders;
        
    } 

    /**
     * Ulozi objednavku do databaze a .
     * @param Model_Order $order
     * @param Model_Shopper $shopper
     * @param type $shopper_branch
     * @param type $additional_data
     * @return Model_Order 
     */

    public static function save_order(Model_Order $order, Model_Shopper $shopper, $shopper_branch=array(), $additional_data=array())
    {
       
        ////////// zaznam do db
        
        // cislo zalohove faktury
	$order->order_code_invoice     = Service_Order::_create_new_invoice_code($order->order_payment_id);       
        
	$order->order_date 	       =date("Y-m-d H:i:s");
	$order->order_delivery_date    =null; // zatim nepouzivat
	$order->order_date_tax 	       =null; // zatim nepouzivat
	$order->order_date_payment     =null; // zatim nepouzivat
        
        $order->order_state_id	       =0; // novy stav se nastavi nakonci teto metody
        
        // veskere vypocty cen se provadi v metode "generate_order_prices", v tomto okamziku je ma jiz objekt "$order" nasetovane (vyvolano v kontroleru)
        // ...
        
        // definitivne vyridime slevovy kupon  
        
        if($order->order_voucher_id)
        {
            Service_Voucher::use_voucher($order->order_voucher_id);
        }
        
        $order->order_shopper_id        =$shopper->id;
	$order->order_shopper_branch    =isset($shopper_branch["branch_id"])?$shopper_branch["branch_id"]:null;;
	$order->order_shopper_name      =$shopper->nazev;
	$order->order_shopper_code      =$shopper->kod;
	$order->order_shopper_email     =$shopper->email;
	$order->order_shopper_phone     =$shopper->telefon;
	$order->order_shopper_ic        =$shopper->ic;
	$order->order_shopper_dic       =$shopper->dic;
	$order->order_shopper_street    =$shopper->ulice;
	$order->order_shopper_city      =$shopper->mesto;
	$order->order_shopper_zip       =$shopper->psc;
        $order->order_shopper_note      =!empty($additional_data["shopper_note"])?$additional_data["shopper_note"]:"";
        $order->order_shopper_custommer_code =!empty($additional_data["customer_order_code"])?$additional_data["customer_order_code"]:"";
        $order->gift_box_code =!empty($additional_data["gift_box_code"])?$additional_data["gift_box_code"]:"";

        // nacteme data pro zvolenou pobocku
        $order->order_branch_name       =isset($shopper_branch["nazev"])?$shopper_branch["nazev"]:null;
	$order->order_branch_code       =isset($shopper_branch["kod"])?$shopper_branch["kod"]:null;
	$order->order_branch_street     =isset($shopper_branch["ulice"])?$shopper_branch["ulice"]:null;
	$order->order_branch_city       =isset($shopper_branch["mesto"])?$shopper_branch["mesto"]:null;
	$order->order_branch_zip        =isset($shopper_branch["psc"])?$shopper_branch["psc"]:null;
	$order->order_branch_phone      =isset($shopper_branch["telefon"])?$shopper_branch["telefon"]:null;
	$order->order_branch_email      =isset($shopper_branch["email"])?$shopper_branch["email"]:null;

        $order->last_modified           =date("Y-m-d H:i:s");
        
        if($order->order_total_with_vat==0) die("chyba, objednávka neobsahuje žádné zboží!");
        
        $order_id=$order->save()->id;
        
        
        // nyni vim id vlozeneho zaznamu - muzu doplnit kod objednavky shopper_id-order_id (000000-000000)
        $order->order_code              = Service_Order::_create_new_order_code($shopper->kod, $order_id);
        $order->save();

        $cart_data=$order->get_cart()->get_cart_products(); // ziskam zbozi z kosiku pridruzeneho k objednavce
        
        foreach($cart_data as $item){
            // $key = product_id

            $order_item=orm::factory("order_item");
            // naplneni order itemu
            $order_item->code               =$item["code"];
            $order_item->nazev              =$item["nazev"];
            //$order_item->varianta_popis     =$item["varianta"]["barva_velikost"];
            //$order_item->varianta_id        =$item["varianta"]["id"];
            $order_item->jednotka           =$item["jednotka"];
            $order_item->hmotnost           =$item["hmotnost"];
            $order_item->pocet_na_sklade    =$item["pocet_na_sklade"];
            $order_item->min_order_quantity =$item["min_order_quantity"];
            $order_item->tax_code           =$item["tax_code"];
            $order_item->order_id           =$order_id;
            $order_item->product_id         =$item["id"];
            $order_item->units              =$item["mnozstvi"];
            $order_item->price_without_tax  =$item["cena_bez_dph"];
            $order_item->price_with_tax     =$item["cena_s_dph"];
            $order_item->total_price_with_tax        =$item["cena_celkem_s_dph"];
            $order_item->item_change             =null;
            $order_item->total_weight       =$item["hmotnost"] * $item["mnozstvi"];

            $order_item->save();
        }
        
        // nastavim priznak objednavky - pri prvnim ulozeni nebudu posilat mail se zmenou stavu
        Service_Order::set_order_state($order, "new", false);
        
        return $order;
    }
    
    /**
     * Metoda pro nastaveni stavu objednavky
     * @param Model_Order $order
     * @param type $order_state string/int kod nebo id stavu
     * @param type $default_send_mail
     * @return type 
     */
    public static function set_order_state(Model_Order $order, $state_codeid, $default_send_mail=true)
    {
        if(!is_numeric($state_codeid))
        {
            $order_state=ORM::factory("order_state")->where("code","=",$state_codeid)->find();
        }
        else
        {

            $order_state=ORM::factory("order_state")->where("order_states.id","=",$state_codeid)->find();
        }
        // overeni puvodniho stavu
        $current_state_id = $order->order_state_id;
        if($current_state_id != $order_state->id)
        {
            $order->order_state_id = $order_state;
            $order->save();
            
            // zaslani mailu o zmene stavu
            if($order_state->send_mail && $default_send_mail)
            {
                Service_Order_Email::send_state_change_notification($order, $order_state);
            }
            
            // ulozeni hodnoty objednavky k uzivateli
            if($order_state->code == static::$processed_order_state_code)
            {
                $shopper=$order->shopper;
                if($shopper->email)
                {
                    //pouze pokud je k objednavce pripojen registrovany uzivatel (ma email)
                    $current_order_total = $shopper->order_total;
                    // pricteme hodnotu zakoupeneho zbozi (s dani, bez dopravy a platby)
                    $new_order_total = $current_order_total + $order->order_total_with_vat;
                    $shopper->order_total = $new_order_total;
                    // zarazeni do cenove skupiny (
                    $price_category_id=DB::select("id")->from("price_categories")->where("zaradit_zakaznika_od","<=",$new_order_total)->order_by("zaradit_zakaznika_od","DESC")->limit(1)->execute()->get("id");
                    //die(var_dump($price_category_id));
                    if($price_category_id && $shopper->price_category_id != $price_category_id){
                        $shopper->price_category_id=$price_category_id;
                    }
                    $shopper->save();
                }  
            }
            
            
            // zarazeni do cenove skupiny dle hodnoty nakupu
            
            
            // dodatecne akce na zmenu stavu objednavky
            Service_Order::on_change_order_state($order);
        }
        
        
        return true;
    }
    
    /**
     * Predefinovatelna metoda pro dodatecnou akci na zmenu stavu objednavky
     * @param type $order 
     */
    protected static function on_change_order_state($order)
    {
        
    }
    
    /**
     * Predefinovatelna metoda pro nastaveni politiky generovani cisel.
     * @param type $shopper_code
     * @param type $order_id
     * @return type 
     */
    protected static function _create_new_order_code($shopper_code, $order_id)
    {
        //return /*$shopper_code."-".*/date("Y").str_pad($order_id, 6, "0", STR_PAD_LEFT);
        //return(1000 + $order_id);
        return (str_pad($order_id, 4, "0", STR_PAD_LEFT));
    }
    
    /**
     * Vrati aktualni cislo (zalohove) faktury a v db "invoice_setting" ho nastavi o +1
     * @param type $order_payment_id
     * @return type 
     */
    protected static function _create_new_invoice_code($order_payment_id)
    {
        $payment=orm::factory("payment",$order_payment_id);
        if($payment->predem)
        {
            // pouze pokud je zvolena platba predem (zalohova faktura), jinak se nove cislo faktury negeneruje
            $invoice_settings=orm::factory("invoice_setting")->where("id","=",1)->find();
            $invoice_code=$invoice_settings->next_invoice_code;
            
            $invoice_settings->next_invoice_code = $invoice_code+1;
            $invoice_settings->save();
            
            return $invoice_code;
            
        }
        else
        {
            return null;
        }
        
    }


    public static function update_order(Model_Order $order, $additional_data=array())//($order, $order_products, $old_products, $added_products)
    {

        $order->last_modified  = date("Y-m-d H:i:s");
        $order->post_track_trace_code = $additional_data["post_track_trace_code"];
        $order->save();
        
        $shopping_cart=$order->get_cart();
        $cart_products=$shopping_cart->get_cart_products(); // ziskam zbozi z kosiku pridruzeneho k objednavce
        $old_products_ids=$shopping_cart->get_old_products();

        //die(var_dump($cart_products));
        
        // priznak zda doslo ke zmene produktu v objednavce - posle se e-mail o zmene obsahu objednavky
        $order_products_changed=false;
        
        // zmena starych produktu (produkty, ktere jiz byly v objednavce)
        //$order_data["products"]
        
        $old_products_temp=$old_products_ids; // TODO elegantneji...
        foreach($cart_products as $item)
        {
            if(key_exists($item["id"], $old_products_temp)) unset($old_products_temp[$item["id"]]);
        }
        if(!empty($old_products_temp))
        {
            foreach($old_products_temp as $key=>$item)
            {
                $cart_products[]=array("id"=>$key,"mnozstvi"=>0);
            }
        }
        
        //die(print_r($cart_products));
        
         foreach($cart_products as $item)
         {
            // zjisteni zda doslo ke zmene ulozenejch dat
            if($item["mnozstvi"]<0) $item["mnozstvi"]=0;
            
                    
            if(isset($old_products_ids[$item["id"]]))
            {
                $order_item = orm::factory("order_item")->where("order_id","=",$order->id)->where("id","=",$old_products_ids[$item["id"]])->find();
                
                if(!$order_item->id) die($order_item->id."- chyba: oid".$order->id." item_product_id:".$item["id"]);

                if($item["mnozstvi"]!=$order_item->units)
                {
                    // ###################### zmena mnozstvi puvodne jiz vlozeneho produktu

                    $order_products_changed=true;

                    $order_item->units=$item["mnozstvi"];
                    $order_item->total_price_with_tax        =$order_item->price_with_tax * $item["mnozstvi"];
                    $order_item->item_change                 =1;
                    $order_item->total_weight                =$order_item->hmotnost * $item["mnozstvi"];
                    $order_item->save();

                    // zaznam do zmenove tabulky
                    $order_item_change = orm::factory("order_item_change");
                    $order_item_change->change_order      = $order->id;
                    $order_item_change->change_item       = $old_products_ids[$item["id"]];
                    $order_item_change->change_date       = date("Y-m-d H:i:s");
                    $order_item_change->change_units_from = $order_item->units;
                    $order_item_change->change_units_to   = $item["mnozstvi"];
                    $order_item_change->change_type       = "internal";
                    $order_item_change->user_id           = Auth::instance()->get_user()->id;

                    $order_item_change->save();   
                } 
            }
            else
            {
                $order_products_changed=true;

                // ###################### pridani noveho produktu do objednavky
                $order_item=orm::factory("order_item");

                // naplneni order itemu
                $order_item->code               =$item["code"];
                $order_item->nazev              =$item["nazev"];
                $order_item->jednotka           =$item["jednotka"];
                $order_item->hmotnost           =$item["hmotnost"];
                $order_item->pocet_na_sklade    =$item["pocet_na_sklade"];
                $order_item->min_order_quantity =$item["min_order_quantity"];
                $order_item->tax_code           =($item["tax_code"])?$item["tax_code"]:"higher_vat";
                $order_item->order_id           =$order->id;
                $order_item->product_id         =$item["id"];
                $order_item->units              =$item["mnozstvi"];
                $order_item->price_without_tax  =$item["cena_bez_dph"];
                $order_item->price_with_tax     =$item["cena_s_dph"];
                $order_item->total_price_with_tax        =$item["cena_celkem_s_dph"];
                $order_item->item_change             =1; // nove pridane zbozi se bere jako zmena poctu
                $order_item->total_weight       =$item["hmotnost"] * $item["mnozstvi"];

                $order_item_id=$order_item->save()->id;

                // zaznam do zmenove tabulky
                $order_item_change = orm::factory("order_item_change");
                $order_item_change->change_order      = $order->id;
                $order_item_change->change_item       = $order_item_id;
                $order_item_change->change_date       = date("Y-m-d H:i:s");
                $order_item_change->change_units_from = 0;
                $order_item_change->change_units_to   = $item["mnozstvi"];
                $order_item_change->change_type       = "internal";
                $order_item_change->user_id           = Auth::instance()->get_user()->id;

                $order_item_change->save();
            }    
        }
        
        if($order_products_changed)
        {
            // bylo manipulovano s obsahem kosiku - poslat email o zmene objednavky
            
        }
        

        return $order;
    }
    
    
    /**
     * Nacte data o objednavce.
     * @param orm $order
     * @return array 
     */
    public static function dump_order($order)
    {
        //$order = orm::factory("order")->where("order_shopper_id",$shopper_id)->where("id",$order_id)->find();
        //die(print_r($order->as_array()));
        $data=$order->as_array();
        //$data["order_price_discount"]=$order->order_total_with_vat-$order->order_voucher_discount;

    // doplnime nektera data, pripadne je zformatujeme
        $data["order_state"]=$order->order_state->nazev;
        $data["order_timestamp"]=strtotime($data["order_date"]);
        $data["order_date"]=date("d.m.Y H:i:s",$data["order_timestamp"]);
        
        // TODO datum splatnosti
        
        $order_state=orm::factory("order_state",$data["order_state_id"]);
        $data["order_status"]=$order_state->popis;

        // doplneni dat o majiteli
        $owner=orm::factory("product_setting",1);//$owner=orm::factory("owner",1);
        $data["owner_firma"]=$owner->billing_data_nazev;
        $data["owner_ulice"]=$owner->billing_data_ulice;
        //$data["owner_cp"]=$owner->cp;
        $data["owner_mesto"]=$owner->billing_data_mesto;
        $data["owner_psc"]=$owner->billing_data_psc;
        $data["owner_ic"]=$owner->billing_data_ic;
        $data["owner_dic"]=$owner->billing_data_dic;
        $data["owner_tel"]=$owner->billing_data_telefon;
        $data["owner_fax"]=$owner->billing_data_fax;
        
        $data["owner_email"]=$owner->billing_data_email;
        $data["owner_banka"]=$owner->billing_data_banka;
        $data["owner_iban"]=$owner->billing_data_iban;
        $data["owner_cislo_uctu"]=$owner->billing_data_cislo_uctu;
        $data["owner_konst_s"]=$owner->billing_data_konst_s;
        $data["owner_spec_s"]=$owner->billing_data_spec_s;
        $data["owner_swift"]=$owner->billing_data_swift;
        $data["owner_due_date"]=$owner->billing_data_due_date;
        $data["owner_www"]="";

        if($data["order_branch_email"]){
            $data["order_branch_name"]=$data["order_branch_name"];
            $data["order_branch_street"]=$data["order_branch_street"];
            $data["order_branch_city"]=$data["order_branch_city"];
            $data["order_branch_zip"]=$data["order_branch_zip"];
            $data["order_branch_phone"]=$data["order_branch_phone"];
            $data["order_branch_email"]=$data["order_branch_email"];
            $data["no_delivery_address"]=false;
        }
        else
        {
            // nebyla vyplnena dodaci adresa, vyplnime ji jako fakturacni
            $data["no_delivery_address"]=true;
        }

        $shipping=$order->shipping;
        $data["order_shipping_id"]=$shipping->id;
        $data["order_shipping_nazev"]=$shipping->nazev;
        $data["order_shipping_descr"]=$shipping->popis;
        // ceny jsou ulozeny v objednavce

        $payment=$order->payment;
        $data["order_payment_id"]=$payment->id;
        $data["order_payment_nazev"]=$payment->nazev;
        $data["order_payment_predem"]=$payment->predem;
        // ceny jsou ulozeny v objednavce

        
        // seznam produktu v objednavce
        $order_products = $order->items->find_all();
        $x=0;
        foreach($order_products as $product){
            $data["products"][$x]=$product->as_array();

            $x++;
        }
        
        $data["order_total_vat"]=$data["order_total_with_vat"] - $data["order_total_without_vat"];
        
        //die(print_r($data));
        return $data;
    }

    
    
    
    
    
}
?>
