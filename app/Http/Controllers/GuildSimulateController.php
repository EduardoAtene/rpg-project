<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\GuildSimulatorSessionRequest;
use App\Http\Resources\GuildSimulatorSessionResource;
use App\Services\GuildSimulateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GuildSimulateController extends Controller
{
    private GuildSimulateService $guildSimulateService;

    public function __construct(GuildSimulateService $guildSimulateService)
    {
        $this->guildSimulateService = $guildSimulateService;
    }

    public function simulate(GuildSimulatorSessionRequest $request): JsonResponse
    {
        $simulateValidate = $request->validated();

        $data = $this->guildSimulateService->simulate($simulateValidate);

        return response()->json(ResponseHelper::successResponse(
            'Guildas simuladas com sucesso!',
            ['data' => GuildSimulatorSessionResource::collection($data)],
            200
        ));
    }

    public function confirm(GuildSimulatorSessionRequest $request): JsonResponse
    {
        $simulateValidate = $request->validated();

        $data = $this->guildSimulateService->confirm($simulateValidate);

        return response()->json(ResponseHelper::successResponse(
            'Sessão do rpg confirmada com sucesso e as guildas foram criadas',
            ['data' => GuildSimulatorSessionResource::collection($data)],
            200
        ));
    }
}
