<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        // return response()->json(Player::all());
        $players = Player::with('class')->get();

        dd($players);
        return view('players.index', compact('players'));
    }
}
