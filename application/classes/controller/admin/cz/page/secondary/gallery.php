<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace produktu - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Page_Secondary_Gallery extends Controller_Hana_Photoedit
{
    public function before() {
        $this->orm=new Model_Page();
        parent::before();
        
//        // vyjimka pro zdroj velikosti fotek u galerie, ktera jinak pouziva stejny edit jako page
//        //die($this->item_id);
//        $page_type=db::select(array("modules.kod","kod"))->from("modules")
//                ->join("routes")->on("modules.id","=","routes.page_type_id")
//                ->join("page_data")->on("routes.id","=","page_data.route_id")
//                ->where("page_data.page_id","=",$this->item_id)->as_object()->execute()->current()->kod;
//        // jine nahledy u galerie - page type = 3
//        if($page_type=="photo")
//        {
//            $this->set_module_key="photo";
//            //$this->settings_submodule_code="gallery";
//        }    
    }
}
?>
