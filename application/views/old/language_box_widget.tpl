<div id="LanguageSection">
  <form action="" method="post">
    <div class="languageBox">
      
      <select name="redirect" id="LanguageSelect">
      {foreach name=lng from=$languages key=key item=item}
        <option value="{$item}" {if $key==$language_code}selected="selected"{/if}>{$key}</option>  
      {/foreach}
      </select>

    </div>
    {hana_secured_post action="redirect" module="site"}
  {literal}
  <script type="text/javascript">
    $("#LanguageSelect").selectBox();
    
    $("#LanguageSelect").change(function() {
         this.form.submit();
    });
    
  </script>
  {/literal}
  </form>
</div>