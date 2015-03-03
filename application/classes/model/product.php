<?php defined('SYSPATH') or die('No direct script access.');


class Model_Product extends ORM_Language
{
    protected $_join_on_routes=true;
    
    protected $_product_priceholder=null;
    
    
    /**
     * Vrati objekt s vypoctenymi cenami.
     * @param type $price_category cenova kategorie - defaultne 0 = vezme se od prihlaseneho uzivatele/defaultni
     * @return Model_Product_Priceholder 
     */
    public function prices($price_category=false, $voucher=false)
    {
        if(!$price_category)
        {
            $user=Service_User::instance()->get_user();
            if($user && $user->price_category_id)
            {
                $price_category=$user->price_category->kod;
            }
        }
        
        if(empty($this->_product_priceholder[$price_category])) 
        {
            $this->_product_priceholder[$price_category]=new Model_Product_Priceholder($this, $price_category, $voucher);
        }
        
        return isset($this->_product_priceholder[$price_category])?$this->_product_priceholder[$price_category]:"";
    }
    
    
    //////////// orm vazby, validacni pravidla
    
    protected $_has_many = array(
        'product_categories' => array('through' => 'product_categories_products'),
        'product_parameters' => array('through' => 'product_parameters_products'),
        'downloads'     => array('through' => 'product_downloads_products'),
        'price_categories' => array('through' => 'price_categories_products'),
        'product_photos' => array(),
        'product_files' => array()
    );

    protected $_belongs_to = array(
        "tax"=>array(),
        "gallery" => array(),
        "manufacturer"=>array(),
    ); 

    // Validation rules
	protected $_rules = array(
		'nazev' => array(
			'not_empty'  => NULL,
		),
    	'code' => array(
			'not_empty'  => NULL,
		),
   );
  
      // Validation callbacks
    protected $_callbacks = array(
            'code' => array('code_available')
    );

    protected $_filters = array(TRUE => array('trim' => NULL));



    public function code_available(Validate $array, $field)
    {
            if ($this->unique_key_exists($array[$field], 'code'))
            {
                    $array->error($field, 'not_unique_code', array($array[$field]));
            }
    }

    /**
	 * Tests if a unique key value exists in the database.
	 *
	 * @param   mixed    the value to test
	 * @param   string   field name
	 * @return  boolean
	 */
	public function unique_key_exists($value, $field = NULL)
	{
		if ($field === NULL)
		{
			// Automatically determine field by looking at the value
			$field = $this->unique_key($value);
		}

		return (bool) DB::select(array('COUNT("*")', 'total_count'))
			->from($this->_table_name)
			->where($field, '=', $value)
			->where($this->_primary_key, '!=', $this->pk())
			->execute($this->_db)
			->get('total_count');
	}
}
?>
