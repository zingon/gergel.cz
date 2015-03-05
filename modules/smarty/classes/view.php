<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Adapter na Smarty 3 template object. 
 * 
 *
 * @package    Ksmarty
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 * @license    http://kohanaphp.com/license.html
 */

class View extends Kohana_View {
     
     /**
      * @var Smarty_Internal_Template
      */
     private $smarty_template_object;
    
     public function __construct($file = NULL, array $data = NULL)
     {
         parent::__construct($file, $data);
         
         // pokud jde o smarty, zalozime specialni smarty template object (Smarty 3) - nazev tpl souboru musi byt zadan
         if ((Kohana::config('smarty')->integration) && (substr(strrchr($this->_file, '.'), 1) == Kohana::config('smarty')->template_ext))
         {
             if (empty($this->_file))
             {
                    throw new Kohana_View_Exception('You must set the file to use within your view before creating Smarty 3 template object');
             }
             $this->smarty_template_object = Ksmarty::instance()->createTemplate($this->_file);
         }
         
     }
     
     public function render($file = NULL)
     {
         if(!empty($this->smarty_template_object))
         {
            return View::capture($this->smarty_template_object, $this->_data); 
         }
         else
         {
            return parent::render($file);
         }
     }
     
     /**
      * Zpristupni samotny Smarty_Internal_Template objekt pro moznost nastaveni specifickych Smarty parametru.
      *  
      * @return Smarty_Internal_Template 
      */
     public function get_smarty_template_object()
     {
         if(!empty($this->smarty_template_object))
         {
             return($this->smarty_template_object);
         }
         else
         {
             throw new Kohana_View_Exception('This is not a Smarty 3 template');
         }
     }
     
//     public function __call($name, $arguments)
//     {
//         if(!empty($this->smarty_template_object))
//         {
//             // volani funkci smarty template objektu
//             return(call_user_method_array($name, $this->smarty_template_object, $arguments));
//         }
//     }
     

	/**
	 * Captures the output that is generated when a view is included.
	 * The view data will be extracted to make local variables. This method
	 * is static to prevent object scope resolution.
	 *
	 * @param   string  Smarty_Internal_Template
	 * @param   array   variables
	 * @return  string
	 */
	protected static function capture($template, array $data)
	{ 
            if(!(is_object($template))) return parent::capture ($template, $data);
            
                if (View::$_global_data)
                {
                    $data=array_merge($data,View::$_global_data);
                }

                foreach ($data as $key => $value)
                {

                        if(is_object($value))
                        {
                            if($value instanceof Kohana_ORM)
                            {
                                $value=$value->as_array();
                            }
                            elseif($value instanceof Iterator)
                            {
                                $iter_data=array();
                                foreach($value as $row)
                                {
                                    $iter_data[]=$row->as_array();
                                }
                                //die(print_r($iter_data));
                                $value=$iter_data;  
                            }
                        }

                        $template->assign($key, $value);      
                }

                // Fetch the template output
                $output = $template->fetch(/*$template*/);

		// Return the parsed output
		return $output;
	}
	
	/**
	 * Sets the view filename.
	 *
	 * @throws  View_Exception
	 * @param   string  filename
	 * @return  View
	 */
	public function set_filename($file)
	{
		// Get the correct file extension
		$ext = ((Kohana::config('smarty')->integration) && ($ext = Kohana::config('smarty')->template_ext)) ? $ext : NULL;
				
		// Search for the template file
		foreach (Kohana::config('smarty')->template_dir as $directory) {
			if (($path = Kohana::find_file($directory, $file, $ext)) === FALSE) {
				if (($path = Kohana::find_file($directory, $file)) === FALSE) {
					throw new Kohana_View_Exception('The requested view :file could not be found', array(
						':file' => $file,
					));
				}
			}
		}

		// Store the file path locally
		$this->_file = $path;

		return $this;
	}

	public function render_block($name)
	{
		$var = "render_block_".$name;
		
		$this->$var = 1;
	}
	
	public function remove_block($name)
	{
		$var = "render_block_".$name;
		$this->$var = 0;
	}
} // End View