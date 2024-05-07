<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OurTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QueryBuilder::for(OurTeam::query())
                ->allowedFilters([
                    AllowedFilter::scope('search', 'search'),
                ])
                ->latest()->paginate($request->per_page ?? 15);

            return response()->json($data);
        }

        return view('admin.our-team.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'position' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook_link' => 'required|string',
            'twitter_link' => 'required|string',
            'instagram_link' => 'required|string',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        if ($request->hasFile('photo')) {
            $thumbnail = $request->file('photo');
            $icon_name = 'photo_'.time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload'), $icon_name);
        }
        $position = $request->input('position', true);

        // Map posisi ke level
        $position_levels = [
            'CEO' => 1,
            'COO' => 2,
            'Direktur' => 3,
            'Manager' => 4,
            'Divisi' => 5,
        ];

        // Tentukan level posisi berdasarkan input
        $position_level = $position_levels[$position] ?? 6; // Gunakan 6 sebagai default jika posisi tidak ditemukan

        // Buat entitas baru di database
        $ourTeam = OurTeam::create([
            'name' => $request->input('name'), // Ambil nama dari input
            'position' => $position, // Simpan posisi asli
            'position_level' => $position_level, // Simpan level posisi
            'photo' => $icon_name, // Pastikan ini adalah nama file yang valid
            'facebook_link' => $request->input('facebook_link'), // Tautan media sosial
            'twitter_link' => $request->input('twitter_link'), // Tautan media sosial
            'instagram_link' => $request->input('instagram_link'), // Tautan media sosial
        ]);

        return response()->json($ourTeam);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
            'name' => 'required|string',
            'position' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook_link' => 'required|string',
            'twitter_link' => 'required|string',
            'instagram_link' => 'required|string',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        if ($request->hasFile('photo')) {
            $thumbnail = $request->file('photo');
            $icon_name = 'photo_'.time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload'), $icon_name);
        }
        $position = $request->input('position', true);

        // Map posisi ke level
        $position_levels = [
            'CEO' => 1,
            'COO' => 2,
            'Direktur' => 3,
            'Manager' => 4,
            'Divisi' => 5,
        ];

        // Tentukan level posisi berdasarkan input
        $position_level = $position_levels[$position] ?? 6; // Gunakan 6 sebagai default jika posisi tidak ditemukan

        // Buat entitas baru di database
        $ourTeam = OurTeam::findOrFail($id);
        $ourTeam->update([
            'name' => $request->input('name'), // Ambil nama dari input
            'position' => $position, // Simpan posisi asli
            'position_level' => $position_level, // Simpan level posisi
            'photo' => $icon_name ?? $ourTeam->photo, // Pastikan ini adalah nama file yang valid
            'facebook_link' => $request->input('facebook_link'), // Tautan media sosial
            'twitter_link' => $request->input('twitter_link'), // Tautan media sosial
            'instagram_link' => $request->input('instagram_link'), // Tautan media sosial
        ]);

        return response()->json($ourTeam);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ourTeam = OurTeam::findOrFail($id);
        $ourTeam->delete();

        return response()->json($ourTeam);
    }
}
