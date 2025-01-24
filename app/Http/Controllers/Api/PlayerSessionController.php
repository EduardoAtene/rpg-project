<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PlayerSessionService;

class PlayerSessionController extends Controller
{
    protected PlayerSessionService $playerSessionService;

    public function __construct(PlayerSessionService $playerSessionService)
    {
        $this->playerSessionService = $playerSessionService;
    }

}
