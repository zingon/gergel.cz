/* 
/*
 * Obsluzny JavaScript pro admin.
 */


$(document).ready(function() {
                 
     $('[data-toggle="tooltip"]').tooltip({placement: 'auto'}); 
     $('[data-toggle="popover"]').popover({html: true});
    setup_hana_js_functionality();
});


function setup_hana_js_functionality()
{
    // inicializace datepickeru
    //$.datepicker.setDefaults($.extend({showMonthAfterYear: false}, $.datepicker.regional['cs']));
    $(".datepicker").datepicker({
        format      :   "dd.mm.yyyy",
        todayBtn    :   "linked",
        language    :   "cs",
        todayHighlight: true,
        keyboardNavigation: true

    });
    
    // filtrovaci daterangepicker
    // $('.daterangepicker').daterangepicker();

    
    // funkcionalita - "zaskrtnout vse"
    $(".sellAll").click(function()
    {
        var checked_status = this.checked;
        $("#PhotoPreviewBox .item .footer input[type=checkbox]:not(.filteringRow input), #table-section table input[type=checkbox]:not(.filteringRow input), #EditTableSection table input[type=checkbox]:not(.filteringRow input)").each(function()
            {
            this.checked = checked_status;
            });
    });

    // graficka uprava obecneho tlacitka
    $(".button").button();
    
    // zobrazovani/skryvani filtracniho radku
    $(".filteringSwitch").toggle(function ()
          {
            $(".filteringRow").removeClass("filteringRowHide");  
            $(".filteringA").text("zrušit filtrování"); 
            $(".filteringB img").attr("src","../../../../media/admin/img/sbalit.gif"); 
            $(this).attr("href","");
          }, function()
          {
            $(".filteringRow").addClass("filteringRowHide"); 
            $(".filteringA").text("filtrovat seznam"); 
            $(".filteringB img").attr("src","../../../../media/admin/img/rozbalit.gif"); 
          });

    // ajaxove pozadavky v seznamech
    var xurl;

    $(".ajaxelement").click(function(e){
                   e.preventDefault();
                   xurl = $(this).attr("href");
                   if($(this).hasClass("confirmDelete"))
                   {
                     var result=window.confirm("Opravdu smazat položku?");
                     if(result==false) return false;
                   } 
                   
                   $('#ContentSection').showLoading(); 
                
                   $.ajax({
                     type: "GET",
                     url: ""+xurl+"",
                     success: function(msg){
                     //alert( "Obdržená data: " + msg );
                     $('#ContentSection').hideLoading(); 
                     $('#ContentSection').html(msg);
                     //$(this).attr("href",xurl);
                     },
                     error: function(XMLHttpRequest, textStatus, errorThrown){
                        $('#ContentSection tbody').hideLoading(); 
                        alert("Při zpracování dat došlo k chybě");
                        //alert("Při zpracování dat došlo k chybě: " + XMLHttpRequest + ", textStatus: " + textStatus+ ", errorThrown: " + errorThrown);
                     }
                  });
               
   }); 




}



