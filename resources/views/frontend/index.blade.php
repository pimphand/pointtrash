@extends('frontend.layouts.app')

@section('content')
<!-- Start Main Slider -->
<section id="banner" class="main-slider style1">
    <div class="slider-box">
        <!-- Banner Carousel -->
        <div class="banner-carousel owl-theme owl-carousel">
            <!-- Slide -->
            @foreach($getBanner as $banner)
            <div class="slide">
                <div class="image-layer" style="background-image:url({{ 'upload/'.$banner->banner }})">
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- End Main Slider -->

<!--Start Features Style1 Area-->
<section class="features-style1-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="features-style1__content">
                    <ul>

                        @foreach($portofolios as $portofolio)
                        <li>
                            <div class="single-features-style1">
                                <div class="icon-holder">
                                    <div class="box"></div>
                                    <span class="icon-dustbin"></span>
                                </div>
                                <div class="text-holder">
                                    <h3>{{$portofolio->title}}</h3>
                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Features Style1 Area-->

<!--Start About Style1 Area-->
<section id="about" class="about-style1-area">
    <div class="shape1"></div>
    <div class="container">
        <div class="row text-right-rtl">
            <div class="col-xl-6">
                <div class="about-style1__image clearfix">
                    <div class="text-outer">Pointtrash</div>
                    <div class="border-top"></div>
                    <div class="border-left"></div>
                    <div class="border-bottom"></div>
                    <div class="border-right"></div>
                    <ul>
                        <li>
                            <div class="img-box">
                                <img src="{{ 'upload' }}/about-style1__image-1.jpg" alt="">
                            </div>
                        </li>
                        <li>
                            <div class="img-box">
                                <img src="{{ 'upload' }}/about-style1__image-2.jpg" alt="">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="about-style1__content">
                    <br>
                    <br>
                    <br>
                    <div class="sec-title">
                        <div class="sub-title">
                            <h3>
                                Ayo Jaga Lingkungan!!
                            </h3>
                        </div>
                    </div>
                    <div class="inner-content">
                        <div class="text">
                            <p>Punya banyak limbah sampah tapi nggak tahu harus dibuang kemana? Gampang, tukar
                                sampahmu di Pointtrash. Di sini kamu bisa tukar sampah untuk kumpulkan point dan
                                widraw pointnya. Dengan Pointtrash jadi lebih: </p>
                        </div>

                        <div class="about-style1__bottom-content">
                            <div class="row">

                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="text-box">
                                        <ul>
                                            <li>Smart Clean</li>
                                            <li>Smart Living</li>
                                            <li>Smart Action</li>
                                            <li>And No More Trash Problems</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="video-gallery-style1">
                                        <div class="video-gallery-style1__bg"
                                            style="background-image: url({{ 'westo' }}/video-gallery-style1-bg.jpg);">
                                        </div>
                                        <div class="icon wow zoomIn animated" data-wow-delay="300ms"
                                            data-wow-duration="1500ms">
                                            <a class="video-popup" title="Video Gallery"
                                                href="https://www.youtube.com/watch?v=6t4m8YYWbcc">
                                                <span class="icon-play-buttton"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="service-style1__top-button">
                            <a class="btn-one" target="_blank" href="">
                                <span class="txt">
                                    Lebih Detail<i class="icon-download"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--End About Style1 Area-->

