<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Project\ProjectContentStoreRequest;
use App\Models\Project\Project;
use App\Models\Project\ProjectContent;
use App\Models\Project\ProjectComment;
use App\Models\Tutorial\Category;

class ProjectContentController extends Controller
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
        $projects = Project::select('id', 'title', 'prologue')->get();
        $categories = Category::all();
        $edit_mode = false;

        return view('projects.project-create', compact('edit_mode', 'categories', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     * ProjectContentStoreRequest - Validation
     */
    public function store(ProjectContentStoreRequest $request)
    {
        try {
            $project = ProjectContent::create([
                'project_id' => $request->input('project_id'),
                'sub_title' => $request->input('sub_title'),
                'contents' => $request->input('contents'),
            ]);
        } catch (\Throwable $th) {
            $err = $th->getMessage();
            \Log::error($err);

            return back()->withError('Gagal menyimpan data dalam system.')->withInput();
        }

        return redirect()->route('pj.titles.index')->withSuccess("Project contents berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with(['contents' => function($query) {
            $query->select('id', 'project_id', 'sub_title', 'is_publish');
        }, 'author'])->find($id);

        $categories = Category::select('id', 'category')->get();

        $project_content_id = request()->query('project_content_id') ?? null;
// dd($project_content_id);
        if ($project_content_id) {
            $project_content = ProjectContent::with(['comments' => function($query) {
                $query->approved()->with('user');
            }])->find($project_content_id);
        } else {
            $project_content = ProjectContent::with(['comments' => function($query) {
                $query->approved()->with('user');
            }])->first();
        }
        // dd($project_content);

        return view('projects.project-show', compact('project', 'categories', 'project_content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projects = Project::select('id', 'title', 'prologue')->get();
        $project_content_id = request()->query('project_content_id') ?? null;
        $project_content = ProjectContent::find($project_content_id);
        // dd($project_content);
        $categories = Category::all();
        $edit_mode = true;

        return view('projects.project-create', compact('edit_mode', 'categories', 'projects', 'project_content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectContentStoreRequest $request, string $id)
    {
        // dd($request->all());
        try {
            $project_content = ProjectContent::where('id', $id)->update([
                'project_id' => $request->input('project_id'),
                'sub_title' => $request->input('sub_title'),
                'contents' => $request->input('contents'),
            ]);
        } catch (\Throwable $th) {
            $err = $th->getMessage();
            \Log::error($err);

            return back()->withError('Gagal menyimpan data dalam system.')->withInput();
        }

        return redirect()->route('pj.titles.index')->withSuccess("Project contents berhasil dilakukan update.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function publish(string $id)
    {
        $project_content = ProjectContent::find($id);
        
        $project_content->is_publish = true;
        $project_content->save();

        return back()->withSuccess("Publish '$project_content->sub_title' berhasil.");
    }
}
