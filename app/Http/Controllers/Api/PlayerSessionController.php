<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterPlayersSessionRequest;
use App\Http\Resources\PlayerSessionResource;
use App\Models\PlayerSession;
use App\Services\PlayerSessionService;
use Illuminate\Http\JsonResponse;

class PlayerSessionController extends Controller
{
    protected PlayerSessionService $playerSessionService;

    public function __construct(PlayerSessionService $playerSessionService)
    {
        $this->playerSessionService = $playerSessionService;
    }

    public function filterPlayers(FilterPlayersSessionRequest $request,int $id): JsonResponse
    {
        $validated = $request->validated();
        $playerSessions = $this->playerSessionService->filterPlayersBySession($id, $validated);

        return  response()->json(
            ResponseHelper::successResponse(
                'Listagem de jogadores obtida com sucesso!',
                [PlayerSessionResource::$playersAssociatedLabel => $request->get('associated') == 1,
                PlayerSessionResource::$playerSessionLabel => PlayerSessionResource::collection($playerSessions)]
            )
        );
    }
}
