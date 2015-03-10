<h2>{translate str="Napište nám"}</h2>
<form action="?" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
            <input type="text" name="contactform[jmeno]" class="" placeholder="{translate str='Jméno'}" required="">
            <input type="email" name="contactform[email]" class="" placeholder="{translate str='Email'}" required="">
            <input type="tel" name="contactform[telefon]" class="" placeholder="{translate str='Telefon'}">
        </div>
        <div class="col-sm-6 footerTextArea">
            <textarea name="contactform[zprava]" class="" placeholder="{translate str='Text'}" required=""></textarea>
        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-6">
            <input type="text" class="show_name" readonly="">
        </div>
        <div class="col-sm-6 footerButtons">
            <div class="col-xs-6">
                <button type="button" id="choseFile" class="makeMeButtonGrey">{translate str="přidat soubor"}</button>
            </div>
            <div class="col-xs-6">
                <button type="submit" name="send" class="makeMeButtonGrey">{translate str="odeslat"}</button>
            </div>
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