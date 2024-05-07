<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QueryBuilder::for(Portofolio::query())
                ->allowedFilters([
                    AllowedFilter::exact('id'),
                    AllowedFilter::scope('search', 'search'),
                ])
                ->latest()->paginate($request->per_page ?? 15);

            return response()->json($data);
        }

        return view('admin.portofolio.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string',
            'type' => 'required|string',
            'embed_code' => 'nullable|url', // Required if 'type' is 'video'
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }
        //        dd($request->all());
        if ($request->file('thumbnail')) {
            // Save the thumbnail
            $thumbnail = $request->file('thumbnail');
            $icon_name = 'thumbnail_'.time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload'), $icon_name);
        }
        //        dd($request->all());
        $portofolio = Portofolio::create([
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'embed_code' => $request->input('embed_code'),
            'thumbnail' => $icon_name ?? null, // Using the $icon_name if available, otherwise defaulting to null
        ]);

        return response()->json($portofolio);
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
            'title' => 'required|string',
            'type' => 'required|string',
            'embed_code' => 'nullable|url', // Required if 'type' is 'video'
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        $portofolio = Portofolio::findOrFail($id);

        if ($request->file('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $icon_name = 'thumbnail_'.time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload'), $icon_name);

            $portofolio->thumbnail = $icon_name;
        }

        $portofolio->title = $request->title;
        $portofolio->type = $request->type;
        $portofolio->embed_code = $request->embed_code;
        $portofolio->save();

        return response()->json($portofolio);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Portofolio::destroy($id);

        return response()->json(['success' => 'Portofolio deleted successfully.']);
    }
}
