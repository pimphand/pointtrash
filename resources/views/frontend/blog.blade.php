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
                        @foreach ($blogs as $item)
                        <div class="content-items">
                            <figure class="image-box"><a
                                    href="{{ route('frontend.blogDetail', $item->seo_title) }}"><img width="80%"
                                        src="{{ asset('upload/'.$item->thumbnail) }}" alt=""></a></figure>
                            <div class="post-title">
                                <ul class="info-box">
                                    <li><i class="fa fa-user" aria-hidden="true"></i> <a
                                            href="{{ route('frontend.blogDetail', $item->seo_title) }}">pointtrash</a>
                                    </li>
                                    <li><i class="icofont-ui-calendar"></i> {{ $item->date_post }}</li>
                                </ul>
                                <h3><a href="{{ route('frontend.blogDetail', $item->seo_title) }}">{{ $item->title
                                        }}</a>
                                </h3>
                                {!! Str::limit($item->content, 500)!!}
                                <div class="link-btn"><a
                                        href="{{ route('frontend.blogDetail', $item->seo_title) }}">Selengkapnya<i
                                            class="flaticon-right-arrow"></i></a></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="pagination-wrapper">

                    </div>
                    {{ $blogs->links() }}
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
                                <h4><a href="{{ route('frontend.blogDetail', $item->seo_title) }}">{{ $item->title
                                        }}</a>
                                </h4>
                                <span class="post-date">Pointtrash | {{ $item->date_post }}</span>
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