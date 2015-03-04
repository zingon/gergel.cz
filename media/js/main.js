
$(function() {
    $(document).foundation();

    responsive_carousel();
    set_homepage_products();
});

function set_homepage_products()
{
    $("#product-list li .photo a").mouseenter(function(e)
    {
        var img = $(this).find("img");
        if (img.attr("data-white") == img.attr("src")) {
            img.attr("src", img.attr("data-red"));
        } else {
            img.attr("src", img.attr("data-white"));
        }
    });

    $("#product-list li .photo a").mouseleave(function(e)
    {
        var img = $(this).find("img");
        if (img.attr("data-white") == img.attr("src")) {
            img.attr("src", img.attr("data-red"));
        } else {
            img.attr("src", img.attr("data-white"));
        }
    });
}

function responsive_carousel() {
    var jcarousel = $('.jcarousel');

    jcarousel
        .on('jcarousel:reload jcarousel:create', function () {
            var width = jcarousel.innerWidth();

            if (width >= 1000) {
                width = width / 4;
            } else if (width >= 800) {
                width = width / 3;
            } else if (width >= 500) {
                width = width / 2;
            }

            jcarousel.jcarousel('items').css('width', width + 'px');
        })
        .jcarousel({
            wrap: 'circular'
        });

    $('.jcarousel-control-prev')
        .jcarouselControl({
            target: '-=1'
        });

    $('.jcarousel-control-next')
        .jcarouselControl({
            target: '+=1'
        });

    $('.jcarousel-pagination')
        .on('jcarouselpagination:active', 'a', function() {
            $(this).addClass('active');
        })
        .on('jcarouselpagination:inactive', 'a', function() {
            $(this).removeClass('active');
        })
        .on('click', function(e) {
            e.preventDefault();
        })
        .jcarouselPagination({
            perPage: 1,
            item: function(page) {
                return '<a href="#' + page + '">' + page + '</a>';
            }
        });
}

function google_map(t) {
    var myLatlng = new google.maps.LatLng(49.2270741,17.6781759);
    var mapOptions = {
        zoom: 17,
        center: myLatlng,
        scrollwheel: false
    }

    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    var infowindow = new google.maps.InfoWindow({
        maxWidth: 350,
        content: '<div id="content"><div id="siteNotice"></div><div id="bodyContent">'+$("#info-box").html() + '</div></div>'
    });

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });
}

function init_map() {
    var myLatlng = new google.maps.LatLng(49.2270741,17.6781759);
    var mapOptions = {
        zoom: 15,
        center: myLatlng
    }

    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map
    });
}