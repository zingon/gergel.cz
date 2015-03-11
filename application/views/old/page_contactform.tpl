{* sablona pro detail kontaktniho f) *}

<section id="page-contact">
    <header class="row">
        <div class="medium-5 medium-push-7 columns medium-text-right">
            {widget action="breadcrumbs" controller="navigation" }
        </div>
        <div class="medium-7 medium-pull-5 columns">
            <h2>{$item.nadpis}</h2>
        </div>
    </header>
    <article class="row">
        <div class="medium-6 columns">
            <h3>Sídlo společnosti</h3>
            {$item.popis}
        </div>
        <div class="medium-6 columns">
            <h3>Kontaktní formulář</h3>
            {widget action="show" controller="contact"}
        </div>
    </article>
    <div class="row">
        <div class="small-12 column">
            <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
            <div id="google-map"></div>
            <script type="text/javascript">init_gmap("google-map")</script>
        </div>
    </div>
</section>
