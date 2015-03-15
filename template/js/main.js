/**
 * Created by Libor on 26. 2. 2015.
 */


$(document).ready(function main() {
    $(".row, .nav, .col-sm-height>div").append("<div class='cleaner'></div>");

    $(".navToggle").click(function() {
        $(this).toggleClass("active");
        $("#mainNav .nav").toggle("blind", 1000);
    });
});