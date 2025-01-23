<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Player;
use App\Services\PlayerService;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    protected $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }
    public function index()
    {
        $players = $this->playerService->getAllPlayers();

        return response()->json($players);
    }
    
    public function show($id)
    {
        $player = $this->playerService->getPlayerById($id);

        return response()->json($player);
    }

    public function store(StorePlayerRequest $request)
    {
        $request = $request->validated();
        $player = $this->playerService->createPlayer($request);

        return response()->json([
            'success' => true,
            'data' => $player,
        ], 201);
    }

    public function update(UpdatePlayerRequest $request, $id)
    {
        $player = $this->playerService->updatePlayer($request->validated(), $id);

        return response()->json([
            'success' => true,
            'data' => $player,
        ], 200);
    }

    public function destroy($id)
    {
        $player = $this->playerService->deletePlayer($id);
        $player->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jogador excluído com sucesso.',
        ], 200);
    }

}
