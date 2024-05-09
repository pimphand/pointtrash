@extends('frontend.layouts.app')

@section('content')
@php
use Illuminate\Support\Str;
@endphp
<!-- sidebar-page-container -->
<section class="sidebar-page-container">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="blog-post">

                        <div class="content-items">
                            <figure class="image-box"><img width="80%" src="{{ asset('upload/'.$blog->thumbnail) }}"
                                    alt=""></figure>
                            <div class="post-title">
                                <ul class="info-box">
                                    <li><i class="fa fa-user" aria-hidden="true"></i> <a
                                            href="{{ route('frontend.blogDetail', $blog->seo_title) }}">pointtrash</a>
                                    </li>
                                    <li><i class="icofont-ui-calendar"></i> {{ $blog->date_post }}</li>
                                </ul>
                                <h3><a href="{{ route('frontend.blogDetail', $blog->seo_title) }}">{{ $blog->title
                                        }}</a>
                                </h3>
                                {!! $blog->content !!}

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                    <div class="sidebar-widget post-widget">
                        <div class="widget-title">
                            <h3>Blog Terbaru</h3>
                        </div>
                        <div class="post-inner">

                            @foreach ($blogs_terbaru as $blog_terbaru)
                            <div class="post">
                                <figure class="post-thumb"><a href="blog-details.html"><img
                                            src="{{ asset('frontend') }}/images/resource/recent-post-img-3.png"
                                            alt=""></a></figure>
                                <h4><a href="{{ route('frontend.blogDetail', $blog_terbaru->seo_title) }}">{{
                                        $blog_terbaru->title
                                        }}</a>
                                </h4>
                                <span class="post-date">Pointtrash | {{ $blog_terbaru->date_post }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection