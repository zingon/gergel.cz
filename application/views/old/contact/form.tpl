
{* sablona samostatneho kontaktniho formulare *}
{*<p class="bold">{translate str="Zaujaly vás informace na této stránce? Potřebujete znát více informací? Zašlete nám Váš dotaz."}</p>*}
<form action="?" method="post" id="form-contact">
    <div class="row" data-equalizer>
        <div class="medium-4 columns" data-equalizer-watch>
            <input type="text" name="contactform[jmeno]" class="{if isset($errors.jmeno)}error{/if} radius" {if isset($data.jmeno)}value="{$data.jmeno}"{/if} placeholder="Jméno" required>
            {if isset($errors.jmeno)}<small class="error">Chybné jméno</small>{/if}
            <input type="email" name="contactform[email]" class="{if isset($errors.email)}error{/if} radius" {if isset($data.email)}value="{$data.email}"{/if} placeholder="Email" required>
            {if isset($errors.email)}<small class="error">Chybný email</small>{/if}
            <input type="tel" name="contactform[telefon]" class="{if isset($errors.telefon)}error{/if} radius" {if isset($data.telefon)}value="{$data.telefon}"{/if} placeholder="Telefon">
            {if isset($errors.telefon)}<small class="error">Chybný telefon</small>{/if}
        </div>

        <div class="medium-8 columns with-textarea" data-equalizer-watch>
            <textarea rows="6" name="contactform[zprava]" class="{if isset($errors.zprava)}error{/if} radius" required> {if isset($data.zprava)}{$data.zprava}{/if}</textarea>
            {if isset($errors.zprava)}<small class="error">Chybí zpráva</small>{/if}
        </div>
    </div>
    <div class="row">
        <div class="small-12 column">
            <input type="hidden" name="contactform[prijmeni]" value=" ">
            <input type="text" name="kontrolni_cislo" value="" class="hide-for-small-up" >
            <button type="submit" name="send" class="button right red tiny radius no-border">ODESLAT DOTAZ</button>
            {hana_secured_post action="send" module="contact"}
        </div>
    </div>
</form>