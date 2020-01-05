$(document).ready(function() {
    $("#map").gmap3({
        marker: {
            values: [{
                latLng: [27.714888399403264, 85.311290323516]
            }]
        },
        map: {
            options: {
                center: [27.714888399403264, 85.311290323516],
                zoom: 16,
                scrollwheel: !1,
                streetViewControl: !0
            }
        }
    });
});