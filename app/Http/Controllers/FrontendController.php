<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\OrderData;
use App\Models\Partner;
use App\Models\Portofolio;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    public function index()
    {
        $getBanner = Cache::remember('banner', now()->addMonth(), function () {
            return Banner::all();
        });

        $services = Cache::remember('services', now()->addMonth(), function () {
            return Service::all();
        });

        $data = [
            'mitra' => Partner::count(),
            'user' => User::count(),
            'order' => OrderData::count(),
        ];

        $blogs = Cache::remember('blogs', now()->addMonth(), function () {
            return Blog::limit(3)->get();
        });

        $portofolios = Cache::remember('portofolios', now()->addMonth(), function () {
            return Portofolio::limit(3)->get();
        });

        return view('frontend.index', compact('getBanner', 'services', 'data', 'blogs', 'portofolios'));
    }

    public function blog()
    {
        $blogs = Blog::paginate(5);
        $blogs_terbaru = Blog::orderBy('date_post', 'desc')->take(3)->get();

        return view('frontend.blog', compact('blogs', 'blogs_terbaru'));
    }

    public function blogDetail($id)
    {
        $blog = Blog::whereSeoTitle($id)->first();
        $blogs_terbaru = Blog::orderBy('date_post', 'desc')->take(3)->get();

        return view('frontend.blog_detail', compact('blog', 'blogs_terbaru'));
    }

    public function testMail()
    {
        $partner = Partner::find('3pt3cEkOpf');

        $password = 'adfafadf';

        return view('mail.partner_send_regist', compact('partner', 'password'));
    }
}
