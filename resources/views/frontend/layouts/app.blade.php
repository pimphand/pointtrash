<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Westo - Responsive HTML 5 Template</title>

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
            <div class="footer-area-bg"
                 style="background-image: url({{ 'westo/assets' }}/images/resources/footer-bg-1.png);">
            </div>

            <div class="footer-top">
                <div class="container">
                    <div class="subscribe-content-box">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="subscribe-title">
                                    <div class="icon">
                                        <span class="icon-open-envelope"></span>
                                    </div>
                                    <div class="inner-title">
                                        <h3>Subscribe Now to Get<br> Latest Updates</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="subscribe-box">
                                    <form class="subscribe-form" action="#">
                                        <input type="email" name="email" placeholder="Email address">
                                        <button class="btn-one" type="submit">
                                            <span class="txt"><i class="icon-send"></i></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Start Footer-->
            <div class="footer">
                <div class="container">
                    <div class="row text-right-rtl">

                        <!--Start single footer widget-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-footer-widget marbtm50">
                                <div class="title">
                                    <h3>About</h3>
                                </div>
                                <div class="our-company-info">
                                    <div class="text-box">
                                        <p>Lorem ipsum dolor sit amet, consect etur adi pisicing elit sed do eiusmod
                                            tempor incididunt ut labore.</p>
                                    </div>
                                    <div class="footer-social-link">
                                        <ul class="clearfix">
                                            <li>
                                                <a href="#"><i class="icon-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-pinterest"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                        <!--Start single footer widget-->
                        <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-footer-widget marbtm50">
                                <div class="title">
                                    <h3>Links</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul>
                                        <li><a href="contact.html">Request Pickup</a></li>
                                        <li><a href="about.html">About Us</a></li>
                                        <li><a href="about.html">Management</a></li>
                                        <li><a href="services.html">Start Service</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                        <!--Start single footer widget-->
                        <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-footer-widget margin-left40">
                                <div class="title">
                                    <h3>Services</h3>
                                </div>
                                <div class="footer-widget-links">
                                    <ul>
                                        <li><a href="services-single-1.html">Grocery Store</a></li>
                                        <li><a href="services-single-2.html">Hotel & Restaurant</a></li>
                                        <li><a href="services-single-3.html">Medical & Hospital</a></li>
                                        <li><a href="services-single-4.html">Waste Removal</a></li>
                                        <li><a href="services-single-1.html">Zero Waste</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                        <!--Start single footer widget-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-footer-widget single-footer-widget--contact-info-box pdtop50">
                                <div class="title">
                                    <h3>Contact</h3>
                                </div>
                                <div class="footer-widget-contact-info">
                                    <ul>
                                        <li>
                                            <div class="inner">
                                                <div class="icon phone">
                                                    <span class="icon-telephone"></span>
                                                </div>
                                                <div class="text">
                                                    <p>
                                                        <a href="tel:123456789">+1-(246) 333-0089</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="inner">
                                                <div class="icon">
                                                    <span class="icon-email-1"></span>
                                                </div>
                                                <div class="text">
                                                    <p>
                                                        <a href="mailto:yourmail@email.com">needhelp@company.com</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="inner">
                                                <div class="icon mapmarker">
                                                    <span class="icon-pin-1"></span>
                                                </div>
                                                <div class="text">
                                                    <p>88 broklyn golden street line<br> New York, USA</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End single footer widget-->

                    </div>
                </div>
            </div>
            <!--End Footer-->
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

<script>
    //get
    $.get('{{route("getHeader")}}', function (data) {
        $('#header').html(data);
    });

</script>
</body>

</html>
