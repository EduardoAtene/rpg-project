<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
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
        $players = $this->playerService->index();

        return response()->json($players);
    }
    
    public function show($id)
    {
        $player = Player::with('class')->find($id);

        return response()->json($player);
    }

    public function store(StorePlayerRequest $request)
    {
        // dd("a");
        $teste = $request->validated();
        // dd
        $player = Player::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $player,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $player = Player::find($id);
        $player->update($request->all());

        return response()->json($player);
    }

    public function destroy($id)
    {
        $player = Player::find($id);
        $player->delete();

        return response()->json(null, 204);
    }

}
