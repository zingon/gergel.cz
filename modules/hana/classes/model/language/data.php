<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * Auto model pro pripojeny jazykovy tabulky.
 */
class Model_Language_Data extends ORM {
    public static $dynamic_table_name;
    public static $dynamic_table_columns;

    public function __construct($id = NULL) {
        $this->_table_name=self::$dynamic_table_name;
        $this->_table_columns=self::$dynamic_table_columns;
        parent::__construct($id);
    }
    
    


}
?>