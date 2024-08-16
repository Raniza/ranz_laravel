<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Home;

class HomeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('isAdmin', except: ['index']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $home = Home::first();

        return view('home.home', compact('home'));
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
        $home = Home::first();

        return view('home.home-edit', compact('home'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'contents' => 'required'
        ], [
            'contents.required' => 'Contents home tidak boleh kosong.'
        ]);

        $home = Home::first();

        try {
            if (!$home) {
                Home::create(['contents' => $request->input('contents')]);
            } else {
                $home->update(['contents' => $request->input('contents')]);
            }
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            
            return redirect()->back()->with('error_contents', $th->getMessage());
        }

        return redirect()->route('home.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