<!--Start Service Style1 Area-->
<section id="services" class="service-style1-area">
    <div class="service-style1__bg" style="background-image: url({{ 'westo/service-style1.jpg' }});"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">

                <div class="service-style1__top">
                    <div class="service-style1__top-title">
                        <div class="sec-title sec-title--style2">
                            <div class="sub-title">
                                <h3>Our Services</h3>
                            </div>
                            <h2>Pointtrash Services</h2>
                        </div>
                        <div class="text">
                            <p>Dapatkan aplikasi melalui Appstore dan Google playstore.</p>
                        </div>
                    </div>
                    <div class="service-style1__top-button">
                        <a class="btn-one" target="_blank"
                            href="https://play.google.com/store/apps/details?id=com.pointtrash.pointtrash">
                            <span class="txt">
                                Download<i class="icon-download"></i>
                            </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <div class="row text-right-rtl">
            <!--Start Single Service Style1-->
            @foreach($services as $service )
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="00ms" data-wow-duration="1500ms">
                <div class="single-service-style1">
                    <div class="inner">
                        <div class="round-box"></div>
                        <div class="icon">
                            <i class="fa {{$service->icon}} fa-4x"></i>
                        </div>
                        <div class="text">
                            <h3>{{$service->name}}</h3>
                            <p>{{$service->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--End Service Style1 Area-->

<!--Start Features Style2 Area-->
<section class="features-style2-area">
    <div class="auto-container">
        <div class="row">

            <div class="col-xl-6 col-lg-6">
                <div class="single-features-style2-box">
                    <div class="inner-content">
                        <div class="icon">
                            <div class="box"></div>
                            <span class="icon-garbage-can"></span>
                        </div>
                        <div class="title">
                            <h3>Lorem ipsum is free text</h3>
                            <h2>Landfill and Transfer<br> Station Services</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="single-features-style2-box">
                    <div class="img-bg" style="background-image: url({{ 'westo/' }}features-style2-1.jpg);"></div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="single-features-style2-box">
                    <div class="img-bg" style="background-image: url({{ 'westo' }}/features-style2-2.jpg);"></div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="single-features-style2-box left">
                    <div class="inner-content">
                        <div class="icon">
                            <div class="box"></div>
                            <span class="icon-toxic-waste"></span>
                        </div>
                        <div class="title">
                            <h3>Lorem ipsum is free text</h3>
                            <h2>Accepts Special Waste<br> at Many Locations</h2>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--End Features Style2 Area-->
<!--Start Fact Counter Area-->
<section class="fact-counter-area">
    <div class="fact-counter-area-bg" style="background-image: url({{ 'westo' }}/service-style1.jpg);"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <ul class="fact-counter-box">
                    <!--Start Single Fact Counter-->
                    <li class="single-fact-counter">
                        <div class="inner">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="3000" data-stop="{{$data['user']}}">0</span>
                            </div>
                        </div>
                        <div class="title">
                            <h3>Total User</h3>
                        </div>
                    </li>

                    <li class="single-fact-counter">
                        <div class="inner">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="3000" data-stop="{{$data['mitra']}}">0</span>
                                <span class="k"></span>
                            </div>
                        </div>
                        <div class="title">
                            <h3>Total Partner</h3>

                        </div>
                    </li>

                    <li class="single-fact-counter">
                        <div class="inner">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="3000" data-stop="{{$data['order']}}">0</span>
                                <span class="k"></span>
                            </div>
                        </div>
                        <div class="title">
                            <h3>Total Order</h3>
                        </div>
                    </li>
                    <!--End Single Fact Counter-->
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End Fact Counter Area-->
<!--Start Service Style2 Area-->
<section id="blog" class="service-style2-area">
    <div class="gray-bg"></div>
    <div class="container">
        <div class="sec-title text-center">
            <div class="sub-title">
                <h3>Blog</h3>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-xl-4 col-lg-4">
                <div class="single-service-style2">
                    <div class="img-holder">
                        <img src="{{ 'upload/'.$blog->thumbnail}}" width="40%" alt="" />

                    </div>
                    <div class="text-holder text-center">
                        <h3><a href="{{route('frontend.blogDetail',$blog->seo_title)}}">{{$blog->title}}</a>
                        </h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--End Service Style2 Area-->


<!--Start Contact Info Style1 Area-->
<section id="contact" class="contact-info-style1-area">
    <div class="container">
        <div class="row">

            <div class="col-xl-8">
                <div class="contact-info-style1__box">
                    <div class="sec-title">
                        <h2>Kontak Kami</h2>
                    </div>
                    <div class="contact-form">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.527065447021!2d106.93491957595201!3d-6.946981068011008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6849d8843e5511%3A0x600ca4c106a1c2b7!2sPointtrash%20Indonesia!5e0!3m2!1sen!2sid!4v1716108356314!5m2!1sen!2sid"
                            width="750" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <br>
                <br>
                <br>

                <ul class="list-group mb-3">
                    <li class="list-group-item">
                        <p>Jam Kerja :</p>
                        <ul class="mt-3">
                            <li>09.00 - 16.00 WIB (Senin - Jum'at)</li>
                            <li>Sabtu &amp; Minggu (Libur)</li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <p>Hubungi Kami di :</p>
                        <ul class="mt-3">
                            <li>Email : official.pointtrash@gmail.com</li>
                            <li>No. Telp : +6282320035400</li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <p class="">Alamat :</p>
                        <div class="text-muted mt-3">Villa Alam Asri (Jalur Lingkar Selatan) Jln. Gunung Karang Blok
                            B No. 29-30 Kota Sukabumi
                        </div>
                    </li>
                </ul>
                <a target="_blank"
                    href="https://api.whatsapp.com/send?phone=+6282320035400&text=Haloo%2C%20Admin%20Pointtrash"
                    class="btn btn-info text-white" style="color: white">Hubungi CS</a>
                <a href="{{ route('register.partner') }}" class="btn btn-info text-white" style="color: white">Daftar
                    Mitra Sekarang</a>

            </div>

        </div>
    </div>
</section>
@endsection