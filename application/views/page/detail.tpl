<div id="page-detail" class="top-shadow">
    <header class="row-full">
        <div class="row">
            <div class="small-6 column">
                <h1>{$item.nadpis}</h1>
            </div>
            <div class="small-6 column text-right">
                {widget action="breadcrumbs" controller="navigation" }
            </div>
        </div>
    </header>
    <div class="row">
        <div class="small-12 column">
            {$item.popis}
        </div>
    </div>
</div>