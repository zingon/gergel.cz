<div id="page-homepage" class="top-shadow">
    <div class="row-full" id="info">
        <div class="row">
            {if $item.photo_src}
            <div class="medium-7 columns">
                <img src="{$media_path}photos/page/item/images-{$item.id}/{$item.photo_src}-t1.jpg" alt="{$item.nazev}">
            </div>
            {/if}
            <div class="medium-{if $item.photo_src}5{else}12{/if} columns">
                <h3>{$item.nadpis}</h3>
                {$item.popis}
                <img src="{$media_path}img/homepage-arrow.png" alt="{translate str="MÁM ZÁJEM O INFORMACE"}" class="left">
                <a href="{$url_base}kontakt" class="button right red radius">{translate str="MÁM ZÁJEM O INFORMACE"}</a>
            </div>
        </div>
    </div>
    <div class="row-full" id="products">
        {widget controller=catalog action=homepage_widget}
    </div>
    <div class="row-full" id="news">
        {widget controller=article action=homepage_banner_list}
    </div>

    <div class="row" id="why-we">
        <div class="small-12 column">
            <div class="row">
                <div class="small-12 column">
                    <h3>{translate str="Proč právě my"}?</h3>
                </div>
            </div>
            <div class="row">
                <div class="medium-6 columns">
                    <div class="box">
                        <div class="inner">
                            {static_content code="homepage-box"}
                        </div>
                    </div>
                    <a href="{$url_base}materialy-a-sluzby" class="button red radius right">
                        {translate str="CHCI VÍCE INFORMACÍ"}
                    </a>
                </div>
                <div class="medium-6 columns">
                    <img src="{$media_path}img/homepage-bulb.jpg" alt="" class="hide-for-small-down">
                </div>
            </div>
        </div>
    </div>
    <div class="row-full" id="google-map">
        <div id="map"></div>
        <div class="box hide-for-small-down" id="info-box">
            {static_content code="homepage-contact"}
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">
    google_map();
</script>