{* sablona pro vygenerovani jazykove tabulky *}
<?php defined('SYSPATH') or die('No direct script access.');

return array(
{foreach name=lng from=$items key=key item=item}
   '{$key}'    => '{$item}'{if !$smarty.foreach.lng.last},{/if}   
{/foreach}
);