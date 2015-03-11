<div id="page-contact" class="top-shadow detail">
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
    <div class="row">
        <div class="small-6 column">
            <p>GPS {translate str="souřadnice"}: N 49° 13.620', E 17° 40.696'</p>
            <div id="map" class="radius">
            </div>
        </div>
        <div class="small-6 column">
            <h3>{translate str="Kontaktní formulář"}</h3>
            <form action="?" method="post">
                <div class="row">
                    <div class="large-6 medium-12 small-6 columns">
                        <input type="text" name="contactform[jmeno]" class="{if isset($errors.jmeno)}error{/if} radius" {if isset($data.jmeno)}value="{$data.jmeno}"{/if} placeholder="Jméno" required>
                        {if isset($errors.jmeno)}<small class="error">Chybné jméno</small>{/if}
                    </div>
                    <div class="large-6 medium-12 small-6 columns">
                        <input type="text" name="contactform[prijmeni]" class="{if isset($errors.prijmeni)}error{/if} radius" {if isset($data.prijmeni)}value="{$data.prijmeni}"{/if} placeholder="Příjmení" required>
                        {if isset($errors.prijmeni)}<small class="error">Chybné příjmení</small>{/if}
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 medium-12 small-6 columns">
                        <input type="email" name="contactform[email]" class="{if isset($errors.email)}error{/if} radius" {if isset($data.email)}value="{$data.email}"{/if} placeholder="Email" required>
                        {if isset($errors.email)}<small class="error">Chybný email</small>{/if}
                    </div>
                    <div class="large-6 medium-12 small-6 columns">
                        <input type="tel" name="contactform[telefon]" class="{if isset($errors.telefon)}error{/if} radius" {if isset($data.telefon)}value="{$data.telefon}"{/if} placeholder="Telefon">
                        {if isset($errors.telefon)}<small class="error">Chybný telefon</small>{/if}
                    </div>
                </div>
                <textarea rows="6" name="contactform[zprava]" class="{if isset($errors.zprava)}error{/if} radius" required> {if isset($data.zprava)}{$data.zprava}{/if}</textarea>
                {if isset($errors.zprava)}<small class="error">Chybí zpráva</small>{/if}

                {hana_secured_post action="send" module="contact"}
                <input type="text" name="kontrolni_cislo" value="" class="hidden-for-small-up" >
                <button type="submit" name="send" class="button right red tiny radius no-border">ODESLAT DOTAZ</button>
            </form>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">
    $(function(){
        init_map();
    });
</script>