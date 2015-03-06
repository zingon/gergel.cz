{* sablona emailu s informacemi z odeslaneho kontaktniho formulare *}

<br /><br />
<table cellpadding="5" style="border: none; border-collapse: collapse;">
  <tr>
    <td><strong>Zpráva z kontaktního formuláře www stránek</strong></td>
    <td>{$data.nazev_projektu}</td>
  </tr>
  <tr>
    <td><strong>Název stránky</strong></td>
    <td>{$data.nazev_stranky}</td>
  </tr>
  <tr>
    <td><strong>URL</strong></td>
    <td>{$data.url}</td>
  </tr>
  
  <tr>
    <td><strong>Jméno odesílatele</strong></td>
    <td>{$data.jmeno}</td>
  </tr>
   <tr>
    <td><strong>E-mail odesílatele</strong></td>
    <td>{$data.email}</td>
  </tr>
  
  {if !empty($data.telefon)}
  <tr>
    <td><strong>Telefon</strong></td>
    <td>{$data.telefon}</td>
  </tr>
  {/if}
 

  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Text dotazu:</td>
  </tr>
  <tr>
    <td colspan="2">{$data.zprava}</td>
  </tr>
  <tr>
</table>