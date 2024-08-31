<?php

namespace App\Http\Controllers\Tutorial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tutorial\Title;
use App\Models\Tutorial\Tutorial;
use App\Models\Tutorial\Category;
use App\Http\Requests\Tutorial\StoreTutorialRequest;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titles = Title::with(['category', 'tutorials', 'author'])->whereHas('tutorials', function($query) {
            $query->where('is_publish', true);
        })->get()->groupBy('category.category');

        return view('tutorials.tutorial', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $titles = Title::where('is_final', false)->get();
        $tutorial = null;
        $edit_mode = false;

        return view('tutorials.tutorial-create', compact(
            'categories', 'titles', 'tutorial', 'edit_mode'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTutorialRequest $request)
    {
        $tutorial = Tutorial::updateOrcreate([
            'id' => $request->input('tutorial_id'),
        ], [
            'title_id' => $request->input('title_id'),
            'sub_title' => $request->input('sub_title'),
            'contents' => $request->input('contents')
        ]);

        return redirect()->back()->with('success', 'Tutorial berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $titles = Title::with(['tutorials', 'author', 'category'])->cursorPaginate(5);
        
        return view('tutorials.tutorial-list', compact('titles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $titles = Title::where('is_final', false)->get();
        $tutorial = Tutorial::with(['title.category'])->find($id);
        $edit_mode = true;

        return view('tutorials.tutorial-create', compact(
            'categories', 'titles', 'tutorial', 'edit_mode'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /** Publish tutorial */
        $tutorial = Tutorial::find($id);
        $tutorial->is_publish = true;
        $tutorial->save();

        return redirect()->back()->with('success', 'Tutorial berhasil dipublish.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
