<div id="nav-sub">
    <ul class="side-nav hidden-for-small-down">
        <li class="header">
            <a href="{$prev.nazev_seo}">
                {$prev.nazev}
            </a>
        </li>
        {foreach $links as $link name=link}
            {if $smarty.foreach.link.iteration > 1}
                <li class="hr"><hr></li>
            {/if}
            <li class="{if array_key_exists($link.nazev_seo, $sel_links)}active{/if}">
                <a href="{$link.nazev_seo}">
                    {$link.nazev}
                </a>
            </li>
        {/foreach}
    </ul>
    <nav class="top-bar show-for-small-down" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1><a href="#">{$prev.nazev}</a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>

        <section class="top-bar-section">
            <ul class="left">
                {foreach $links as $link}
                    <li class="{if array_key_exists($link.nazev_seo, $sel_links)}active{/if}">
                        <a href="{$link.nazev_seo}">
                            {$link.nazev}
                        </a>
                    </li>
                {/foreach}
            </ul>
        </section>
    </nav>

</div>