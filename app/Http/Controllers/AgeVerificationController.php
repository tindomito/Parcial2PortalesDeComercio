<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class AgeVerificationController extends Controller
{
    public function show ($id)
    {
        return view('movies.age-verification', [
            'movie' => Movie::findOrFail($id)
        ]);
    }

    public function save(Request $request, int $id)
    {
        $request->session()->put('age-verified', true);
        return to_route('movies.view', ['movie' => $id]);
    }
}
