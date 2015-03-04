<?php defined('SYSPATH') or die('No direct script access.');

/**
 * query
 *
 * @author Pavel
 */
class AutoForm_Query extends Database_Query_Builder_Select
{
    protected $_join=array();
    protected $_last_join=array();
    public $find=false;
    public $find_all=false;
    public $column_to_get;
    
    public static function factory()
    {
        return new AutoForm_Query;
    }
    
    public function join($table, $type = NULL)
    {
        $this->_last_join = array($table, $type);
        return $this;
    }
    
    public function on($c1, $op, $c2)
    {
        $this->_join[]=array("join"=>$this->_last_join,"on"=>array($c1, $op, $c2));
        $this->_last_join=array();
        return $this;
    }
    
    public function find()
    {
        $this->find=true;
        return $this;
    }
    
    public function find_all()
    {
        $this->find_all=true;
        return $this;
    }
    
    public function __get($name)
    {
        $this->column_to_get=$name;
        return $this;
    }
    
    public function decorate_object($object)
    {
        if(!empty($this->_distinct)) $object=$object->distinct();
        if(!empty($this->_select))
        {
            foreach($this->_select as $item) $object=$object->select($item);
        }
        
        if(!empty($this->_from))
        {
            foreach($this->_from as $item) $object=$object->from($item);
        }
        
//        if(!empty($this->_where))
//        {
//            foreach($this->_where as $item) $object=$object->where($item);
//        }
        
        if(!empty($this->_join))
        {
            
            foreach($this->_join as $item) $object=$object->join($item["join"][0],$item["join"][1])->on($item["on"][0],$item["on"][1],$item["on"][2]);
        }
        
//        if($this->find)
//        {
//            $object=$object->find();
//        }
//        elseif($this->find_all)
//        {
//            $object=$object->find_all();
//        }
//
//        if($this->column_to_get)
//        {
//            $column_to_get=$this->column_to_get;
//            $object=$object->$column_to_get;
//        }
       
        
        return $object;
    }
}

?>
