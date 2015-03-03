<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Page_Category_List extends Controller_Hana_List{

        public $template = 'test';

	public function action_index()
	{
            $this->template->nazev = 'Controller_Admin_Page_Category_List !';
            $str=Request::instance()->param("id");
            $str2=Request::instance()->param("id2");
            $this->template->text=$str."-".$str2;
        }



}
