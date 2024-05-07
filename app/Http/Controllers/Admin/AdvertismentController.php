<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdvertismentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QueryBuilder::for(Advertisment::query())
                ->allowedFilters([
                    AllowedFilter::scope('search', 'search'),
                ])
                ->orderBy('date_post', 'desc')
                ->paginate($request->per_page ?? 15);

            return response()->json($data);
        }

        return view('admin.advertisment.index');
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
        $validated = Validator::make($request->all(), [
            'link' => 'required|string',
            'advertisment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        if ($request->hasFile('advertisment')) {
            $thumbnail = $request->file('advertisment');
            $icon_name = 'advertisment_'.time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload'), $icon_name);
        }

        $advertisment = new Advertisment();
        $advertisment->advertisment = $icon_name;
        $advertisment->link = $request->input('link');
        $advertisment->save();

        return response()->json(['message' => 'Data berhasil disimpan']);
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
            'link' => 'required|string',
            'advertisment' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        if ($request->hasFile('advertisment')) {
            $thumbnail = $request->file('advertisment');
            $icon_name = 'advertisment_'.time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload'), $icon_name);
        }

        $advertisment = Advertisment::findOrFail($id);
        $advertisment->advertisment = $icon_name ?? $advertisment->advertisment;
        $advertisment->link = $request->input('link');
        $advertisment->save();

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $advertisment = Advertisment::findOrFail($id);
        $advertisment->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
