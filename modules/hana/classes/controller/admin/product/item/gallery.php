<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace produktu - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Item_Gallery extends Controller_Hana_Photoedit
{
    public function before() {
        $this->orm=new Model_Product();
        parent::before();
    }



}
?>
