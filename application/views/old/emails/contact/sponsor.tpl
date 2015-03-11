{* sablona emailu s informacemi z odeslaneho kontaktniho formulare *}

<br /><br />
<table cellpadding="5" style="border: none; border-collapse: collapse;">
  <tr>
    <td><strong>Zpráva z formuláře "Chci být sponzorem"</strong></td>
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
    <td colspan="2">-------------------------------</td>
  </tr>
  
  <tr>
    <td><strong>Jméno</strong></td>
    <td>{$data.jmeno}</td>
  </tr>
  <tr>
    <td><strong>Firma</strong></td>
    <td>{$data.firma}</td>
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
    <td><strong>Ulice</strong></td>
    <td>{$data.ulice}</td>
  </tr>
  <tr>
    <td><strong>Město</strong></td>
    <td>{$data.mesto}</td>
  </tr>
  <tr>
    <td><strong>Zvíře</strong></td>
    <td>{$data.zvire}</td>
  </tr>
  <tr>
    <td><strong>Částka</strong></td>
    <td>{$data.castka}</td>
  </tr>
  
  <tr>
    <td><strong>Způsob platby</strong></td>
    <td>{$data.platba}</td>
  </tr>
  
  <tr>
    <td><strong>Jméno na tabuli</strong></td>
    <td>{$data.jmeno_tabule}</td>
  </tr>

  
   
  
  
 

  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Text dotazu:</td>
  </tr>
  <tr>
    <td colspan="2">{$data.text}</td>
  </tr>
  <tr>
</table>