<?php

namespace App\Http\Controllers\Project;

use App\Notifications\Comment\CommentApprove;
use App\Notifications\ProjectCommentApprove;
use App\Notifications\Comment\CommentReject;
use App\Notifications\ProjectCommentReject;
use Illuminate\Support\Facades\Validator;
use App\Models\Project\ProjectComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProjectComentController extends Controller
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
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            "comment" => "required",
        ], [
            "comment.required" => "Comment tidak boleh kosong."
        ]);

        try {
            $comment = ProjectComment::create([
                'project_content_id' => $request->input('project_content_id'),
                'user_id' => auth()->user()->id,
                'comment' => $request->input('comment')
            ]);
        } catch (\Throwable $th) {
            $current_route_action = route()->currentRouteAction();
            \Log::error('Error: ' . $th->getMessage() . ' in ' . $current_route_action);

            return redirect()->back()->with(['error' => "Terjadi kesalahan dalam menyimpan komen anda."]);
        }

        return redirect()->back()->with([
            'success' => "Komen anda berhasil dikirimkan. Status: Tunggu approve admin untuk ditampilkan."
        ]);
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
        $validator = Validator::make($request->all(), [
            'reason' => $request->input('reject') ? 'required' : '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => "Saat reject comment, reason tidak boleh kosong."]);
        }

        $project_comment = ProjectComment::find($id);
        $user = User::find($project_comment->user_id);
        
        try {
            if ($request->input('approve')) {
                $project_comment->is_approve = true;
                $project_comment->save();
    
                $project_comment->load('content:id,project_id');
    // dd($project_comment->toArray());
                $user->notify(new ProjectCommentApprove($project_comment));
            } else {
                $reason = $request->input('reason');

                $old_comment = $project_comment->load('content:id,project_id');

                $project_comment->delete();

                $user->notify(new ProjectCommentReject($old_comment, $reason));
            }
        } catch (\Throwable $th) {
            $current_route_action = app('router')->currentRouteAction();
            \Log::error('Error: ' . $th->getMessage() . ' in ' . $current_route_action);

            return redirect()->back()->with(['error' => "Terjadi kesalahan dalam menyimpan komen anda."]);
        }

        return redirect()->back()->with([
            'success' => "Komentar dari " . $user->name . " berhasil dilakukan approve / reject"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
