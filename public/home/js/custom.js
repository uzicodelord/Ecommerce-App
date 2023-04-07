
/** google_map js **/
function myMap() {
    var mapProp = {
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}

function initSlider() {
    $('.slider').slick({
        dots: false,
        arrows: false,
        prevArrow: '<button type="button" class="slick-prev">&#8249;</button>',
        nextArrow: '<button type="button" class="slick-next">&#8250;</button>',
        infinite: true,
        speed: 600,
        slidesToShow: 1,
        adaptiveHeight: true,
        variableWidth: true,
        centerMode: true,
        variableWidth: true,
        draggable: true,
        autoplay: true,
        autoplaySpeed: 3000
    });
}
