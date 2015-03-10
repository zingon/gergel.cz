<section>
        <article>
            <div class="wrapper">
            	<h1>{$item.nazev}</h1>
            	{if $item.nazev != $item.nadpis}<h2>{$item.nadpis}</h2>{/if}
            	<div class="row">
                    <div class="{if not empty($item.photo)}col-sm-6 pullLeft{else}col-sm-12{/if}">
                    	{$item.uvodni_popis}
                    </div>
                    {if not empty($item.photo)}
                        <div class="col-sm-6 pullRight">
                            <img src="{$item.photo}" class="img-responsive" width="445" height="310" alt="{$item.nazev}"/>
                        </div>
                    {/if}
                    
                </div>
                {$item.popis}
            </div>
    </article>
</section>