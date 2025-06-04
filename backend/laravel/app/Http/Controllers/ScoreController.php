<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        return Score::with('user')->get();
    }

    public function myScores(Request $request)
    {
        return Score::where('user_id', $request->user()->id)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'points' => 'required|integer|min:0',
        ]);

        return Score::create([
            'user_id' => $request->user()->id,
            'points' => $request->points,
        ]);
    }
}
