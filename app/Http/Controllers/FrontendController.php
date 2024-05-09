<?php

namespace App\Http\Controllers;

use App\Models\Advertisment;
use App\Models\Blog;
use App\Models\Service;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data = [
            'advertisement' => Advertisment::all(),
            'layanan' => Service::all(),
        ];
        return view('frontend.index', compact('data'));
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
}