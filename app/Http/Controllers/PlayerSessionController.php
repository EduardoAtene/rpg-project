<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssociatePlayerSessionRequest;
use App\Http\Requests\FilterPlayersSessionRequest;
use App\Http\Requests\UnassociatePlayerSessionRequest;
use App\Http\Resources\PlayerSessionResource;
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

    public function associate(AssociatePlayerSessionRequest $request,  $id): JsonResponse
    {
        $validated = $request->validated();
        $this->playerSessionService->associatePlayersToSession(intval($id), $validated['player_ids']);

        return response()->json(
            ResponseHelper::successResponse('Jogadores associados à sessão com sucesso!')
        );
    }

    public function unassociate(UnassociatePlayerSessionRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();
        $this->playerSessionService->unassociatePlayersFromSession($id, $validated['player_ids']);

        return response()->json(
            ResponseHelper::successResponse('Jogadores inativados da sessão com sucesso!')
        );
    }
}
