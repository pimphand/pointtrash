<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Pointtrash - Aplikasi Pemilahan sampah online </title>
    <meta property="og:site_name"
        content="Kami hadir di desa mu, untuk membawa perubahan lingkungan, yuk jaga sama-sama !" />
    <meta property="og:title"
        content="Kami hadir di desa mu, untuk membawa perubahan lingkungan, yuk jaga sama-sama !" />
    <meta property="og:url"
        content="https://pointtrash.co.id/read_blog/kami-hadir-di-desa-mu-untuk-membawa-perubahan-lingkungan-yuk-jaga-samasama-.html" />
    <meta property="og:image" content="https://pointtrash.co.id/assets/upload/IMG_kJvjbyLbp2_2021-03-20.jpg">
    <meta property="og:type" content="website" />

    {{-- token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Stylesheets -->
    <link href="{{ asset('frontend') }}/css/bootstrap.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/icofont.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/nice-select.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/color.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/base.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/style-2.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/responsive.css" rel="stylesheet">
    <link href="{{ asset('frontend') }}/css/fontawesome-all.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="icon" href="{{ asset('frontend') }}/images/favicon.png" type="image/x-icon">


</head>

<body>
    <div class="page-wrapper">
        <!-- preloader -->
        <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close">x</div>
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="P" class="letters-loading">
                                P
                            </span>
                            <span data-text-preloader="o" class="letters-loading">
                                O
                            </span>
                            <span data-text-preloader="i" class="letters-loading">
                                I
                            </span>
                            <span data-text-preloader="n" class="letters-loading">
                                N
                            </span>
                            <span data-text-preloader="t" class="letters-loading">
                                T
                            </span>
                            <span data-text-preloader="" class="letters-loading">
                                &NonBreakingSpace;
                            </span>
                            <span data-text-preloader="t" class="letters-loading">
                                T
                            </span>
                            <span data-text-preloader="r" class="letters-loading">
                                R
                            </span>
                            <span data-text-preloader="a" class="letters-loading">
                                A
                            </span>
                            <span data-text-preloader="s" class="letters-loading">
                                S
                            </span>
                            <span data-text-preloader="h" class="letters-loading">
                                H
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- preloader end -->

        <header class="main-header two">
            <!-- Header Upper -->
            <div class="header-upper clearfix" style="background-color: #81c101">
                <div class="container clearfix">
                    <div class="header-upper_content clearfix">
                        <div class="logo-outer">
                            <a href="/"><img src="{{ asset('assets') }}/logo_xs.png" alt="" title=""></a>
                        </div>
                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="navbar-header">
                                <!-- Togg le Button -->
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="icon flaticon-menu-button"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse clearfix text-end" id="navbarSupportedContent">
                                <ul class="navigation clearfix pull-right">
                                    <li><a href="about.html" style="color: white;">Tentang Kami</a></li>
                                    <li class="dropdown"><a style="color: white;" href="#">Services</a></li>
                                    <li class="dropdown"><a style="color: white;"
                                            href="{{ route('frontend.blog') }}">Blog</a></li>
                                    <li class="dropdown"><a style="color: white;" href="#">Kontak Kami</a></li>
                                </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->
                    </div>
                </div>
            </div>
            <!--End Header Upper-->
            <!-- Sticky Header  -->
            <div class="sticky-header" style="background-color: #81c101">
                <div class="container clearfix">
                    <!--Logo-->
                    <div class="logo pull-left">
                        <a href="/" title="">
                            <img src="{{ asset('assets') }}/logo_xs.png" alt="" title="">
                        </a>
                    </div>
                    <!--Right Col-->
                    <div class="pull-right">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-collapse show collapse clearfix">
                                <ul class="navigation clearfix">
                                    <li><a href="about.html" style="color: white;">Tentang Kami</a></li>
                                    <li class="dropdown"><a style="color: white;" href="#">Services</a></li>
                                    <li class="dropdown"><a style="color: white;"
                                            href="{{ route('frontend.blog') }}">Blog</a></li>
                                    <li class="dropdown"><a style="color: white;" href="#">Kontak Kami</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Main Header -->

        @yield('content')

        <!-- footer section start -->
        <footer class="main-footer">
            <div class="container">
                <!--Widgets Section-->
                <div class="widgets-section">
                    <div class="row clearfix">
                        <!--big column-->
                        <div class="big-column col-lg-6 col-md-12 col-sm-12">
                            <div class="row clearfix">
                                <!--Footer Column-->
                                <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                    <div class="footer-widget">
                                        <div class="logo-four">
                                            <a href="index.html"><img
                                                    src="{{ asset('frontend') }}/images/footer-logo.png" alt=""
                                                    title=""></a>
                                        </div>
                                        <div class="text">Duis dapibus elit ut elit interdum, non <br> tempus ipsum
                                            blandit. Suspendisse quis <br> nibh et lorem dignissim semper.</div>
                                        <ul class="footer-awards-list">
                                            <li><img src="{{ asset('frontend') }}/images/award-1.png" alt=""></li>
                                            <li><img src="{{ asset('frontend') }}/images/award-2.png" alt=""></li>
                                            <li><img src="{{ asset('frontend') }}/images/award-3.png" alt=""></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--Footer Column-->
                                <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                    <div class="footer-widget_four">
                                        <h4 class="list-heading">Services</h4>
                                        <ul class="footer-service-list">
                                            <li><a href="#"> <span class="flaticon-right-arrow"></span> Construction
                                                    Places</a></li>
                                            <li><a href="#"><span class="flaticon-right-arrow"></span> Commercial
                                                    Spaces</a></li>
                                            <li><a href="#"><span class="flaticon-right-arrow"></span> Residential
                                                    Areas</a></li>
                                            <li><a href="#"><span class="flaticon-right-arrow"></span> Laundry
                                                    Service</a></li>
                                            <li><a href="#"><span class="flaticon-right-arrow"></span> Carpet
                                                    Cleaning</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--big column-->
                        <div class="big-column col-lg-6 col-md-12 col-sm-12">
                            <div class="row clearfix">
                                <!--Footer Column-->
                                <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                                    <div class="footer-widget_four">
                                        <h4 class="list-heading">Information</h4>
                                        <!--News Widget Block-->
                                        <div class="usefull-widget-block">
                                            <div class="widget-inner">
                                                <ul class="footer-usefull-link">
                                                    <li><a href="#"><span class="flaticon-right-arrow"></span>
                                                            Services</a></li>
                                                    <li><a href="#"><span class="flaticon-right-arrow"></span> Blog</a>
                                                    </li>
                                                    <li><a href="#"><span class="flaticon-right-arrow"></span>
                                                            Contacts</a></li>
                                                    <li><a href="#"><span class="flaticon-right-arrow"></span> Site
                                                            Map</a></li>
                                                    <li><a href="#"><span class="flaticon-right-arrow"></span> Privacy
                                                            Policy</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Footer Column-->
                                <div class="footer-column col-lg-5 col-md-6 col-sm-12">
                                    <div class="footer-widget_four">
                                        <h4 class="list-heading">Contact us</h4>
                                        <ul class="contact-list">
                                            <li class="location-number"><span class="icon fa fa-map-marker-alt"></span>
                                                <div class="contact-text">1901 Avenue of the Stars Suite 200
                                                    San Diego, CA 90067</div>
                                            </li>
                                            <li><img src="{{ asset('frontend') }}/images/icons/talephone-img.png"
                                                    alt=""><a href="tel:88657524332">123 - 4567 - 89 00</a></li>
                                            <li><img src="{{ asset('frontend') }}/images/icons/ant-design_mail-outlined.png"
                                                    alt=""> <a href="mailto:Inof@yourmail.org">Inof@yourmail.org</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <div class="clearfix">
                        <div class="footer-bottom_center">
                            <div class="copyright">Copyright By &copy; <a href="index.html"><span>Cleaner</span></a> -
                                2023 </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer section end -->
    </div>
    <!--End pagewrapper-->

    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
    <!--Scroll to top-->
    <script src="{{ asset('frontend') }}/js/jquery.js"></script>
    <script src="{{ asset('frontend') }}/js/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/js/owl.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('frontend') }}/js/wow.js"></script>
    <script src="{{ asset('frontend') }}/js/appear.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.fancybox.js"></script>
    <script src="{{ asset('frontend') }}/js/parallax.min.js"></script>
    <script src="{{ asset('frontend') }}/js/script.js"></script>

</body>

</html>