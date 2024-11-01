<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Project\ProjectStoreRequest;
use App\Models\Project\Project;
use App\Models\Tutorial\Category;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['contents'])->orderBy('id', 'asc')->get();
        $categories = Category::all();
        $edit_mode = true;
        // dd($projects->toArray());
        return view('projects.project', compact('projects', 'categories', 'edit_mode'));
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
     * ProjectStoreRequest - Validation rules
     */
    public function store(ProjectStoreRequest $request)
    {
        try {
            $project = Project::create([
                'title' => $request->input('title'),
                'prologue' => $request->input('prologue'),
                'category_id' => array_map('intval', $request->input('category_id')),
                'desc' => $request->input('desc'),
                'user_id' => auth()->user()->id
            ]);
        } catch (\Throwable $th) {
            $err = $th->getMessage();
            \Log::error($err);

            return back()->withError("Gagal dalam menyimpan data dalam system")->withInput();
        }

        return back()->withSuccess("Project title berhasil ditambahkan");
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
        $project = Project::find($id);
        $categories = Category::all();

        return view('projects.project-edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * ProjectStoreRequest - Validation
     */
    public function update(ProjectStoreRequest $request, string $id)
    {
        $project = Project::where('id', $id)->update([
            'title' => $request->input('title'),
            'prologue' => $request->input('prologue'),
            'category_id' => array_map('intval', $request->input('category_id')),
            'desc' => $request->input('desc'),
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('pj.titles.index')->withSuccess("Project Title berhasil dilakukan update.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
