<div id="LoginForm">
  <div class="top">Přihlášení do administrace</div>
  <form action="{$url_base}admin/login" method="post" class="loginForm">
    <table summary="přihlašovací formulář">
      <tr>
        <td>login:</td>
        <td><input type="text" class="text" name="username" /></td>
      </tr>
      <tr>
        <td>heslo:</td>
        <td><input type="password" class="text" name="password" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" value="přihlásit" class="subm" /></td>
      </tr>
    </table>
  </form>
  <div class="bottom"></div>
</div>

{if $show_login_error}
{literal}
<script type="text/javascript">
$(function() {
$("#dialog").dialog({
    bgiframe: true,
    height: 150,
    width: 320,
    dialogClass: 'alert',
    modal: true,
    buttons: {
        Ok: function() {
            $(this).dialog('close');
        }
    }
});
});
</script>
{/literal}
<div id="dialog" title="Přihlášení se nezdařilo">
<br />
<p>
    Zadali jste chybné jméno, nebo heslo
</p>
</div>;

{/if}