<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Route extends ORM
{
    protected $_table_columns=array(
        "id"=>array(),
        "nazev_seo"=>array(),
        "module_id"=>array(),
        "module_action"=>array(),
        "param_id1"=>array(),
        "language_id"=>array(),
        "baselang_route_id"=>array(),
        "title"=>array(),
        "description"=>array(),
        "keywords"=>array(),
        "read_only"=>array(),
        "internal"=>array(),
        "searcheable"=>array(),
        "deleted"=>array(),
        "nazev_seo_old"=>array(),
        "created_date"=>array(),
        "deleted_date"=>array(),
        "updated_date"=>array(),
        "zobrazit"=>array()
        );
    
    protected $_belongs_to = array(
        'module' => array()
    );

    // Validation rules
    protected $_rules = array(
            'nazev_seo' => array(
                    'not_empty'  => NULL,
            ),
            'module_id' => array(
                    'not_empty'  => NULL,

            ),
            'module_action' => array(
                    'not_empty'  => NULL,

            ),

    );

    // Validation callbacks
    protected $_callbacks = array(
            'nazev_seo' => array('seo_available')
    );

    protected $_filters = array(TRUE => array('trim' => NULL));



    public function seo_available(Validate $array, $field)
    {
            if ($this->unique_key_exists($array[$field], 'nazev_seo'))
            {
                    $array->error($field, 'not_unique_nazev_seo', array($array[$field]));
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
