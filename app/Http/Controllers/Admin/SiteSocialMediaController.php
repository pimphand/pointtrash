<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSocialMedia;
use Illuminate\Http\Request;

class SiteSocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialMedia = SiteSocialMedia::first();

        return view('admin.site-social-media.index', compact('socialMedia'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'facebook_link' => 'required|url',
            'instagram_link' => 'required|url',
            'twitter_link' => 'required|url',
            'youtube_link' => 'required|url',
        ]);

        SiteSocialMedia::find($id)->update($request->only(['facebook_link', 'instagram_link', 'twitter_link', 'youtube_link']));

        return back()->with('success', 'Social media links updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
