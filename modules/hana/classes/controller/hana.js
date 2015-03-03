$(document).ready(function() {

  $(".expandBar .head").toggle(function(event){$("."+($(this).attr("id"))).slideDown(); $(this).removeClass("sbaleno"); $(this).addClass("rozbaleno");},function(event){$("."+($(this).attr("id"))).slideUp(); $(this).removeClass("rozbaleno"); $(this).addClass("sbaleno"); });


  //$(".formExpand .content").hide();

  $(".formExpand .head")
  .toggle(
  function(event){$(this).parent(".formExpand").children(".content").slideDown(); $(this).removeClass("sbaleno"); $(this).addClass("rozbaleno");},
  function(event){$(this).parent(".formExpand").children(".content").slideUp(); $(this).removeClass("rozbaleno"); $(this).addClass("sbaleno"); }
  );

  $(".formExpandSel .head")
  .toggle(
  function(event){$(this).parent(".formExpandSel").children(".content").slideUp(); $(this).removeClass("rozbaleno"); $(this).addClass("sbaleno"); },
  function(event){$(this).parent(".formExpandSel").children(".content").slideDown(); $(this).removeClass("sbaleno"); $(this).addClass("rozbaleno");}
  );

});