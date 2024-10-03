<?php

namespace App\Http\Controllers\Tutorial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tutorial\Title;
use App\Models\Tutorial\Tutorial;
use App\Http\Requests\Tutorial\StoreTitleRequest;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreTitleRequest $request)
    {
        $title = Title::create([
            'title' => $request->input('title_name'),
            'prologue' => $request->input('prologue'),
            'category_id' => $request->input('category_id'),
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('success', "Title telah berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $title = Title::with(['tutorials' => function($query) {
            $query->select('id', 'title_id', 'sub_title', 'is_publish')->where('is_publish', true);
        }, 'category', 'author'])->find($id);

        $title_category = Title::select('id', 'title')
                            ->where('id', "<>", $title->id)
                            ->where('category_id', $title->category_id)
                            ->whereHas('tutorials', function ($query) {
                                $query->where('is_publish', true);
                            })
                            ->get();

        $tutorial_id = $request->query('tutorial_id') ?? null;
        
        if ($tutorial_id) {
            $tutorial = Tutorial::with(['comments' => function($query) {
                $query->approved()->with('user');
            }])->find($tutorial_id);
        } else {
            $tutorial = Tutorial::with(['comments' => function($query) {
                $query->approved()->with('user');
            }])->where('title_id', $id)->first();
        }
        
        return view('tutorials.tutorial-show', compact('title', 'tutorial', 'title_category'));
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
        if ($request->input('set_final')) {
            $title = Title::find($id);
            $title->is_final = true;
            $title->save();

            return redirect()->back()->withSuccess('Title berhasila dilakukan finalisasi.');
        }

        return redirect()->back()->with('server-error', 'Terjadi error saat set final title.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
