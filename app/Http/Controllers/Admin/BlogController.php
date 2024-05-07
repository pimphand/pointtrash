<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QueryBuilder::for(Blog::query())
                ->allowedFilters([
                    AllowedFilter::exact('id'),
                    AllowedFilter::scope('search', 'search'),
                ])
                ->latest()->paginate($request->per_page ?? 15);

            return response()->json($data);
        }

        return view('admin.blog.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contents' => 'required|string',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        // Save the thumbnail
        $thumbnail = $request->file('thumbnail');
        $thumbnail_name = 'thumbnail_'.time().'.'.$thumbnail->getClientOriginalExtension();
        $thumbnail->move(public_path('upload'), $thumbnail_name);

        $blog = Blog::create([
            'title' => $request->title,
            'thumbnail' => $thumbnail_name,
            'content' => $request->contents,
        ]);

        return response()->json($blog);
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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contents' => 'required|string',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        $blog = Blog::findOrFail($id);

        if ($request->file('thumbnail')) {
            // Save the thumbnail
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = 'thumbnail_'.time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload'), $thumbnail_name);
            $blog->thumbnail = $thumbnail_name;
        }

        $blog->title = $request->title;
        $blog->content = $request->contents;
        $blog->save();

        return response()->json($blog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        unlink(public_path('upload/'.$blog->thumbnail));
        $blog->delete();

        return response()->json($blog);
    }
}
