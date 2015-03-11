<div class="title tEmail">Chci dostávat novinky e-mailem</div>
<form action="" method="post">
   <fieldset>
     <input type="text" name="newsletter_email" class="text removeEditText" value="napište svůj e-mail" title="napište svůj e-mail" />
     <input type="submit" value="odeslat" class="submit" />
     <input type="text" name="kontrolni_cislo" value="" class="hidden" />
      
     {hana_secured_post action="subscribe_to_newsletter" module="newsletter"}
   </fieldset>
</form>

<script type="text/javascript">
$(document).ready(function(){
    $('.removeEditText').live("focus",function () {
    	if ($(this).val() == $(this).attr("title")) {
    		$(this).val("");
    	}
    });
    
    $('.removeEditText').live("blur",function () {
    	if ($(this).val() == "") {
    		$(this).val($(this).attr("title"));
    	}
    });

});
</script>

