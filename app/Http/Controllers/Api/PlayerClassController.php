<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Http\Resources\PlayerClassResource;
use App\Services\PlayerClassService;
use Illuminate\Http\JsonResponse;

class PlayerClassController extends Controller
{
    protected PlayerClassService $playerClassService;

    public function __construct(PlayerClassService $playerClassService)
    {
        $this->playerClassService = $playerClassService;
    }

    public function index(): JsonResponse
    {
        $playersClasses = $this->playerClassService->getAllClasses();

        return response()->json(ResponseHelper::successResponse(
            'Listagem de todas classes obtida com sucesso!',
            [PlayerClassResource::$playersClassesLabel => PlayerClassResource::collection($playersClasses)]
        ));
    }
}
