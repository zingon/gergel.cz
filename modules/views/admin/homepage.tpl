{* sablona uvodni stranky administrace *}

<div id="HomepageSection">
{* oblast, kde se zobrazi zprava o ulozeni/neulozeni dat - typy: error, default, ok *}
  {if $message}
  <div class="ui-widget correct">
		<div class="ui-state-{$message} ui-corner-all"> 
			<p>
      {if $message=="error"} 
      <span class="ui-icon ui-icon-alert"></span>
			<strong>Chyba:</strong> Při zpracování dat došlo k chybě, zkontrolujte prosím zadané údaje.
      {elseif $message=="ok"}
      <span class="ui-icon ui-icon-check"></span>
      Položka byla úspěšně uložena.
      {elseif $message=="highlight"}
      <span class="ui-icon ui-icon-info"></span>
      Změna byla provedena.
      {/if}
      </p>
		</div>
	</div>
	{/if}
	
Vítejte v administračním rozhranní.	
</div>