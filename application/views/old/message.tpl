{* sablona s jednoduchou zpravou *}
{if !empty($messages)}
    <div id="message" class="reveal-modal small" data-reveal>
        {foreach name=msg from=$messages key=key item=item}
            {$item}<br />
        {/foreach}
        <a class="close-reveal-modal">&#215;</a>
    </div>



{literal}
<script>
$(document).ready(function(){
    $('#message').foundation('reveal', 'open');
});
</script>
{/literal}

{/if}
