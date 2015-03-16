/**
 * Created by Libor on 26. 2. 2015.
 */


$(document).ready(function main() {
    $(".row, .nav, .col-sm-height>div").append("<div class='cleaner'></div>");

    $(".navToggle").click(function() {
        $(this).toggleClass("active");
        $("#mainNav .nav").toggle("blind", 1000);
    });

    $('.bxslider').bxSlider({
        minSlides: 3,
        maxSlides: 5,
        slideWidth: 170,
        slideMargin: 5,
        pager: false
    });
    $('.bxslider small').bxSlider({
        minSlides: 3,
        maxSlides: 3,
        slideWidth: 110,
        slideMargin: 0,
        pager: false
    });
});