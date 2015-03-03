<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace jednoducheho produktoveho katalogu - galerie.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2013 Pavel Herink
 */

class Controller_Admin_Catalog_Item_Gallery extends Controller_Hana_Photoedit
{
    public function before() {
        $this->orm=new Model_Catalog();
        parent::before();
    }
}
?>
