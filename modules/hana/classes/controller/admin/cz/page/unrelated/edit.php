<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace nezarazenych stranek - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller_Admin_Page_Unrelated_Edit extends Controller_Admin_Page_Item_Edit
{
    protected $page_category=2;
    protected $max_category_level=1;
}