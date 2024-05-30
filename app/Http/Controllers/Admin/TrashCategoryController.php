<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubTrashCategory;
use App\Models\TrashCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $role = Auth::guard('admin')->user();
        if ($request->ajax()) {
            $data = QueryBuilder::for(SubTrashCategory::query())
                ->allowedFilters([
                    AllowedFilter::scope('search', 'search'),
                ])
                ->with('category')
                ->where(function ($query) use ($role) {
                    if ($role->roles == 'cabang') {
                        $query->where(function ($q) use ($role) {
                            $q->where('account_id', $role->account_id)
                                ->orWhereNull('account_id');
                        });
                    }
                })
                ->paginate($request->per_page ?? 15);

            return response()->json($data);
        }

        $categories = TrashCategory::where('status', true)->where(function ($query) use ($role) {
            if ($role->roles == 'cabang') {
                $query->where(function ($q) use ($role) {
                    $q->where('account_id', $role->account_id)
                        ->orWhereNull('account_id');
                });
            }
        })->get();

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

        $role = Auth::guard('admin')->user();

        SubTrashCategory::create([
            'sub_category' => $validated['sub_category'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'account_id' => $role->roles == 'cabang' ? $role->account_id : null,
            'status' => $role->roles == 'cabang' ? false : true,
        ]);

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
