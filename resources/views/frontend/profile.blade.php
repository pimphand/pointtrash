@extends('frontend.layouts.app')

@section('content')
<!--Start breadcrumb area paroller-->
<section class="breadcrumb-area">
    <div class="breadcrumb-area-bg"
        style="background-image: url({{ asset('westo') }}/assets/images/breadcrumb/breadcrumb-1.jpg);">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content">
                    <div class="breadcrumb-menu" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li class="active">Tentang Pointtrash</li>
                        </ul>
                    </div>

                    <div class="title" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <h2>Tentang Pointtrash</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start About Style3 Area-->
<section class="about-style3-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="about-style3__content">

                    <div class="text">
                        {!! $about->content !!}
                    </div>

                </div>
            </div>


        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    $('#nav_home li a').each(function() {
        $(this).attr('href','{{ route("home") }}'+$(this).attr('href') );
    });
</script>
@endpush