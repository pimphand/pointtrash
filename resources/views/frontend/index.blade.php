@extends('frontend.layouts.app')

@section('content')
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
                    <h1 class="banner-title">Selamat datang di Pointtrash</h1>
                    <p>Aplikasi Pemilahan sampah An-Organik Karya Anak Bangsa.
                        <br> Pilah sampah daur ulang jadi pundi-pundi rupiah!
                    </p>
                </div>
                <div class="banner-btn">
                    <a class="link-btn" href="">Daftar Menjadi Mitra</a>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="slider_banner-image">
                    <img src="{{ asset('images/frontend') }}/header-2-bannar-img.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- main-slider bannar two start -->

<!-- solution work section start -->
<section class="solution-work">
    <div class="container clearfix">
        <div class="section-title">
            <h2>Ayo Jaga Lingkungan!!</h2>
            <p>Punya banyak limbah sampah tapi nggak tahu harus dibuang kemana? Gampang, tukar sampahmu di
                Pointtrash. <br> Di sini kamu
                bisa tukar sampah untuk kumpulkan point dan widraw pointnya. Dengan Pointtrash jadi lebih:.</p>
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
                        <h4 class="single-item-title">Smart Clean</h4>
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
                        <h4 class="single-item-title">Smart Living</h4>
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
                        <h4 class="single-item-title">Smart Action</h4>
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
                        <h4 class="single-item-title">And No More Trash Problems</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- solution work section end -->

<!-- service-works start -->
<section class="service-works">
    <div class="shape-top-image">
        <img src="{{ asset('frontend/images') }}/background/service-top-shape-img.png" alt="">
    </div>
    <div class="bg-service-works">
        <div class="container">

            <div class="section-title">
                <h2>Layanan Kami</h2>
            </div>
            <div class="row clearfix">
                @foreach ($data['layanan'] as $layanan)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="icon-box_one">
                            <div class="service-works__icon-box">
                                <div class="service-works__icon"
                                    style="background-image: url({{ asset('frontend/images') }}/resource/icon-bg.png);">
                                    <img src="{{ asset('upload/'.$layanan->icon) }}" width="50%" alt="">
                                </div>
                                <div class="service-works__hover-icon"
                                    style="background-image: url({{ asset('frontend/images') }}/resource/hover-icon-bg.png);">
                                    <img src="{{ asset('upload/'.$layanan->icon) }}" width="50%" alt="">
                                </div>
                            </div>
                            <h3 class="">{{ $layanan->name }}</h3>
                            <p class="">{{ $layanan->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
<!-- service-works end -->

<!-- latest-work section -->
<section class="latest-works">
    <div class="container">
        <div class="sub-section-two">
            <br><br><br><br>
        </div>
        <div class="section-title">
            <h2 style="color: white">Layanan Kami</h2>
        </div>
        <div class="latest-slider_item">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 image-column">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="single-item-carousel owl-carousel owl-theme">
                        @foreach ($data['advertisement'] as $item)
                        <div class="image-one">
                            <img src="{{ asset('upload/'.$item->advertisment) }}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 image-column">
                </div>
            </div>
        </div>
    </div>
</section>

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
@endsection