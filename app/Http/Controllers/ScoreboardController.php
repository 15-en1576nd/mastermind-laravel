<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameStore;

class ScoreboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = GameStore::orderBy('score', 'asc')->limit(10)->get();
        return view('scoreboard.index', compact('games'));
    }
}