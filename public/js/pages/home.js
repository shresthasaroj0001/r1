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
        slidesToShow: 5,
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
});