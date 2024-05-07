<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralQuestion;
use Illuminate\Http\Request;

class GeneralQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $general = GeneralQuestion::first();

        return view('admin.general-question.index', compact('general'));
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
            'content' => 'required|string',
        ]);

        $general = GeneralQuestion::find($id);
        $general->content = $request->content;
        $general->save();

        return redirect()->route('general-question.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
