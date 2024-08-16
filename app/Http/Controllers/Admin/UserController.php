<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name')->get();
        $trashed_users = User::onlyTrashed()->get();

        return view('admin.user', compact('users', 'trashed_users'));
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
        $user_id = $request->input('user_id');
        $user_role = $request->input('role');

        try {
            if ($user_role) {
                $user = User::find($user_id);
                $user->role = $user_role;
                $user->save();
            }
        } catch (\Throwable $th) {
            $err = $th->getMessage();
            \Log::error($err);

            return redirect()->back()->with(['error' => "Role gagal disimpan dalam system."]);
        }

        return redirect()->back()->with(['success' => "Role user berhasil diubah."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->query('force_delete')) {
            return redirect()->back()->withSuccess("Feature ini belum dibuatkan");
        }

        if ($request->query('restore')) {
            $user = User::withTrashed()->where('id', $id);
            $user->restore();

            return redirect()->back()->withSuccess("User berhasil dikembalikan.");
        }

        $user = User::find($id);

        $user->delete();

        return redirect()->back()->withSuccess($user->name . ' berhasil dihapus dari system.');
    }
}
