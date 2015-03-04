<?php defined('SYSPATH') or die('No direct script access.');

class Model_Product_Setting extends ORM
{
    protected $_table_name="eshop_settings";
    protected $_table_columns=array("id"=>array(),"billing_data_nazev"=>array(),"billing_data_email"=>array(),"billing_data_banka"=>array(),"billing_data_iban"=>array(),"billing_data_due_date"=>array(),"billing_data_cislo_uctu"=>array(),"billing_data_konst_s"=>array(),"billing_data_spec_s"=>array(),"billing_data_telefon"=>array(),"billing_data_fax"=>array(),"billing_data_mesto"=>array(),"billing_data_ulice"=>array(),"billing_data_psc"=>array(),"billing_data_ic"=>array(),"billing_data_dic"=>array(),"billing_data_swift"=>array(),"present_enabled"=>array(),"present_price_threshold"=>array(),"shipping_free_threshold"=>array(),"first_purchase_discount"=>array());
}
?>
