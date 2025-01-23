<?php

namespace App\Http\Controllers;

use App\Services\PlayerService;

class PlayerViewController extends Controller
{
    protected $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function index()
    {
        $players = $this->playerService->getAllPlayers();

        return view('players/index', [
            'players' => $players,
        ]);
    }

    public function create()
    {
        return view('players/create');
    }
}
