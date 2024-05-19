<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pointtrash - Aplikasi Pemilah Sampah</title>

    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Google Fonts -->

    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/animate.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/aos.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/custom-animate.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/fancybox.min.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/icomoon.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/imp.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/nice-select.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/owl.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/scrollbar.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/swiper.min.css">

    <!-- Module css -->
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/header-section.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/banner-section.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/about-section.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/blog-section.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/fact-counter-section.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/faq-section.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/contact-page.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/breadcrumb-section.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/team-section.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/partner-section.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/testimonial-section.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/services-section.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/module-css/footer-section.css">

    <link href="{{ 'westo/assets' }}/css/color/theme-color.css" id="jssDefault" rel="stylesheet">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/style.css">
    <link rel="stylesheet" href="{{ 'westo/assets' }}/css/responsive.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ 'westo/assets' }}/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="{{ 'westo/assets' }}/images/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ 'westo/assets' }}/images/favicon/favicon-16x16.png" sizes="16x16">

    <!-- Fixing Internet Explorer-->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="{{ 'westo/assets' }}/js/html5shiv.js"></script>
    <![endif]-->

</head>


<body>

    <div class="boxed_wrapper ltr">

        <!-- Preloader -->
        <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close">Preloader Close</div>
            </div>
            <div class="layer layer-one"><span class="overlay"></span></div>
            <div class="layer layer-two"><span class="overlay"></span></div>
            <div class="layer layer-three"><span class="overlay"></span></div>
        </div>


        <!-- Main header-->
        <header class="main-header header-style-one">
            <!--Start Header Top-->
            @include('frontend.topHeader')
        </header>

        @yield('content')

        <div class="bottom-parallax">
            <!--Start footer area -->
            <footer class="footer-area">
                {{-- <div class="footer-area-bg" --}} {{--
                    style="background-image: url({{ 'westo/assets' }}/images/resources/footer-bg-1.png);">--}}
                    {{-- </div>--}}


                <div class="footer-bottom">
                    <div class="container">
                        <div class="bottom-inner">
                            <div class="copyright">
                                <p>Copyright &copy; {{date('Y',strtotime(now()))}} <a href="/">Pointtrash</a> All
                                    Rights
                                    Reserved.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </footer>
            <!--End footer area-->
        </div>


        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="flaticon-up-arrow"></span>
        </button>

    </div>


    <script src="{{ 'westo/assets' }}/js/jquery.js"></script>
    <script src="{{ 'westo/assets' }}/js/aos.js"></script>
    <script src="{{ 'westo/assets' }}/js/appear.js"></script>
    <script src="{{ 'westo/assets' }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ 'westo/assets' }}/js/isotope.js"></script>
    <script src="{{ 'westo/assets' }}/js/jquery.bootstrap-touchspin.js"></script>
    <script src="{{ 'westo/assets' }}/js/jquery.countTo.js"></script>
    <script src="{{ 'westo/assets' }}/js/jquery.easing.min.js"></script>
    <script src="{{ 'westo/assets' }}/js/jquery.event.move.js"></script>
    <script src="{{ 'westo/assets' }}/js/jquery.fancybox.js"></script>
    <script src="{{ 'westo/assets' }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ 'westo/assets' }}/js/jquery.nice-select.min.js"></script>
    <script src="{{ 'westo/assets' }}/js/jquery.paroller.min.js"></script>
    <script src="{{ 'westo/assets' }}/js/jquery-sidebar-content.js"></script>
    <script src="{{ 'westo/assets' }}/js/knob.js"></script>
    <script src="{{ 'westo/assets' }}/js/map-script.js"></script>
    <script src="{{ 'westo/assets' }}/js/owl.js"></script>
    <script src="{{ 'westo/assets' }}/js/pagenav.js"></script>
    <script src="{{ 'westo/assets' }}/js/scrollbar.js"></script>
    <script src="{{ 'westo/assets' }}/js/swiper.min.js"></script>
    <script src="{{ 'westo/assets' }}/js/tilt.jquery.js"></script>
    <script src="{{ 'westo/assets' }}/js/TweenMax.min.js"></script>
    <script src="{{ 'westo/assets' }}/js/validation.js"></script>
    <script src="{{ 'westo/assets' }}/js/wow.js"></script>

    <script src="{{ 'westo/assets' }}/js/jquery-1color-switcher.min.js"></script>


    <!-- thm custom script -->
    <script src="{{ 'westo/assets' }}/js/custom.js"></script>

    @stack('js')
</body>

</html>