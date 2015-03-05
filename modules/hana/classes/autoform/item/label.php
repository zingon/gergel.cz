<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Představuje nadpis.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class AutoForm_Item_Label extends AutoForm_Item {

    public function pregenerate($data_orm) {
        return;
    }

    public function generate($data, $template=false) {
        $content=parent::generate($data, $template);
        return("<h4>".$content."</h4>");
    }

}
?>
