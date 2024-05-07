<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubTrashCategory;
use App\Models\TrashCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TrashCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QueryBuilder::for(SubTrashCategory::query())
                ->allowedFilters([
                    AllowedFilter::scope('search', 'search'),
                ])
                ->with('category')
                ->paginate($request->per_page ?? 15);

            return response()->json($data);
        }

        $categories = TrashCategory::all();

        return view('admin.trash.sub-categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'sub_category' => 'required|string',
            'category_id' => 'required|exists:trash_category,category_id',
            'price' => 'required|numeric',
        ])->validate();

        SubTrashCategory::create($validated);

        return response()->json(['message' => 'Sub category created successfully']);
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
            'sub_category' => 'required|string',
            'category_id' => 'required|exists:trash_category,category_id',
            'price' => 'required|numeric',
        ])->validate();

        $category = SubTrashCategory::where('sub_category_id', $id)->first();
        $category->update($validated);
        $category->save();

        return response()->json(['message' => 'Sub category created successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SubTrashCategory::findOrFail($id)->delete();

        return response()->json(['message' => 'Sub category deleted successfully']);
    }
}
