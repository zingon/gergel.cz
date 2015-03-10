<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Servisa zpracovavajici pozadavky uzivatele na verejne casti.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class Service_Hana_User extends Service_Hana_Module_Base {
    
    protected static $navigation_module="page";
    protected static $chainable=true; // modul ma stromovou strukturu
    private $user_class_name="shopper";
    private $user_orm; // ormko produktu

    public $errors=array();

    public static $instance;

    public function __construct()
    {
        $this->user_orm=orm::factory($this->user_class_name);
        $this->session=Session::instance();
    }

    /**
     *
     * @return Service_User
     */
    public static function instance()
    {
        if(!self::$instance) self::$instance=new Service_User;
        return self::$instance;
    }

    public function check_user_data($data)
    {
        $this->user_orm->values($data);
        if($this->user_orm->check())
        {
            return true;
        }
        else
        {
            //die(print_r($this->user_orm->validate()->errors()));
            $this->errors = $this->user_orm->validate()->errors("default_errors");
            return false;
        }
    }
    
    public function check_branch_data($data, $branch)
    {   
        $branch->values($data);
        if($branch->check())
        {
            return true;
        }
        else
        {
            //die(print_r($this->user_orm->validate()->errors()));
            $this->errors["branch_errors"] = $branch->validate()->errors("default_errors");
            return false;
        }
    }

    public function logged_in($user=false)
    {
        if($user)
        {
            return $user->logged_in();
        }
        elseif(!$user)
        {
            return $user=Shauth::instance()->logged_in();
        }
    }

    public function is_temporarily_stored()
    {
        return (isset($_SESSION["shopper"]))? true:false;
    }

    public function need_insert_user_data($status=null)
    {
        if(!$this->is_temporarily_stored()) return true;

        if($status===true)
        {
            $_SESSION["need_insert_user_data"]=true;
        }
        elseif($status===false)
        {
            $_SESSION["need_insert_user_data"]=false;
        }

        return (isset($_SESSION["need_insert_user_data"]))?$_SESSION["need_insert_user_data"]:true;

    }

    public function login($username, $password)
    {
        if(Shauth::instance()->login($username, $password))
        {
            return true;
        }
        else
        {
            //$this->errors = ; zadna konkretni chyba
            return false;
        }
    }

    public function logout()
    {
        return Shauth::instance()->logout();
    }

    public function get_user($user=false)
    {
        if ($user && ! is_object($user))
        {
                $username = $user;
                // Load the user
                $user = ORM::factory($this->user_class_name)->where("username", '=', $username)->find();
        }
        elseif(!$user)
        {
            $user=Shauth::instance()->get_user();

            // pokud neni uzivatel prihlasen, pokusim se nacist jeho data ze sesny
            
            if(!$user && $this->is_temporarily_stored())
            {
                $this->user_orm->temporarily_load();
                return $this->user_orm;
            }

        }
        
        if($user==false) $user=ORM::factory($this->user_class_name); // pri neuspechu se vrati prazdny objekt uzivatele

        return $user;
    }

    public function register_user($data,Hana_Response $response=null)
    {
        if($this->check_user_data($data))
        {
            $user_id = $this->user_orm->save()->id;
            $user_code = (string) $this->_create_new_user_code($user_id);
            $this->user_orm->kod = $user_code;
            
            //$this->user_orm->action_first_purchase=1;
            
            // specialni akce pro prvni registraci
//            if(Session::instance()->get("action_first_purchase"))
//            {
//                $this->user_orm->action_first_purchase=1;
//                Session::instance()->delete("action_first_purchase");
//            }
            
            
            $this->user_orm->save();
            return true;
        }
        else
        {
            $response->set_errors($this->errors);
            return false;
        }
    }

    private function _create_new_user_code($user_id)
    {
        return(str_pad($user_id, 6, "0", STR_PAD_LEFT));
    }

    public function change_registration_data($data, Hana_Response $response=null)
    {
        $this->user_orm=$this->get_user();
        // omezeni validaci pri zmene registracnich dat
        unset($this->user_orm->_rules["obchodni_podminky"]);
        if($data["email"]==$this->user_orm->email) unset($this->user_orm->_callbacks["email"]);;
        if(!$data["password"])
        {
            unset($this->user_orm->_rules["password"]);
            unset($this->user_orm->_rules["password_confirm"]);
            unset($data["password"]);
        }
        elseif($data["password"]==$data["password_confirm"])
        {
            unset($this->user_orm->_rules["password_confirm"]);
        }
        
        if($this->check_user_data($data))
        {
            $this->user_orm->save();
            return true;
        }
        else
        {
            $response->set_errors($this->errors);
            return false;
        }
    }
    
    public function save_branch_data($data, $user_id)
    {
        //if(!$user_id) die();
        if(isset($data["id"]))
        {
            $branch = orm::factory("shopper_branch")->where("shopper_id","=",$user_id)->where("id","=",$data["id"])->where("smazano","=",0)->find();
            unset($data["id"]); // kvuli rozpoznani insert/update orm
        }
        else
        {
            $branch = orm::factory("shopper_branch");
            $branch->shopper_id=$user_id;
        }
                
        $branch->values($data);
        if($branch->check())
        {
            if($branch->save()) return true;
        }
        else
        {
            $this->errors = $branch->validate()->errors("default_errors");
            return false;
        }
    }

    public function get_shopper_branch($branch_id=0, $user=false)
    {
        if($this->logged_in())
        {
            if(!$user) $user=$this->user_orm;
            if(!$branch_id) $branch_id=$this->session->get("branch_id", 0);

            $branch = orm::factory("shopper_branch")->where("shopper_id","=",$user->id)->where("id","=",$branch_id)->where("smazano","=",0)->find();
            if(!$branch->id)
            {
                // stejna jako fakturacni
                $branch=array();
    //            $branch["kod"]=$user->kod;
    //            $branch["nazev"]=$user->nazev;
    //            $branch["email"]=$user->email;
    //            $branch["telefon"]=$user->telefon;
    //            $branch["ulice"]=$user->ulice;
    //            $branch["mesto"]=$user->mesto;
    //            $branch["psc"]=$user->psc;
            }
            else
            {
                $branch=$branch->as_array();
            }
        }
        else
        {
            // uzivatel neni prihlasen - pokusime se nacist pobocku ze sesny
            $branch=orm::factory("shopper_branch")->temporarily_load();
            //die(print_r($branch));
            if($branch->nazev)
            {
                $branch=$branch->as_array();
            }
            else
            {
                $branch=array();
            }
        }

        return $branch;
    }
    
    public function get_order_shopper_branches($shopper)
    {
        $selected_branch_id=$this->session->get("branch_id",false);

        $branches=$shopper->shopper_branches->where("smazano","=",0)->find_all();
        $result_array=array();
        $result_array[1]["id"]=0;
        $result_array[1]["nazev"]="stejná jako fakturační";
        $result_array[1]["checked"]=$selected_branch_id?false:true;
        $x=2;
        foreach($branches as $item)
        {
            
                $result_array[$x]=$item->as_array();

            if($item->id==$selected_branch_id)
            {
                if(!$selected_branch_id) $this->session->set("branch_id", $item->id); // pokud jeste nebyla zvolena pobocka
                $result_array[$x]["checked"]=true;
            }
            else
            {
                $result_array[$x]["checked"]=false;
            }
            $x++;
        }
        if($x==2) $result_array[1]["checked"]=true;

        return $result_array;
    }
    
    public function store_shopper_branch($selected_branch_id)
    {  
        $this->session->set("branch_id", $selected_branch_id);
        return true;
    }

    
    public function get_all_user_branches($user=false)
    {
        if(!$user) $user=$this->user_orm;
        return orm::factory("shopper_branch")->where("shopper_id","=",$user->id)->where("smazano","=",0)->find_all();
    }
    
    public function delete_user_branch($branch_id, $user_id)
    {

        $branch = orm::factory("shopper_branch")->where("shopper_id","=",$user_id)->where("id","=",$branch_id)->where("smazano","=",0)->find();
        if(!$branch->id)
        {
            return false;
        }
        else
        {
            $branch->smazano=1;
            if($branch->save()) return true;
        }
        return false;
    }

    public function temporarily_store_user($data)
    {
        $result=false;
        
        // pri docasnem ulozeni nebudu pozadovat login, heslo ani unikatni e-mail, upravim proto dynamicky validacni pravidla
        unset($this->user_orm->_rules["username"]);
        unset($this->user_orm->_rules["password"]);
        unset($this->user_orm->_rules["password_confirm"]);
        unset($this->user_orm->_callbacks["username"]);
        unset($this->user_orm->_callbacks["email"]);

        if($this->check_user_data($data["unregistered-user"]))
        {
            $this->user_orm->temporarily_store();
            $result = true;
        }
        else
        {
            $result = false;
        }
        
        $branch_data=$data["unregistered-user-branch"];
        //die(print_r($branch_data));
        // uzivatelska data prosla - druhy krok je pripadne docasne ulozeni pobocky
        if(isset($branch_data["branch_enabled"]) && $branch_data["branch_enabled"])
        {
            $branch=orm::factory("shopper_branch"); 
            if($this->check_branch_data($branch_data, $branch))
            {
                
                $branch->temporarily_store();
            }
            else
            {
                $result = false;
            }
        }   
            
        
        
        return $result;

    }

    public function delete_temporarily_stored_user()
    {
        $this->user_orm->destroy_temporarily_data();
    }
    
//    /**
//     * Vrati jeden segment retezce drobitkove navigace dle seo_nazvu.
//     * @param type $nazev_seo
//     * @return array 
//     */
//    public static function get_navigation_breadcrumbs($nazev_seo)
//    {
//        
//        if(Hana_Application::instance()->get_main_controller_action()=="index") return array();
//        $result_data=array();
//        
//        $module=self::$navigation_module;
//        $article_data = DB::select($module."_data.nazev","routes.nazev_seo","routes.language_id")
//                ->from($module."s")
//                ->join($module."_data")->on($module."s.id","=",$module."_data.".$module."_id")
//                ->join("routes")->on($module."_data.route_id","=","routes.id")
//                ->where("routes.nazev_seo","=",$nazev_seo)
//                ->where("routes.zobrazit","=",DB::expr(1))
//                ->execute()->as_array();
//        $result_data[$nazev_seo]=$article_data[0];
//        
//        $result_data[$nazev_seo]["parent_nazev_seo"]=DB::select("routes.nazev_seo")->from("routes")->join("modules")->on("routes.module_id","=","modules.id")->where("modules.kod","=",$module)->where("routes.module_action","=","index")->where("routes.zobrazit","=",DB::expr(1))->execute()->get("nazev_seo");
//        
//        return($result_data);
//        
//    }

}
?>
