<section>
        <article>
            <div class="wrapper">
            	<h1>{$item.nazev}</h1>
            	{if $item.nazev != $item.nadpis}<h2>{$item.nadpis}</h2>{/if}
            	<div class="pie">
                    <div class="makeMeHalf pullLeft">
                    	{$item.uvodni_popis}
                    </div>
                    <div class="makeMeHalf pullRight">
                    	<img src="{$item.photo_detail}" class="imgResponsive" width="445" height="310" alt=""/>
                    </div>
                </div>
                {$item.popis}
            </div>
    </article>
</section>