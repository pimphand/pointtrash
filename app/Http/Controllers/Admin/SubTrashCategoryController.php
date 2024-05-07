<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrashCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubTrashCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = TrashCategory::all();

        return view('admin.trash.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'category' => 'required|string',
            'background' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ])->validate();

        $thumbnail = $request->file('background');
        $thumbnail_name = 'background'.time().'.'.$thumbnail->getClientOriginalExtension();
        $thumbnail->move(public_path('upload'), $thumbnail_name);

        $category = TrashCategory::create([
            'category' => $request->category,
            'background' => $thumbnail_name,
        ]);

        return response()->json($category);
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
            'category' => 'required|string',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ])->validate();

        if ($request->hasFile('background')) {
            $thumbnail = $request->file('background');
            $thumbnail_name = 'background'.time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload'), $thumbnail_name);
        }

        $category = TrashCategory::where('category_id', $id)->first();
        $category->update([
            'category' => $request->category,
            'background' => $thumbnail_name ?? $category->background,
        ]);

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trash = TrashCategory::where('category_id', $id)->first();
        $trash->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
