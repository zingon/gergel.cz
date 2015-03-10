{* sablona navigace *}
{if count($links) > 0}
<nav id="main">
    <div class="center">
        <div id="square" class="{if $url_actual != "/index" && $url_actual != "/homepage" && $url_actual != "/index_en"}small{else}big{/if}">
            <div class="inner">
                <div class="most-inner">
                    <a href="{$url_homepage}">
                        <img src="{$media_path}img/logo{if $url_actual != "/index" && $url_actual != "/homepage" && $url_actual != "/index_en"}_smaller{/if}.png" alt="Website logo">
                    </a>
                    <nav>
                        {foreach from=$links item=link key=key}
                            {if $key == "index" || $key == "homepage" || $key == "index_en"}{continue}{/if}
                            <a href="{$url_base}{$key}" class="{if in_array($key, $sel_links)}active{/if}">{$link.nazev|upper}</a>
                        {/foreach}
                        <a href="" class="no-block"><small>twitter</small></a> /
                        <a href="" class="no-block"><small>facebook</small></a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</nav>
{/if}

