<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Centrální třída pro správu navigací. Generování, skládání, cachování.
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Hana_Navigation {

    private static $instance;
    private $navigation_configuration = array();
    private $navigation = array();
    private $navigation_breadcrumbs = array();

    /**
     *
     * @return Hana_Navigation
     */
    public static function instance() {
        if (self::$instance === NULL) {
            self::$instance = new Hana_Navigation();
        }

        return self::$instance;
    }

    private function __construct() {
        // konfigurace 
        // slozeni hlavni navigace - kategorie 3 (1 nepouzivat !):
        $this->add_navigation_branch(3, 6, 1, false); // znamena: "pro 3 kategorii navigace (stranky v menu), kdyz koncovy uzel bude module 6 (produkty) generuj jeho navigaci s nastavenim kategorie 1 a hloubky navigace nekonecno)
    }

    /**
     * Metoda pro navazovani vetvi navigace.
     * @param int $main_navigation_category
     * @param type $branch_navigation_module_id
     * @param type $branch_navigation_category
     * @param type $branch_navigation_max_levels
     */
    public function add_navigation_branch($main_navigation_category, $branch_navigation_module_id, $branch_navigation_category, $branch_navigation_max_levels) {
        if ($main_navigation_category == 1)
            $main_navigation_category = 3;
        $this->navigation_configuration[$main_navigation_category][$branch_navigation_module_id] = array("branch_navigation_category" => $branch_navigation_category, "branch_navigation_max_levels" => $branch_navigation_max_levels);
    }

    /**
     * Vygeneruje strukturu stromove navigace - zaklad tvori navigace "Pages", pripojene vetve navigaci - dle konfigurace.
     * @param int $language_id jazykova verze navigace
     * @param int $navigation_category kategorie (stranek) navigace
     * @param int $parent_id nadrazena polozka, od ktere se bude generovat strom
     * @param int $include_parent priznak, zda bude nadrazena polozka rovnez zahrnuta do stromu
     * @param int $cache
     * @return array
     */
    public function get_navigation($language_id, $navigation_category = 3, $parent_id = 0, $include_parent = false, $cache = true) {
        if (empty($this->navigation[$language_id][$navigation_category])) {
            //zjistime zda byla navigace ulozena do cache (je-li povolena)
            if ($cache) {
                $cached_content = Cache::instance()->get('navigation_type_' . $navigation_category);
                if (!empty($cached_content[$language_id])) {
                    $this->navigation[$language_id][$navigation_category] = $cached_content[$language_id];
                } else {
                    $this->navigation[$language_id][$navigation_category] = $this->get_base_navigation($language_id, $navigation_category, array(), $parent_id, $include_parent);

                    // ulozim tuto jazykovou verzi do cache
                    $cached_content[$language_id] = $this->navigation[$language_id][$navigation_category];
                    Cache::instance()->set('navigation_type_' . $navigation_category, $cached_content);
                }
            } else {
                $this->navigation[$language_id][$navigation_category] = $this->get_base_navigation($language_id, $navigation_category, array(), $parent_id, $include_parent);
            }
        }
        //die(print_r($this->navigation[$language_id][$navigation_category]));
        return $this->navigation[$language_id][$navigation_category];
    }

    /**
     * Smazani prislusne navigacni cache. Pouziti do adminu v pripade zmen struktury stranek, nebo jakehokoliv modulu, ktery se na tvorbe menu podili.
     *
     * @param int $navigation_category kategorie navigace ke smazani (false = vsechny)
     */
    public function delete_navigation_cache($navigation_category) {
        Cache::instance()->delete('navigation_type_' . $navigation_category);
    }

    /**
     * Metoda na vygenerovani struktury navigace
     * @param int $language_id jazykova verze
     * @param array $breadcrumbs aktualni cesta (vygeneruje pouze vetve, ktere jsou v ramci retezce zvolene cesty)
     * @param int $category kategorie navigace (page_categories)
     */
    public function get_base_navigation($language_id, $navigation_category, $breadcrumbs = array(), $parent_id = 0, $include_parent = false) {
        // mozne nastaveni pravidla jaky typ stranek bude pouzit v zavislosti na kategorii navigace
        $page_category = $navigation_category;

        $result_data = array();
        $nodes = DB::select("page_data.nazev","page_data.uvodni_popis","routes.nazev_seo", "routes.language_id", "routes.module_id", "pages.parent_id", "pages.id", "pages.nav_class", "pages.indexpage", "pages.direct_to_sublink", "pages.show_in_submenu")
            ->from("pages")
            ->join("page_data")->on("pages.id", "=", "page_data.page_id")
            ->join("routes")->on("page_data.route_id", "=", "routes.id")
            ->where("pages.page_category_id", "=", db::expr($page_category));
        if ($include_parent && $parent_id != 0) {
            $nodes->where("pages.id", "=", db::expr($parent_id));
        } else {
            $nodes->where("pages.parent_id", "=", db::expr($parent_id));
        }

        $nodes = $nodes->where("routes.language_id", "=", DB::expr($language_id))
            ->where("routes.zobrazit", "=", DB::expr(1))
            ->where("pages.show_in_menu", "=", DB::expr(1))
            ->order_by("poradi")
            ->as_object()->execute();

        foreach ($nodes as $node) {
            $result_data[$node->nazev_seo] = (array) $node;
            $result_data[$node->nazev_seo]["children"] = array();
            // podrizene vetve - pages
            $child_nodes = array();
            if ((!empty($breadcrumbs) && key_exists($node->nazev_seo, $breadcrumbs)) || empty($breadcrumbs)) {
                $child_nodes = $this->get_base_navigation($language_id, $navigation_category, $breadcrumbs, $node->id);
                if (!empty($child_nodes)) {
                    $result_data[$node->nazev_seo]["children"] = array();

                    // show in submenu 
                    if ($result_data[$node->nazev_seo]["show_in_submenu"] == 1) {
                        $result_data[$node->nazev_seo]["children"] = array_merge($result_data[$node->nazev_seo]["children"], array($node->nazev_seo => $result_data[$node->nazev_seo]));
                    }

                    $result_data[$node->nazev_seo]["children"] = array_merge($result_data[$node->nazev_seo]["children"], $child_nodes);

                    // direct to sublink 
                    if ($result_data[$node->nazev_seo]["direct_to_sublink"] == 1 && $result_data[$node->nazev_seo]["show_in_submenu"] != 1) {
                        $first_child = array_shift($child_nodes);
                        $result_data[$node->nazev_seo]["nazev_seo"] = $first_child["nazev_seo"];
                    }
                }
            }

            // podrizene vetve - modules
            if ($node->module_id != 1) {
                $result_data[$node->nazev_seo]["children"] = array_merge($this->get_module_navigation_branch($language_id, $navigation_category, $node->module_id), $result_data[$node->nazev_seo]["children"]);
            }
        }

        return $result_data;
    }

    public function get_module_navigation_branch($language_id, $main_navigation_category, $branch_navigation_module_id) {

        if (!empty($this->navigation_configuration[$main_navigation_category][$branch_navigation_module_id])) {

            // krome page, vsechny podrizene stranky: get_navigation($language_id,$category=0,$levels=false)
            $settings = $this->navigation_configuration[$main_navigation_category][$branch_navigation_module_id];

            $leaf_module = db::select("kod")->from("modules")->where("id", "=", db::expr($branch_navigation_module_id))->execute()->get("kod");
            $leaf_module_service = "Service_" . ucfirst($leaf_module);
            return $leaf_module_service::get_navigation($language_id, $settings["branch_navigation_category"], $settings["branch_navigation_max_levels"]);
        } else {
            return array();
        }
    }

    /**
     * Vygeneruje retezec drobitkove navigace - spojenim retezce modulove navigace a zakladni strankove navigace.
     *
     * @param type $nazev_seo
     */
    public function get_navigation_breadcrumbs() {
        if (empty($this->navigation_breadcrumbs)) {
            $nazev_seo = Hana_Application::instance()->get_actual_seo();
            $breadcrumbs_part = array();
            $leaf_module = Hana_Application::instance()->get_main_controller();

            if ($leaf_module != "page") {

                $service = "Service_" . ucfirst($leaf_module);
                try {
                    $breadcrumbs_part = $service::get_navigation_breadcrumbs($nazev_seo);
                } catch (Exception $exc) {
                    throw new Kohana_Exception("Chyba v systému navigace - v servise " . $service . " chybí metoda \"get_navigation_breadcrumbs\", nebo je chybná:" . $exc);
                }

                if (!empty($breadcrumbs_part)) {

                    $temp = $breadcrumbs_part;
                    $linked_breadcrumb = array_pop($temp);
                    if (isset($linked_breadcrumb["parent_nazev_seo"]))
                        $nazev_seo = $linked_breadcrumb["parent_nazev_seo"];
                }
            }

            if ($nazev_seo && $nazev_seo != I18n::get("index")) {
                $this->navigation_breadcrumbs = array_merge($breadcrumbs_part, Service_Page::get_navigation_breadcrumbs($nazev_seo));
            } else {
                $this->navigation_breadcrumbs = $breadcrumbs_part;
            }
        }
        //die(print_r($this->navigation_breadcrumbs));
        return $this->navigation_breadcrumbs;
    }

    public function get_navigation_homepage($limit = 0)
    {
        $category_data = array();

        $category_base = DB::select("product_categories.id", "product_categories.template", "product_category_data.title", "product_categories.photo_src", "routes.nazev_seo", "product_categories.parent_id")
            ->from("product_categories")
            ->join("product_category_data")->on("product_categories.id", "=", "product_category_data.product_category_id")
            ->join("routes")->on("product_category_data.route_id", "=", "routes.id")
            ->where("product_category_data.zobrazit", "=", 1)
            ->and_where("routes.zobrazit", "=", 1)
            ->order_by("product_categories.id","ASC");
        if($limit){
            $category_base = $category_base->limit($limit);
        }
        $category_base =  $category_base->as_object()->execute();
        $cislo = 0;
        foreach ($category_base as $item) {
            $photo_dir = "media/photos/product/category/images-" . $item->id . "/";


            if ($item->parent_id == 0) {

                $category_data[$item->id]['title'] = $item->title;
                $category_data[$item->id]['nazev_seo'] = $item->nazev_seo;
                if (is_dir($photo_dir)) {
                    $category_data[$item->id]['photo'] = $photo_dir . $item->nazev_seo . "-ad.jpg";

                    if (file_exists($photo_dir . $item->nazev_seo . "-nav-t3.jpg")) {
                        $category_data[$item->id]['photo_nav'] = $photo_dir . $item->nazev_seo . "-nav-t3.jpg";
                    }
                }
                $category_data[$item->id]['cislo'] = $cislo;
            } else {
                $category_data[$item->parent_id]['children'][$item->id]['title'] = $item->title;
                $category_data[$item->parent_id]['children'][$item->id]['nazev_seo'] = $item->nazev_seo;
            }
            $cislo++;
        }
        return $category_data;
    }

}
?>

