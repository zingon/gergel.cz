<div id="main-nav">
    <div class="row">
        <div class="small-12 column">
            <nav class="top-bar" data-topbar role="navigation" id="main">
                <ul class="title-area">
                    <li class="name hidden-for-medium-up">
                    </li>
                    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                </ul>

                <section class="top-bar-section display-table" id="full">
                    <ul class="display-row">
                        {foreach from=$links item=link key=key}
                            <li class="{if array_key_exists($key, $sel_links)}active{/if} {if !empty($link.children)}has-dropdown {if $link.module_id == 6}catalog{/if}{/if} display-cell">
                                <a href="{$url_base}{$key}">{$link.nazev}</a>
                                {if !empty($link.children)}
                                    <ul class="dropdown {if $link.module_id == 6}medium-block-grid-4 catalog{/if}">
                                        {foreach from=$link.children item=child key=key_c}
                                            <li class="{if array_key_exists($key_c, $sel_links)}active{/if}">
                                                <a href="{$url_base}{$key_c}">{$child.nazev}</a>
                                            </li>
                                        {/foreach}
                                    </ul>
                                {/if}
                            </li>
                        {/foreach}
                    </ul>
                </section>
            </nav>
        </div>
    </div>
</div>
