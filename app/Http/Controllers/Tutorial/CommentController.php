<?php

namespace App\Http\Controllers\Tutorial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tutorial\Comment;
use App\Models\User;
use App\Notifications\Comment\CommentApprove;
use App\Notifications\Comment\CommentReject;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with(['tutorial:id,title_id,sub_title', 'tutorial.title.author', 'user'])
                                ->notApproved()
                                ->get()
                                ->groupBy('tutorial.title_id');
        // dd($comments->toArray());
        return view('tutorials.tutorial-comment', compact('comments'));
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
        $validated = $request->validate([
            "comment" => "required",
        ], [
            "comment.required" => "Comment tidak boleh kosong."
        ]);

        try {
            $comment = Comment::create([
                'tutorial_id' => $request->input('tutorial_id'),
                'user_id' => auth()->user()->id,
                'comment' => $request->input('comment')
            ]);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());

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
        $validator =Validator::make($request->all(), [
            'reason' => $request->input('reject') ? 'required' : '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => "Saat reject comment, reason tidak boleh kosong."]);
        }

        $comment = Comment::find($id);
        $user = User::find($comment->user_id);

        // dd($request->all());

        if ($request->input('approve')) {
            $comment->is_approve = true;
            $comment->save();

            $comment->load('tutorial:id,title_id');

            $user->notify(new CommentApprove($comment));
        } else {
            $reason = $request->input('reason');

            $old_comment = $comment->load('tutorial:id,title_id');

            $comment->delete();

            $user->notify(new CommentReject($old_comment, $reason));
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
