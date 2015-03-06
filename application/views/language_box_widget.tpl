 <div class="makeMeThird pullRight">
	{foreach from=$all_langs item=lang key=key name=language_box}
		<a href="{$url_base}{if not empty($languages[$lang])}{if $languages[$lang]!='index'}{$languages[$lang]}{/if}{else}{$index_languages[$lang]}{/if}"><img src="{$media_path}img/layout/{$lang}.png"></a>
	{/foreach}
</div>