<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;

class PlayerController extends Controller
{
    protected PlayerService $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function index(): JsonResponse
    {
        $players = $this->playerService->getAllPlayers();

        return response()->json(ResponseHelper::successResponse(
            'Listagem de jogadores obtida com sucesso!',
            [PlayerResource::$playersLabel => PlayerResource::collection($players)]
        ));
    }

    public function show(int $id): JsonResponse
    {
        $player = $this->playerService->getPlayerById($id);

        if (!$player) {
            return ResponseHelper::errorResponse('Jogador não encontrado.', 404);
        }

        return response()->json(ResponseHelper::successResponse(
            'Detalhes do jogador obtidos com sucesso!',
            [PlayerResource::$playerLabel => new PlayerResource($player)]
        ));
    }

    public function store(StorePlayerRequest $request): JsonResponse
    {
        $player = $this->playerService->createPlayer($request->validated());

        return response()->json(ResponseHelper::successResponse(
            'Jogador criado com sucesso!',
            [PlayerResource::$playerLabel  => new PlayerResource($player)]
        ), 201);
    }

    public function update(UpdatePlayerRequest $request, int $id): JsonResponse
    {
        $player = $this->playerService->updatePlayer($id, $request->validated());

        if (!$player) {
            return ResponseHelper::errorResponse('Jogador não encontrado.', 404);
        }

        return response()->json(ResponseHelper::successResponse(
            'Jogador atualizado com sucesso!',
            [PlayerResource::$playerLabel  => new PlayerResource($player)]
        ));
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->playerService->deletePlayer($id);

        if (!$deleted) {
            return ResponseHelper::errorResponse('Jogador não encontrado.', 404);
        }

        return response()->json(ResponseHelper::successResponse(
            'Jogador excluído com sucesso!' 
        ));
    }
}
