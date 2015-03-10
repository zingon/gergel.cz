
{* sablona samostatneho kontaktniho formulare *}
{*<p class="bold">{translate str="Zaujaly vás informace na této stránce? Potřebujete znát více informací? Zašlete nám Váš dotaz."}</p>*}
<form action="?" method="post">
    <div class="row">
        <div class="large-6 medium-12 small-6 columns">
            <input type="text" name="contactform[jmeno]" {if isset($errors.jmeno)}class="error"{/if} {if isset($data.jmeno)}value="{$data.jmeno}"{/if} placeholder="Jméno" required>
            {if isset($errors.jmeno)}<small class="error">Chybné jméno</small>{/if}
        </div>
        <div class="large-6 medium-12 small-6 columns">
            <input type="email" name="contactform[email]" {if isset($errors.email)}class="error"{/if} {if isset($data.email)}value="{$data.email}"{/if} placeholder="Email" required>
            {if isset($errors.email)}<small class="error">Chybný email</small>{/if}
        </div>
    </div>
    <textarea rows="6" name="contactform[zprava]" {if isset($errors.zprava)}class="error"{/if} required> {if isset($data.zprava)}{$data.zprava}{/if}</textarea>
    {if isset($errors.zprava)}<small class="error">Chybí zpráva</small>{/if}

  {hana_secured_post action="send" module="contact"}
  <input type="text" name="kontrolni_cislo" value="" class="hidden-for-small-up" >
  <button type="submit" name="send" class="button right tiny">ODESLAT DOTAZ</button>
</form>
<br /><br />
