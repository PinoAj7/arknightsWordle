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

        $score = Score::create([
            'user_id' => auth()->id(),
            'points' => $validated['points'],
            'date' => now()->toDateString(),
        ]);

        return response()->json($score, 201);
    }

    public function show()
    {
        $scores = Score::with('user')->orderBy('created_at', 'desc')->paginate(20); 
        
        return view('scoreboard', ['scores' => $scores]);
    }
}
