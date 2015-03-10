<!DOCTYPE html>
<html lang="cs">
    <head>
    </head>
    <body>
    <h2>Základní informace:</h2>
        <table border="0">
            <tr>
                <td style="padding-right: 15px"><strong>Jméno:</strong> </td>
                <td> {$data.firstname} {$data.lastname}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong> </td>
                <td> {if isset($data.email)}{$data.email}{/if}</td>
            </tr>
            <tr>
                <td><strong>Telefon:</strong> </td>
                <td> {if isset($data.phone)}{$data.phone}{/if}</td>
            </tr>
            <tr>
                <td><strong>Přeje si kontaktovat: </strong> </td>
                <td> {if isset($data.contact.phone)}telefonicky{/if} {if isset($data.contact.email) && isset($data.contact.phone)}a{/if} {if isset($data.contact.email)}emailem{/if}</td>
            </tr>
            {if isset($data.from_name) && $data.from_name|strlen > 0}
                <tr>
                    <td><strong>K formuláři přišel z kategorie: </strong> </td>
                    <td> {$data.from_name}</td>
                </tr>
            {/if}
        </table>
    {if isset($data.category)}
        <h2>Má zájem o:</h2>
        <ul>
            {foreach from=$data.category item=item}
                <li>{$item}</li>
            {/foreach}
        </ul>
    {/if}
    {if isset($data.text) && $data.text|mb_strlen > 0}
        <h2>Dotaz / připomínka:</h2>
        <p>
            {$data.text}
        </p>
    {/if}
    </body>
</html>