<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\GuildService;
use App\Http\Resources\GuildResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GuildController extends Controller
{
    private GuildService $guildService;

    public function __construct(GuildService $guildService)
    {
        $this->guildService = $guildService;
    }

    public function show(int $id): JsonResponse
    {
        $guild = $this->guildService->getGuildById($id);

        if (!$guild) {
            return response()->json(['message' => 'Guilda não encontrada.'], 404);
        }

        return response()->json([
            'message' => 'Guilda obtida com sucesso!',
            'guild' => new GuildResource($guild)
        ]);
    }

    public function getBySession(int $sessionId): JsonResponse
    {
        $guilds = $this->guildService->getGuildsBySession($sessionId);

        if ($guilds->isEmpty()) {
            return response()->json(['message' => 'Nenhuma guilda encontrada para esta sessão.'], 404);
        }

        return response()->json([
            'message' => 'Guildas obtidas com sucesso!',
            'guilds' => GuildResource::collection($guilds)
        ]);
    }
}
