<section>
        <article {if not empty($item.nav_class)}id="{$item.nav_class}"{/if}>
            <div class="wrapper">
            	<h1>{$item.nazev}</h1>
            	{if $item.nazev != $item.nadpis}<h2>{$item.nadpis}</h2>{/if}
                {if not empty($item.uvodni_popis) or not empty($item.photo)}
                    <div class="row">
                        {if not empty($item.uvodni_popis)}
                            <div class="{if not empty($item.photo)}col-sm-6 pullLeft{else}col-sm-12{/if}">
                                {$item.uvodni_popis}
                            </div>
                        {/if}
                        
                        {if not empty($item.photo)}
                            <div class="col-sm-6 pullRight">
                                <img src="{$item.photo}" class="img-responsive" width="445" height="310" alt="{$item.nazev}"/>
                            </div>
                        {/if}
                    </div>
                {/if}
            	
                {$item.popis}
                {if not empty($item.photos)}
                    <h3>{translate str="Fotogalerie"}</h3>
                    <ul class="bxslider">
                        {foreach from=$item.photos item=photo key=key name=photos}
                            <li>
                            {if not empty($photo.big) and not empty($photo.small)}
                                <a href="{$photo.big}" data-lightbox="photos">
                                    <img src="{$photo.small}" title="{$photo.popis}" alt="{$photo.nazev}"/>
                                </a>
                            {/if}
                            </li>                            
                        {/foreach}                        
                    </ul>
                {/if}
            </div>
    </article>
</section>