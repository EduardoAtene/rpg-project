<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\PlayerSessionService;

class PlayerSessionController extends Controller
{
    protected PlayerSessionService $playerSessionService;

    public function __construct(PlayerSessionService $playerSessionService)
    {
        $this->playerSessionService = $playerSessionService;
    }

    public function getAllPlayersAssociateSession(int $id)
    {
        $this->playerSessionService->getAllPlayersAssociateSession($sessionId);




        return  response()->json(
            ResponseHelper::successResponse(
                'Listagem de jogadores obtida com sucesso!',
                // [PlayerSessionResource::$playerSessionsLabel => PlayerSessionResource::collection($playerSessions)]
                []
            )
        );
    }
}
