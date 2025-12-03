<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class AgeVerificationController extends Controller
{
    public function show ($id)
    {
        return view('events.age-verification', [
            'event' => Event::findOrFail($id)
        ]);
    }

    public function save(Request $request, int $id)
    {
        $request->session()->put('age-verified', true);
        return to_route('events.view', ['event' => $id]);
    }
}
