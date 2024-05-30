<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrashCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubTrashCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = TrashCategory::where('status', true)->where(function ($query) {
            $role = Auth::guard('admin')->user();
            if ($role == 'cabang') {
                $query->where('account_id', $role->account_id)->orWhereNull('account_id');
            }
        })->get();

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
        $thumbnail_name = 'background' . time() . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move(public_path('upload'), $thumbnail_name);

        $role = Auth::guard('admin')->user();

        $category = TrashCategory::create([
            'category' => $request->category,
            'background' => $thumbnail_name,
            'account_id' => $role->roles == 'cabang' ? $role->account_id : null,
            'status' => $role == 'cabang' ? false : true,
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
            $thumbnail_name = 'background' . time() . '.' . $thumbnail->getClientOriginalExtension();
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
