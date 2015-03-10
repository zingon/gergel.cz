<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Specialni kontejner upravujici chovani standardniho kontejneru pro obsluhu ORM Iteratoru.
 * Vlozene prvky jsou volany ve smycce pro kazdou sadu dat.
 * Pod tento kontejner se nedaji vkladat zadne dalsi kontejnery (mozna casem...)
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_MultipleContainer extends AutoForm_Container
{
    protected $tree_mode=false; // urcuje, zda se bude generovat strom
    protected $tree_level=1; // pri generovani urcuje hloubku zanoreni

    // property, ktere se automaticky vyplni pri generovani z nadrazeneho kontejneru
    protected $order_by;
    protected $order_direction;
    protected $where;
    protected $like;


    public function generate($data_orm, $template=false)
    {
        $container_name=$this->entity_name;

        // zjisteni zda jsme v orm tree modu
        $this->tree_mode=$this->parent_container->tree_mode;

//        $result_data=array(); // pole dat
        $result_array=array(); // pole grafickych vystupu

        // pri generovani vnorenych urovni si z nadrazeneho kontejneru musim zjistit nastaveni potrebnych promennych
        $this->order_by           =$this->parent_container->order_by;
        $this->order_direction    =$this->parent_container->order_direction;
        $this->where              =$this->parent_container->filtering_section->get_where_rules($this->parent_container->module_key, $this->parent_container->submodule_key, $this->parent_container->subaction_key);
        $this->like               =$this->parent_container->filtering_section->get_like_rules($this->parent_container->module_key, $this->parent_container->submodule_key, $this->parent_container->subaction_key);
        
        $_SESSION["item_sequence"]=array();
        $result_array = $this->_generate($data_orm);
        
//        $this->result_data=$result_data;
    
        if($template)
        {
            $template->$container_name=$result_array;
        }else{
            return $result_array;
        }
    }

    private function _generate($data_orm, $level=0)
    {
        $level++;
        $result_array=array();
        
        
        foreach($data_orm as $row)
        {
            $_SESSION["item_sequence"][]=$row->id;
            
            $this->tree_level=$level;
            
            foreach($this->container as $name=>$entity)
            {
//                //pregenerovani
//                $response=$entity->pregenerate($this->data);
//                if($response) $result_data[$name][$row->id] = $response;

                // generovani
                $result_array[$row->id][$name]=$entity->generate($row);
                
                
            }
            // testuju, zda existuji vnorene polozky, podminky pro sortovani budou stejne jakou u nadrazeneho kontejneru
            if($this->parent_container->tree_mode)
            {
                $children = clone $this->parent_container->orm;
                //$children=orm::factory($this->parent_container->orm->object_name())->where("parent_id","=",$row->id);
                $children->where("parent_id","=",$row->id);

                // brutalni vyjimka (TODO - vyresit proc properta $this->parent_container->orm neobsahuje aplikovana pravidla select apod. z puvodniho orm objektu, nepredava se odkazem??)
                if($this->parent_container->orm instanceof Model_Page){
                    $page_cat=$this->parent_container->orm->page_category_id;
                
                    $children->join("routes")->on("page_data.route_id","=","routes.id");
                    $children->join("modules")->on("routes.module_id","=","modules.id");
                    $children->where("page_category_id","=",db::expr($page_cat));
                    $children->select(array("modules.nazev","controller"))->select(array("routes.module_action","action"));
                }

                if($this->where)
                {
                    foreach($this->where as $item)
                    {
                        $children->where($item[0],$item[1],$item[2]);
                    }
                }

                if($this->like)
                {
                    foreach($this->like as $item)
                    {
                        $children->where($item[0],$item[1],$item[2]);
                    }

                }

                if($this->order_by) $children->order_by($this->order_by,$this->order_direction);
                $children = $children->find_all();

                $children_array=$this->_generate($children, $level);
                if(!empty($children_array))
                {
                    $result_array=$result_array + $children_array;
                }
            }
        }
        return ($result_array);
    }

}
?>
