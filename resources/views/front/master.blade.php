<!DOCTYPE html>

<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0,  target-densitydpi=device-dpi">
    <title>Shelly Touring Company</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <!-- *************** Font Google *************** -->
    <link
        href="https://fonts.googleapis.com/css?family=Biryani:300,700|Catamaran:100,300,400,600,700,800,900&display=swap"
        rel="stylesheet">
    <!-- *************** Font Awesome *************** -->
    <link href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- *************** Bootstrap *************** -->
    <link rel="stylesheet" href="/js/vendor/bootstrap/bootstrap.min.css"/>
    {{-- datepicker --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <!-- *************** Navigation *************** -->
    <link rel="stylesheet" href="/js/vendor/navigation/webslidemenu.css"/>
    <!-- *************** Master Slider *************** -->
    <link href="/js/vendor/masterslider/masterslider.css" rel="stylesheet" type="text/css"/>
    <link href="/js/vendor/masterslider/ms-layers-style.css" rel="stylesheet" type="text/css"/>
    <!-- *************** Slick Slider *************** -->
    <link rel="stylesheet" href="/js/vendor/slick_slider/slick.css"/>
    <link rel="stylesheet" href="/js/vendor/slick_slider/slick-theme.css"/>
    <!-- *************** Start Common CSS *************** -->
    <link rel="stylesheet" href="/css/common/inner-all.css" type="text/css"/>
    <link rel="stylesheet" href="/css/common/main.css" type="text/css"/>
    <link rel="stylesheet" href="/css/pages/home.css" type="text/css"/>
    @yield('fcss')
</head>
<body>
<!--==== Start Header ====-->
<header class="wsmenucontainer clearfix">
    <div class="overlapblackbg"></div>
    <div class="wsmobileheader clearfix">
        <a id="wsnavtoggle" class="animated-arrow"><span></span></a>
        <a class="smallogo">
            <img src="/img/logo.png" width="87" alt=""/>
        </a>
        <a class="cta-icon call" href="tel:123456789"><span class="fa fa-mobile-phone"></span></a>
        <a class="cta-icon book" type="button" href="/enquiry"><span
                class="fa fa-calendar-o"></span></a>
    </div>

    <div class="header">

        <!--Main Menu HTML Code-->

        <div class="wsmain ">

            <div class="container-fluid">

                <!--==== Start Container ====-->

                <div class="smllogo">

                    <a href="#">

                        <img src="/img/logo.png" alt=""/>

                    </a>

                </div>

                <nav class="wsmenu clearfix">

                    <div class="mid-nav">

                        <ul class="mobile-sub wsmenu-list">

                            <li>

                                <a href="/" class="menuhomeicon @if( $activevar == '' ) active @endif">Home</a>

                            </li>

                            <li><a class=" @if( $activevar == 'about' ) active @endif" href="/about">About Us</a></li>

                            <li>

                                <a class="@if( $activevar == 'airport' ||  $activevar == 'cruise' ||
 $activevar == 'wedding' || $activevar == 'hensparty' || $activevar == 'nighthire' || $activevar == 'privatehire'
 ) active @endif">Services
                                    <span class="arrow"></span></a>

                                <ul class="wsmenu-submenu">

                                    <li><a href="/airport"><i class="fa fa-angle-right"></i>Door-to-door airport hire
                                        </a></li>

                                    <li><a href="/cruise"><i class="fa fa-angle-right"></i>Door-to-door cruise hire</a>
                                    </li>

                                    <li><a href="/wedding"><i class="fa fa-angle-right"></i>Wedding hire</a></li>

                                    <li><a href="/hensparty"><i class="fa fa-angle-right"></i>Hens party hire</a></li>

                                    <li><a href="/nighthire"><i class="fa fa-angle-right"></i>Sydney night party
                                            hire</a></li>

                                    <li><a href="/privatehire"><i class="fa fa-angle-right"></i>Private or corporate
                                            function hire</a></li>

                                </ul>

                            </li>

                            <!-- <li><a href="service"></a></li> -->
                            <li><a href="/tours" class="@if( $activevar == 'tours' ) active @endif">Tours</a></li>

                            <li><a href="/faq" class="@if( $activevar == 'faq' ) active @endif">FAQ</a></li>

                            <li><a href="/contact" class="@if( $activevar == 'contact' ) active @endif">Contact</a></li>


                        </ul>

                    </div>

                    <div class="hidden-xs hidden-sm rightnav">

                        <ul class="mobile-sub wsmenu-list">

                            <li class="rightmenu">

                                <a href="/enquiry" class="btn-nav" type="button"> <i

                                        class="fa fa-calendar-o"></i>

                                    <span>Book Now</span></a>

                            </li>

                            <li class="rightmenu">

                                <a href="tel:1800865845" class="call-link"> <i class="fa fa-mobile-phone"></i> <span>1800 865

                      845</span></a>

                            </li>

                        </ul>

                    </div>

                </nav>

            </div>

            <!--==== End Container ====-->

        </div>


    </div>


</header>

<!--==== End Header ====-->

<main class="inner-main">


@yield('bodycontent')



<!--==== Start Footer ====-->

    <footer>

        <div class="container">

            <div class="row flex-row">

                <div class="col-md-4 col-xs-12">

                    <p class="contact-link"><a href="#"> <i class="fa fa-mobile-phone"></i>
                            <span>1800 865 845</span></a></p>

                </div>

                <div class="col-md-4 col-xs-12 text-center">

                    <p>Copyright © 2019 Shelly Touring Company</p>

                </div>

                <div class="col-md-4 col-xs-12">

                    <div class="social-icons">

                        <a href="#">

                            <i class="fa fa-facebook"></i>

                        </a>

                        <a href="#">

                            <i class="fa fa-twitter"></i>

                        </a>

                        <a href="#">

                            <i class="fa fa-youtube-play"></i>

                        </a>


                        <a href="#">

                            <i class="fa fa-instagram"></i>

                        </a>

                        <a href="#">

                            <i class="fa fa-linkedin"></i>

                        </a>

                    </div>

                </div>

            </div>

    </footer>

    <!--==== End Footer ====-->

</main>


<!--==== Script start ====-->

{{-- <script src="js/vendor/jquery-1.11.3.min.js" type="text/javascript"></script> --}}
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/vendor/bootstrap/bootstrap.min.js" type="text/javascript"></script>

<script src="/js/vendor/navigation/webslidemenu.js" type="text/javascript"></script>

<!-- *************** Master Slider *************** -->

<script src="/js/vendor/masterslider/masterslider.min.js" type="text/javascript"></script>

<!-- *************** Slick Slider *************** -->

<script src="/js/vendor/slick_slider/slick.min.js" type="text/javascript"></script>

<script src="/js/common/main.js" type="text/javascript"></script>

<script src="/js/pages/home.js" type="text/javascript"></script>

@yield('fscripts')


</body>


</html>
