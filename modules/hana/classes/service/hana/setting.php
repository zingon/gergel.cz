<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Servisni trida umoznujici pristup k nastavenim v tabulce "settings"
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class Service_Hana_Setting {

    private static $instance;

    /**
     *
     * @return Service_Hana_Setting
     */
    public static function instance()
    {
        if(!self::$instance) self::$instance=new Service_Hana_Setting;

        return self::$instance;
    }

    public function get()
    {

    }

    /**
     * Slouzi pro ziskani sekvence nastaveni v presne stanovenem poradi. (pouziti napr. pro hromadne generovani obrazku)
     * @param string $module_code
     * @param string $submodule_code
     * @param string $value_code
     * @param string $value_subcode_1
     * @param string $value_subcode_2
     */
    public function get_sequence_array($module_code, $submodule_code=false, $value_code=false, $value_subcode_1=false, $value_subcode_2=false)
    {
        $settings=orm::factory("setting")->where("module_code","=",$module_code);
        if($submodule_code) $settings->where("submodule_code","=",$submodule_code);
        if($value_code) $settings->where("value_code","=",$value_code);
        if($value_subcode_1) $settings->where("value_subcode_1","=",$value_subcode_1);
        if($value_subcode_2) $settings->where("value_subcode_2","=",$value_subcode_2);
        $settings=$settings->order_by("module_code")->order_by("submodule_code")->order_by("value_code")->order_by("value_subcode_1")->order_by("poradi")->find_all();

        $result_data=array();
        foreach($settings as $setting)
        {
            if($value_subcode_2) $result_data[]=$setting->value;
            elseif($value_subcode_1) $result_data[$setting->value_subcode_2]=$setting->value;
            elseif($value_code) $result_data[$setting->value_subcode_1][$setting->value_subcode_2]=$setting->value;
            elseif($submodule_code) $result_data[$setting->value_code][$setting->value_subcode_1][$setting->value_subcode_2]=$setting->value;
            elseif($module_code) $result_data[$setting->submodule_code][$setting->value_code][$setting->value_subcode_1][$setting->value_subcode_2]=$setting->value;
        }

        return $result_data;
        

    }

}
?>
