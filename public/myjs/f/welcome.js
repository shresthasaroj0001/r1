$(function () {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('#tokken').val()
        },
        url: '/tours',
        type: 'POST',
        beforeSend: function () {
            $("#tourss").LoadingOverlay("show", {
                background: "rgba(165, 190, 100, 0.5)"
            });
            $("#tourss").LoadingOverlay("show");
        },
        success: function (datas) {
            i = "";
            if (datas != null) {
                datas.forEach(function (item, index, array) {
                    i += '<div class="col-md-4 mb-30"><div class="product-wrap">';
                    if ($.trim(item.featureimg).length > 0) {
                        i += '<img src="/uploads/' + item.featureimg + '" alt="' + item.title + '"> ';
                    } else {
                        i += '<img src = "img/destination.jpg" alt = "no image" >';
                    }
                    i += '<div class="featured-product-content"><div class="featured-product-content-inner"><h5>';
                    i += '<a href="/tours/' + item.slug + '" tabindex="0">' + item.title + '</a></h5></div>';
                    i += '<a class="featured-product-link" href="/tours/' + item.slug + '" tabindex="0">more info</a></div></div></div>';
                });
            }
            $('#tourss').html(i);
            $("#tourss").LoadingOverlay("hide");

        },
        error: function (eror) {

        },
        complete: function () {
            $("#tourss").LoadingOverlay("hide");
        },
    }); //ajax ending
});