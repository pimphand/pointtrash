<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSite;
use Illuminate\Http\Request;

class AboutSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about_us = AboutSite::first();
        // dd($about_us);
        return view('admin.content.about.index', compact('about_us'));
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
            'show_profile' => 'required',
            'content' => 'required',
            'profile' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $about_us = AboutSite::find($id);
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
            $about_us->profile = $file_name;
        }
        $about_us->content = $request->content;
        $about_us->show_profile = $request->show_profile;

        $about_us->save();
        // dd($about_us);
        return back()->with('success', 'About us information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
