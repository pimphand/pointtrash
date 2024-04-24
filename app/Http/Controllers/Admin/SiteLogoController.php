<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;

class SiteLogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $site_logo = SiteLogo::all();
        return view('admin.site-logo.index', compact('site_logo'));
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
        $validated = Validator::make($request->all(), [
            'logo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'logo_1.image' => 'The file must be an image (jpeg, png, jpg, gif, svg).',
            'logo_1.max' => 'The file size must be less than 2MB.',
            'logo_1.mimes' => 'The file must be an image (jpeg, png, jpg, gif, svg).',
            'logo_2.image' => 'The file must be an image (jpeg, png, jpg, gif, svg).',
            'logo_2.max' => 'The file size must be less than 2MB.',
            'logo_2.mimes' => 'The file must be an image (jpeg, png, jpg, gif, svg).',

            'logo_3.image' => 'The file must be an image (jpeg, png, jpg, gif, svg).',
            'logo_3.max' => 'The file size must be less than 2MB.',
            'logo_3.mimes' => 'The file must be an image (jpeg, png, jpg, gif, svg).',


        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        $icon = $request->file('logo_' . $id);
        $icon_name = time() . '.' . $icon->getClientOriginalExtension();
        $icon->move(public_path('upload'), $icon_name);
        SiteLogo::find($id)->update(['file_name' => $icon_name]);

        return response()->json(['success' => 'Site logo updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
