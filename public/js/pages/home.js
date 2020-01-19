$(document).ready(function () {
    var heroSlide = new MasterSlider();
    heroSlide.setup('heroSlide', {
        width: 1903, // slider standard width
        height: 657, // slider standard height
        layout: 'fullwidth',
        loop: false,
        preload: 0,
        fillMode: 'fill',
        parallaxMode: 'mouse',
        view: 'fadeBasic'
        // autoplay: true
    });
    heroSlide.control('bullets', {
        autohide: false
    });
    //Product Slide
    $('.featured-product-slide').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        variableWidth: false,
        arrows: false,
        infinite: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1023,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.destination-big').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.destination-thumb'
    });
    $('.destination-thumb').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.destination-big',
        dots: true,
        centerMode: true,
        focusOnSelect: true
    });
    // <li><a href="/airport"><i class="fa fa-angle-right"></i>Door-to-door airport hire
    // </a></li>
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('#tokken').val()
        },
        url: '/tours',
        type: 'POST',
        success: function (tours) {
            div = "";
            if (tours != null) {
                tours.forEach(function (item, index, array) {
                    div += `<li><a href="/tours/` + item.slug +`"><i class="fa fa-angle-right"></i>` + item.title + `</a></li>`;
                });
            }
            $('#tours-menu').html(div);

        },
        error: function (err) {
            console.log(err);
        },
        complete: function () {
            $("#tours-menu").LoadingOverlay("hide");
        },
    }); //ajax ending
});
