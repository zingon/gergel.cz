
<form action="?" method="post" enctype="multipart/form-data">
	<div class="makeMeHalf">
		<input type="text" name="contactform[jmeno]" class="{if isset($errors.jmeno)}error{/if}" {if isset($data.jmeno)}value="{$data.jmeno}"{/if} placeholder="Jméno" required>
		<input type="email" name="contactform[email]" class="{if isset($errors.email)}error{/if}" {if isset($data.email)}value="{$data.email}"{/if} placeholder="Email" required>
		<input type="tel" name="contactform[telefon]" class="{if isset($errors.telefon)}error{/if}" {if isset($data.telefon)}value="{$data.telefon}"{/if} placeholder="Telefon">
	</div>
	<div class="makeMeHalf">
		<textarea rows="6" name="contactform[zprava]" class="{if isset($errors.zprava)}error{/if}" required></textarea>
		
	</div>
	<div class="makeMeHalf">
		<input type="text" class="show_name" readonly>
	</div>
	<div class="makeMeHalf">
		<div class="makeMeHalf">
			<button type="button" id="choseFile">{translate str="přidat soubor"}</button>
		</div>
		<div class="makeMeHalf">
			<button type="submit" name="send" class="button right red tiny radius no-border">{translate str="ODESLAT"}</button>
		</div>
	</div>

	<input type="file" name="file" class="makeMeHidden">
	{hana_secured_post action="send" module="contact"}
</form>
{literal}
<script type="text/javascript">
$('#choseFile').click(function () {
	$('input[type="file"]').click();
});

$('input[type="file"]').change(function(){
	if (this.files && this.files[0]) {
   		$(".show_name").val(this.files[0].name);
	}
});
</script>
{/literal}