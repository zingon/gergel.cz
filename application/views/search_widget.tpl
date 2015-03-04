<form action="{$url_base}{translate str="vyhledavani"}" method="post">
    <div class="row">
        <div class="large-12 columns">
            <div class="row collapse">
                <div class="small-9 columns">
                    <input type="text" name="search_text">
                </div>
                <div class="medium-2 small-3 medium-offset-1 columns">
                    <button type="submit" class="button postfix yellow"><i class="fi-magnifying-glass"></i></button>
                    {hana_secured_post action="index" module="search"}
                </div>
            </div>
        </div>
    </div>
</form>


{* implementace našeptávače *}
{*literal}
<script type="text/javascript">
 /* <![CDATA[ */

$(function() {
  $("#SearchInput").autocomplete({
    source: function(request, response) {
      jQuery.ajax({
        url: "{/literal}?{hana_secured_get action="show_suggestions" module="search"}{literal}",
        type: "get",
        dataType: "json",
        data: {
          term: request.term
        },
        success: function(data) {
          response(jQuery.map(data.main_content, function(item) {
            return {
                url: item.url,
                value: item.name
            }
          }))
        }
      })
    },
    select: function( event, ui ) {
      window.location.href = ui.item.url;
    },
    minLength: 2
  });

});

 /* ]]> */
</script>
{/literal*}