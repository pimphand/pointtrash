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
            <!--Header Top-->
            <div class="header-top">
                <div class="container clearfix">
                    <div class="header-top_text">
                        <p class="header-sub-title">Welcome to <span class="sub-title_color">cleaning service</span></p>
                        <p class="header_contact-number"><i class="icofont-phone"></i> (00) 123 456 789</p>
                    </div>
                </div>
            </div>
            <!-- End Header Top -->
            <!-- Header Upper -->
            <div class="header-upper clearfix">
                <div class="container clearfix">
                    <div class="header-upper_content clearfix">
                        <div class="logo-outer">
                            <div class="logo"><a href="index.html"><img
                                        src="{{ asset('frontend') }}/images/header-logo.png" alt="" title=""></a></div>
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
                            <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li class="current dropdown"><a href="#">Home</a>
                                        <ul>
                                            <li><a href="index.html">Home page 01</a></li>
                                            <li><a href="index-2.html">Home page 02</a></li>
                                            <li><a href="index-3.html">Home page 03</a></li>
                                            <li><a href="index-4.html">Home page 04</a></li>
                                            <li class="dropdown"><a href="#">Header Styles</a>
                                                <ul>
                                                    <li><a href="index.html">Header Style One</a></li>
                                                    <li><a href="index-2.html">Header Style Two</a></li>
                                                    <li><a href="index-3.html">Header Style Three</a></li>
                                                    <li><a href="index-4.html">Header Style Four</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="about.html">About us</a></li>
                                    <li class="dropdown"><a href="#">Services</a>
                                        <ul>
                                            <li><a href="service.html">Services</a></li>
                                            <li><a href="service-details.html">Services details</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">Pages</a>
                                        <ul>
                                            <li class="dropdown"><a href="blog.html">Blog</a>
                                                <ul>
                                                    <li><a href="blog.html">Blog Page</a></li>
                                                    <li><a href="blog-details.html">Blog Standard</a></li>
                                                    <li><a href="blog-details-2.html">Blog Details Two</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="portfolio.html">Portfolio</a>
                                                <ul>
                                                    <li><a href="portfolio.html">Portfolio</a></li>
                                                    <li><a href="portfolio-details.html">Portfolio Details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="faq.html">Faq's Page</a></li>
                                            <li><a href="404.html">error</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->
                        <!--Nav Box-->
                        <div class="nav-outer clearfix">
                            <!-- Main Menu End-->
                            <div class="outer-box clearfix">
                                <!--Search Box-->
                                <div class="search-box-outer">
                                    <div class="dropdown">
                                        <button class="search-box-btn dropdown-toggle" type="button" id="dropdownMenu3"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="icofont-search"></i></button>
                                        <ul class="dropdown-menu pull-right search-panel"
                                            aria-labelledby="dropdownMenu3">
                                            <li class="panel-outer">
                                                <div class="form-container">
                                                    <form method="post" action="blog.html">
                                                        <div class="form-group">
                                                            <input type="search" name="field-name" value=""
                                                                placeholder="Search Here" required>
                                                            <button type="submit" class="search-btn"><i
                                                                    class="icofont-search"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Button Box -->
                                <div class="btn-box">
                                    <a href="contact.html" class="theme-btn btn-style-one">Quick Contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Upper-->
            <!-- Sticky Header  -->
            <div class="sticky-header">
                <div class="container clearfix">
                    <!--Logo-->
                    <div class="logo pull-left">
                        <a href="index.html" title=""><img src="{{ asset('frontend') }}/images/header-logo.png" alt=""
                                title=""></a>
                    </div>
                    <!--Right Col-->
                    <div class="pull-right">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-collapse show collapse clearfix">
                                <ul class="navigation clearfix">
                                    <li class="current dropdown"><a href="#">Home</a>
                                        <ul>
                                            <li><a href="index.html">Home page 01</a></li>
                                            <li><a href="index-2.html">Home page 02</a></li>
                                            <li><a href="index-3.html">Home page 03</a></li>
                                            <li><a href="index-4.html">Home page 04</a></li>
                                            <li class="dropdown"><a href="#">Header Styles</a>
                                                <ul>
                                                    <li><a href="index.html">Header Style One</a></li>
                                                    <li><a href="index-2.html">Header Style Two</a></li>
                                                    <li><a href="index-3.html">Header Style Three</a></li>
                                                    <li><a href="index-4.html">Header Style Four</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="about.html">About us</a></li>
                                    <li class="dropdown"><a href="#">Services</a>
                                        <ul>
                                            <li><a href="service.html">Services</a></li>
                                            <li><a href="service-details.html">Services details</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">Pages</a>
                                        <ul>
                                            <li class="dropdown"><a href="blog.html">Blog</a>
                                                <ul>
                                                    <li><a href="blog.html">Blog Page</a></li>
                                                    <li><a href="blog-details.html">Blog Standard</a></li>
                                                    <li><a href="blog-details-2.html">Blog Details Two</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="portfolio.html">Portfolio</a>
                                                <ul>
                                                    <li><a href="portfolio.html">Portfolio</a></li>
                                                    <li><a href="portfolio-details.html">Portfolio Details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="faq.html">Faq's Page</a></li>
                                            <li><a href="404.html">error</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Main Header -->

        <!-- main-slider bannar two start -->
        <section class="main-slider two">
            <div class="container">
                <div class="parallax-scene parallax-scene-2 parallax-icon">
                    <span data-depth="0.40" class="parallax-layer icon icon-3"></span>
                    <span data-depth="0.50" class="parallax-layer icon icon-4"></span>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-7 col-md-12 col-sm-12">
                        <div class="banner-style">
                            <h1 class="banner-title">Professional Customer <span>Service</span></h1>
                            <p>sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                porro <br> quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                                velit.
                            </p>
                        </div>
                        <div class="banner-btn">
                            <a class="link-btn" href="contact.html">Get In Touch</a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12">
                        <div class="slider_banner-image">
                            <img src="{{ asset('frontend') }}/images/background/header-2-bannar-img.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="shape-img">
                    <div class="cleaning_shape-img-two">
                        <img class="shape-img-picture_one" src="{{ asset('frontend') }}/images/icons/man-img-one.png"
                            alt="">
                        <img class="shape-img-picture_two" src="{{ asset('frontend') }}/images/icons/man-img-two.png"
                            alt="">
                        <img class="shape-img-picture_three"
                            src="{{ asset('frontend') }}/images/icons/man-img-three.png" alt="">
                        <p class="comment-text">12+</p>
                        <h4 class="comment-sub-title">Happy Clients</h4>
                    </div>
                </div>
            </div>
        </section>
        <!-- main-slider bannar two start -->

        <!-- solution work section start -->
        <section class="solution-work">
            <div class="anim-icon">
                <div class="icon icon-2 float-bob-x"></div>
            </div>
            <div class="container clearfix">
                <div class="sub-section-two">
                    <div class="sub-logo">
                        <img src="{{ asset('frontend') }}/images/icons/cleaner-icon-img.png" alt="">
                    </div>
                    <div class="sub-title_sec">
                        <p>What We Do</p>
                    </div>
                </div>
                <div class="section-title">
                    <h2>How does our <span>solution work?</span></h2>
                    <p>Duis dapibus elit ut elit interdum, non tempus ipsum blandit. Suspendisse quis nibh <br> et lorem
                        dignissim semper. Ut malesuada lacus nibh,<br>
                        sit amet varius metus mattis nec.</p>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="content-block wow slideInUp animated animated" data-wow-delay="600ms"
                            data-wow-duration="1500ms"
                            style="visibility: visible; animation-duration: 1500ms; animation-delay: 600ms; animation-name: slideInUp;">
                            <div class="single-item work">
                                <div class="icon-img-box">
                                    <img src="{{ asset('frontend') }}/images/resource/Commercial-Cleaning.png" alt="">
                                </div>
                                <h2 class="number-text">01</h2>
                                <h4 class="single-item-title">Commercial Cleaning</h4>
                                <p class="choose_sub-title">Duis dapibus elit ut elit interdum mattis.</p>
                                <div class="overlay-box">
                                    <a href="images/resource/Commercial-Cleaning.png" class="lightbox-image"
                                        data-fancybox="gallery"><span class="flaticon-right-arrow"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="content-block wow slideInUp animated animated" data-wow-delay="600ms"
                            data-wow-duration="1500ms"
                            style="visibility: visible; animation-duration: 1500ms; animation-delay: 600ms; animation-name: slideInUp;">
                            <div class="single-item work">
                                <div class="icon-img-box">
                                    <img src="{{ asset('frontend') }}/images/resource/Residental-Cleaning.png" alt="">
                                </div>
                                <h2 class="number-text">02</h2>
                                <h4 class="single-item-title">Residental Cleaning</h4>
                                <p class="choose_sub-title">Duis dapibus elit ut elit interdum mattis.</p>
                                <div class="overlay-box">
                                    <a href="images/resource/Residental-Cleaning.png" class="lightbox-image"
                                        data-fancybox="gallery"><span class="flaticon-right-arrow"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                        <div class="content-block wow slideInUp animated animated" data-wow-delay="600ms"
                            data-wow-duration="1500ms"
                            style="visibility: visible; animation-duration: 1500ms; animation-delay: 600ms; animation-name: slideInUp;">
                            <div class="single-item work">
                                <div class="icon-img-box">
                                    <img src="{{ asset('frontend') }}/images/resource/window-cleaner.png" alt="">
                                </div>
                                <h2 class="number-text">03</h2>
                                <h4 class="single-item-title">Window Cleaning</h4>
                                <p class="choose_sub-title">Duis dapibus elit ut elit interdum mattis.</p>
                                <div class="overlay-box">
                                    <a href="images/resource/window-cleaner.png" class="lightbox-image"
                                        data-fancybox="gallery"><span class="flaticon-right-arrow"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                        <div class="content-block wow slideInUp animated animated" data-wow-delay="600ms"
                            data-wow-duration="1500ms"
                            style="visibility: visible; animation-duration: 1500ms; animation-delay: 600ms; animation-name: slideInUp;">
                            <div class="single-item work">
                                <div class="icon-img-box">
                                    <img src="{{ asset('frontend') }}/images/resource/Kitchen-Cleaning.png" alt="">
                                </div>
                                <h2 class="number-text">04</h2>
                                <h4 class="single-item-title">Kitchen Cleaning</h4>
                                <p class="choose_sub-title">Duis dapibus elit ut elit interdum mattis.</p>
                                <div class="overlay-box">
                                    <a href="images/resource/Kitchen-Cleaning.png" class="lightbox-image"
                                        data-fancybox="gallery"><span class="flaticon-right-arrow"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="solution_sub-title">Lobortis mattis odio leo eget mauris met aliquet <a href="#"><span>semper
                            molestie</span></a></h4>
                <div class="sec-link-btn">
                    <div class="service-btn">
                        <a class="theme-btn-three active" href="service.html">View All Services</a>
                    </div>
                    <div class="service-btn two">
                        <a class="theme-btn-three" href="service.html">Quick View</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- solution work section end -->

        <!-- video section start -->
        <section class="video-column_section">
            <div class="auto-container clearfix">
                <div class="vedio-image" style="background-image: url(images/gallery/bg-video_img.jpg)">
                    <div class="image">
                        <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image"><img
                                src="{{ asset('frontend') }}/images/gallery/video-shape-img.png" alt=""></a>
                    </div>
                </div>
                <div class="video-text_content">
                    <h1 class="video-title">Our cleaning services do not have equal <span>competition</span>.</h1>
                </div>
            </div>
        </section>
        <!-- video section end -->

        <!-- whether section start -->
        <section class="whether-section">
            <div class="container">
                <div class="sub-section">
                    <div class="sub-logo">
                        <img src="{{ asset('frontend') }}/images/icons/cleaner-icon-img.png" alt="">
                    </div>
                    <div class="sub-title_sec">
                        <p>What We Do</p>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-5 col-md-12 col-sm-12">
                        <div class="whether-sec-heading">
                            <h2 class="whether_sub-title">Whether you need your <br> entire home or office <br> rewired,
                                we'll evaluate and <br> take care <span>of it on your <br> behalf.</span></h2>
                            <p>Duis dapibus elit ut elit interdum, non tempus ipsum blandit. Suspendisse quis <br> nibh
                                et lorem dignissim semper. Ut malesuada lacus nibh, sit amet varius <br> metus mattis
                                nec.
                            </p>
                            <div class="list-content">
                                <ul class="list-content_one">
                                    <li><img src="{{ asset('frontend') }}/images/icons/check-icon-img.png" alt="">
                                        Bathrooms</li>
                                    <li><img src="{{ asset('frontend') }}/images/icons/check-icon-img.png" alt="">
                                        Offices</li>
                                </ul>
                                <ul class="list-content_two">
                                    <li><img src="{{ asset('frontend') }}/images/icons/check-icon-img.png" alt="">
                                        Bedrooms</li>
                                    <li><img src="{{ asset('frontend') }}/images/icons/check-icon-img.png" alt="">
                                        Businesses</li>
                                </ul>
                                <ul class="list-content_three">
                                    <li><img src="{{ asset('frontend') }}/images/icons/check-icon-img.png" alt="">
                                        Kitchens</li>
                                    <li><img src="{{ asset('frontend') }}/images/icons/check-icon-img.png" alt="">
                                        Carpets</li>
                                </ul>
                            </div>
                        </div>
                        <div class="link-btn-two">
                            <a class="theme-btn-two" href="service.html">View Our Services <span
                                    class="flaticon-right-arrow"></span></a>
                        </div>
                    </div>
                    <div class="offset-1 col-lg-6 col-md-12 col-sm-12">
                        <div class="images-content">
                            <img src="{{ asset('frontend') }}/images/background/home-img.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- whether section end -->

        <!-- high qualty section  -->
        <section class="high-quality two">
            <div class="parallax-scene parallax-scene-1 parallax-icon">
                <span data-depth="0.40" class="parallax-layer icon icon-5"></span>
            </div>
            <div class="container">
                <div class="high-quality_content two">
                    <div class="row clearfix">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="high-quality_image-box">
                                <img src="{{ asset('frontend') }}/images/resource/vacuum-cleaner3-1.png" alt="">
                            </div>
                        </div>
                        <div class="offset-lg-1 col-lg-5 col-md-5 col-sm-12 offset-1">
                            <div class="quality-sub-title">Affordable Repair Solutions</div>
                            <h2 class="sec_title">High-Quality and Friendly <br>
                                Services at Fair Prices</h2>
                            <div class="quality-sec-btn">
                                <a class="quality_theme-btn" href="contact.html">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- high qualty section end  -->

        <!-- counter-section start -->
        <section class="counter-section">
            <div class="anim-icon">
                <div class="icon icon-1 float-bob-x"></div>
            </div>
            <div class="container">
                <div class="counter-section_content">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="inner-image-two">
                                <img src="{{ asset('frontend') }}/images/background/clener-man-worker.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="sub-section">
                                <div class="sub-logo">
                                    <img src="{{ asset('frontend') }}/images/icons/cleaner-icon-img.png" alt="">
                                </div>
                                <div class="sub-title_sec">
                                    <p>What We Do</p>
                                </div>
                            </div>
                            <div class="counter_section-title">
                                <h2>What makes us <br> <span>different?</span></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt
                                    ut <br> labore et dolore magna aliqua. Ut enim ad minim veniam.
                                    Sed ut perspiciatis unde omnis iste <br> natus error sit atem accusantium doloremque
                                    laudantiu sed ut.</p>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-6 col-sm-12 column counter-column">
                                    <div class="inner">
                                        <div class="icon-box">
                                            <img src="{{ asset('frontend') }}/images/icons/heart-icon-img.png" alt="">
                                        </div>
                                        <h4 class="counter-title">Clients</h4>
                                        <div class="count-outer count-box">
                                            <span class="count-text" data-speed="3000" data-stop="2000">0</span>
                                            <span class="plus-tag">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 column counter-column">
                                    <div class="inner">
                                        <div class="icon-box">
                                            <img src="{{ asset('frontend') }}/images/icons/checks-icon-img.png" alt="">
                                        </div>
                                        <h4 class="counter-title">Jobs done</h4>
                                        <div class="count-outer count-box">
                                            <span class="count-text" data-speed="2000" data-stop="100">0</span>
                                            <span class="plus-tag">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 column counter-column">
                                    <div class="inner">
                                        <div class="icon-box">
                                            <img src="{{ asset('frontend') }}/images/icons/persone-icon-img.png" alt="">
                                        </div>
                                        <h4 class="counter-title">Employees</h4>
                                        <div class="count-outer count-box">
                                            <span class="count-text" data-speed="4000" data-stop="800">0</span>
                                            <span class="plus-tag">+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="link-btn-box">
                                <a class="link-btn-five" href="contact.html">Quick Contact <span><i
                                            class="flaticon-right-arrow"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- counter-section end -->

        <!-- service-works start -->
        <section class="testimonial-section">
            <div class="container">
                <div class="sub-section-two">
                    <div class="sub-logo">
                        <img src="{{ asset('frontend') }}/images/icons/cleaner-icon-img.png" alt="">
                    </div>
                    <div class="sub-title_sec">
                        <p>What We Do</p>
                    </div>
                </div>
                <div class="section-title">
                    <h2>We've Proud Trusted<br><span>Students</span></h2>
                    <p>Duis dapibus elit ut elit interdum, non tempus ipsum blandit. Suspendisse quis nibh et lorem
                        dignissim <br> semper. Ut malesuada lacus nibh, sit amet varius metus mattis ne.</p>
                </div>
                <div class="testimonial-items">
                    <div class="three-item-carousel owl-carousel owl-theme">
                        <div class="testimonial_text-content">
                            <div class="testimonial-inner-box">
                                <div class="testimonial_icofont">
                                    <span class="icofont-quote-left"></span>
                                </div>
                                <div class="testimonial-lower-content">
                                    <div class="testimonial-text">
                                        Been using the theme for 4-5 years or more,<br> should’ve given a review
                                        earlier. I’m not a web <br> design pro but I know the basics. Whenever I <br>
                                        run into a little trouble TrueThemes is always <br> super quick and helpful
                                    </div>
                                </div>
                                <div class="testimonial-image">
                                    <div class="testimonial-image-blog">
                                        <img src="{{ asset('frontend') }}/images/resource/testimonial-img-one.png"
                                            alt="">
                                    </div>
                                    <div class="testimonial-image-post">
                                        <h4 class="image-post-title">Ronald Richards</h4>
                                        <p class="image-post-date">ceo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_text-content">
                            <div class="testimonial-inner-box">
                                <div class="testimonial_icofont">
                                    <span class="icofont-quote-left"></span>
                                </div>
                                <div class="testimonial-lower-content">
                                    <div class="testimonial-text">
                                        Been using the theme for 4-5 years or more,<br> should’ve given a review
                                        earlier. I’m not a web <br> design pro but I know the basics. Whenever I <br>
                                        run into a little trouble TrueThemes is always <br> super quick and helpful
                                    </div>
                                </div>
                                <div class="testimonial-image">
                                    <div class="testimonial-image-blog">
                                        <img src="{{ asset('frontend') }}/images/resource/testimonial-img-two.png"
                                            alt="">
                                    </div>
                                    <div class="testimonial-image-post">
                                        <h4 class="image-post-title">Cameron Williamson</h4>
                                        <p class="image-post-date">ceo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_text-content">
                            <div class="testimonial-inner-box">
                                <div class="testimonial_icofont">
                                    <span class="icofont-quote-left"></span>
                                </div>
                                <div class="testimonial-lower-content">
                                    <div class="testimonial-text">
                                        Been using the theme for 4-5 years or more,<br> should’ve given a review
                                        earlier. I’m not a web <br> design pro but I know the basics. Whenever I <br>
                                        run into a little trouble TrueThemes is always <br> super quick and helpful
                                    </div>
                                </div>
                                <div class="testimonial-image">
                                    <div class="testimonial-image-blog">
                                        <img src="{{ asset('frontend') }}/images/resource/testimonial-img-three.png"
                                            alt="">
                                    </div>
                                    <div class="testimonial-image-post">
                                        <h4 class="image-post-title">Jane Cooper</h4>
                                        <p class="image-post-date">ceo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_text-content">
                            <div class="testimonial-inner-box">
                                <div class="testimonial_icofont">
                                    <span class="icofont-quote-left"></span>
                                </div>
                                <div class="testimonial-lower-content">
                                    <div class="testimonial-text">
                                        Been using the theme for 4-5 years or more,<br> should’ve given a review
                                        earlier. I’m not a web <br> design pro but I know the basics. Whenever I <br>
                                        run into a little trouble TrueThemes is always <br> super quick and helpful
                                    </div>
                                </div>
                                <div class="testimonial-image">
                                    <div class="testimonial-image-blog">
                                        <img src="{{ asset('frontend') }}/images/resource/testimonial-img-one.png"
                                            alt="">
                                    </div>
                                    <div class="testimonial-image-post">
                                        <h4 class="image-post-title">Ronald Richards</h4>
                                        <p class="image-post-date">ceo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_text-content">
                            <div class="testimonial-inner-box">
                                <div class="testimonial_icofont">
                                    <span class="icofont-quote-left"></span>
                                </div>
                                <div class="testimonial-lower-content">
                                    <div class="testimonial-text">
                                        Been using the theme for 4-5 years or more,<br> should’ve given a review
                                        earlier. I’m not a web <br> design pro but I know the basics. Whenever I <br>
                                        run into a little trouble TrueThemes is always <br> super quick and helpful
                                    </div>
                                </div>
                                <div class="testimonial-image">
                                    <div class="testimonial-image-blog">
                                        <img src="{{ asset('frontend') }}/images/resource/testimonial-img-two.png"
                                            alt="">
                                    </div>
                                    <div class="testimonial-image-post">
                                        <h4 class="image-post-title">Cameron Williamson</h4>
                                        <p class="image-post-date">ceo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_text-content">
                            <div class="testimonial-inner-box">
                                <div class="testimonial_icofont">
                                    <span class="icofont-quote-left"></span>
                                </div>
                                <div class="testimonial-lower-content">
                                    <div class="testimonial-text">
                                        Been using the theme for 4-5 years or more,<br> should’ve given a review
                                        earlier. I’m not a web <br> design pro but I know the basics. Whenever I <br>
                                        run into a little trouble TrueThemes is always <br> super quick and helpful
                                    </div>
                                </div>
                                <div class="testimonial-image">
                                    <div class="testimonial-image-blog">
                                        <img src="{{ asset('frontend') }}/images/resource/testimonial-img-three.png"
                                            alt="">
                                    </div>
                                    <div class="testimonial-image-post">
                                        <h4 class="image-post-title">Jane Cooper</h4>
                                        <p class="image-post-date">ceo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- service-works end -->

        <!-- location section start -->
        <section class="our-loaction two">
            <div class="container">
                <div class="sub-section-two">
                    <div class="sub-logo">
                        <img src="{{ asset('frontend') }}/images/icons/cleaner-icon-img.png" alt="">
                    </div>
                    <div class="sub-title_sec">
                        <p>Our Projects</p>
                    </div>
                </div>
                <div class="section-title">
                    <h2>We want to share our location <br><span>to find us easily.</span></h2>
                    <p>Duis dapibus elit ut elit interdum, non tempus ipsum blandit. Suspendisse quis nibh et lorem
                        dignissim <br> semper. Ut malesuada lacus nibh, sit amet varius metus mattis ne.</p>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="location-content">
                            <div class="location-map-icon">
                                <img src="{{ asset('frontend') }}/images/resource/addres-icon-img.png" alt="">
                            </div>
                            <div class="office-address">
                                <h4>Office address</h4>
                                <p>2 Holt Street, Surry Hills, Australia.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="location-content">
                            <div class="telephone-icon">
                                <img src="{{ asset('frontend') }}/images/resource/akar-icons_phone.png" alt="">
                            </div>
                            <div class="contact-text">
                                <h4>Telephone number</h4>
                                <p><a href="tel:12345678900">123 - 4567 - 89 00</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="location-content">
                            <div class="mail-address-icon">
                                <img src="{{ asset('frontend') }}/images/resource/charm_mail-icon.png" alt="">
                            </div>
                            <div class="mail-address-content">
                                <h4>Mail address</h4>
                                <p><a href="mailto:Inof@yourmail.org">Inof@yourmail.org</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- location section end -->

        <!-- Get In Touch section start -->
        <section class="location-section">
            <div class="map-inner_two">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15842.108082153993!2d106.9374945!3d-6.9469864!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6849d8843e5511%3A0x600ca4c106a1c2b7!2sPointtrash%20Indonesia!5e0!3m2!1sen!2sid!4v1715219528694!5m2!1sen!2sid"
                        width="1680" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
        <!-- Get In Touch section end -->

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