@php
use App\Models\SiteContact;use App\Models\SiteSocialMedia;use Illuminate\Support\Facades\Cache;$data =
Cache::remember('site_contact', now()->addMonth(), function () {
return SiteContact::first();
});

$socialMedia = Cache::remember('site_social_media', now()->addMonth(), function () {
return SiteSocialMedia::first();
});
@endphp

<div class="header-top">
    <div class="auto-container">
        <div class="outer-box">
            <div class="header-top__left">
                <div class="header-contact-info-style1">
                    <ul>
                        <li>
                            <div class="icon">
                                <span class="icon-pin"></span>
                            </div>
                            <div class="text">
                                <p>{{$data->address}}</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="icon-email"></span>
                            </div>
                            <div class="text">
                                <p><a href="{{$data->email}}">{{$data->email}}</a></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <span class="icon-time"></span>
                            </div>
                            <div class="text">
                                <p>09.00 - 16.00 WIB (Senin - Jum'at)</p>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="header-top__right">
                <div class="header-button-style1">
                    <a class="btn-one" href="{{ route('register.partner') }}">
                        <span class="txt">
                            Daftar Mitra<i class="icon-motor arrow"></i>
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="header">
    <div class="auto-container">
        <div class="outer-box">

            <!--Start Header Left-->
            <div class="header-left">
                <div class="main-logo-box">
                    <a href="/">
                        <img src="{{ 'assets/pointtrash_logo.png' }}" alt="Awesome Logo" title="">
                    </a>
                </div>
                <div class="header-social-link">
                    <ul class="clearfix">
                        <li>
                            <a target="_blank" href="{{$socialMedia->twitter_link}}"><i class="icon-twitter"></i></a>
                        </li>
                        <li>
                            <a target="_blank" href="{{$socialMedia->facebook_link}}"><i class="icon-facebook"></i></a>
                        </li>
                        <li>
                            <a target="_blank" href="{{$socialMedia->youtube_link}}"><i
                                    class="fa fa-youtube-play"></i></a>
                        </li>
                        <li>
                            <a target="_blank" href="{{$socialMedia->instagram_link}}"><i
                                    class="icon-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--End Header Left-->

            <!--Start Header Middle-->
            <div class="header-middle">
                <div class="nav-outer style1 clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <div class="inner">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </div>
                    </div>
                    <!-- Main Menu -->
                    <nav class="main-menu style1 navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix scroll-nav" id="nav_home">

                                <li><a href="#banner">Home</a></li>
                                <li><a href="#about">Tentang Kami</a></li>
                                <li><a href="#services">Layanan</a></li>
                                <li><a href="#blog">Blog</a></li>
                                <li><a href="#contact">Kontak</a></li>

                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->
                </div>
            </div>
            <!--End Header Middle-->

            <!--Start Header Right-->
            <div class="header-right">
                {{-- <div class="phone-number-box1" style="color: white">--}}
                    {{-- <div class="icon">--}}
                        {{-- <span class="icon-phone-ringing"></span>--}}
                        {{-- </div>--}}
                    {{-- <div class="phone">--}}
                        {{-- <p>Have any questions?</p>--}}
                        {{-- <a href="tel:123456789">+92 666 888 0000</a>--}}
                        {{-- </div>--}}
                    {{-- </div>--}}

                {{-- <div class="serach-button-style1">--}}
                    {{-- <button type="button" class="search-toggler">--}}
                        {{-- <i class="icon-magnifying-glass"></i>--}}
                        {{-- </button>--}}
                    {{-- </div>--}}

            </div>
            <!--End Header Right-->

        </div>
    </div>
</div>

<!--End Header Top-->

<!--Sticky Header-->
<div class="sticky-header">
    <div class="container">
        <div class="clearfix">
            <!--Logo-->
            <div class="logo float-left">
                <a href="index.html" class="img-responsive">
                    <img src="{{ 'westo/assets' }}/images/resources/sticky-logo.png" alt="" title="">
                </a>
            </div>
            <!--Right Col-->
            <div class="right-col float-right">
                <!-- Main Menu -->
                <nav class="main-menu clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
            </div>
        </div>
    </div>
</div>
<!--End Sticky Header-->

<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><span class="icon fa fa-times-circle"></span></div>
    <nav class="menu-box">
        <div class="nav-logo">
            <a href="index.html"><img src="{{ 'westo/assets' }}/images/resources/mobilemenu-logo.png" alt=""
                    title=""></a>
        </div>
        <div class="menu-outer">

        </div>

        <div class="social-links">
            <ul class="clearfix">
                <li>
                    <a target="_blank" href="{{$socialMedia->twitter_link}}"><i class="icon-twitter"></i></a>
                </li>
                <li>
                    <a target="_blank" href="{{$socialMedia->facebook_link}}"><i class="icon-facebook"></i></a>
                </li>
                <li>
                    <a target="_blank" href="{{$socialMedia->youtube_link}}"><i class="fa fa-youtube-play"></i></a>
                </li>
                <li>
                    <a target="_blank" href="{{$socialMedia->instagram_link}}"><i class="icon-instagram"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- End Mobile Menu -->