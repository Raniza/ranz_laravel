<?php

namespace App\Http\Controllers\Tutorial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tutorial\Title;
use App\Models\Tutorial\Tutorial;

class SearchTurorialController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $keywords = $request->input('keywords');

        $titles = Title::with('category')->where('title', 'like', '%' . $keywords . '%')
                    ->orWhere('prologue', 'like', '%' . $keywords . '%')->get();
        
        $tutorials = Tutorial::with(['title.category'])->where('sub_title', 'like', '%' . $keywords . '%')
                    ->orWhere('contents', 'like', '%' . $keywords . '%')->get();
        // dd($tutorials->toArray());
        return view('tutorials.search-result', compact('titles', 'tutorials'));
    }
}
