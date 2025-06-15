<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        return Score::with('user')->get();
    }

    public function myScores($userId)
    {
        return Score::where('user_id', $userId)->get();
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'points' => 'required|integer',
        ]);

        $validated['date'] = now()->toDateString();

        $score = Score::create($validated);

        return response()->json($score, 201);
    }
}
