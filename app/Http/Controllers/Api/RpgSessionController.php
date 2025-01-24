<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreRpgSessionRequest;
use App\Http\Requests\UpdateRpgSessionRequest;
use App\Http\Resources\RpgSessionResource;
use App\Services\RpgSessionService;
use Illuminate\Http\JsonResponse;

class RpgSessionController extends Controller
{
    protected RpgSessionService $rpgSessionService;

    public function __construct(RpgSessionService $rpgSessionService)
    {
        $this->rpgSessionService = $rpgSessionService;
    }

    public function index(): JsonResponse
    {
        $sessions = $this->rpgSessionService->getAllSessions();

        return response()->json(ResponseHelper::successResponse(
            'Listagem de sessões obtida com sucesso!',
            [RpgSessionResource::$sessionsLabel => RpgSessionResource::collection($sessions)]
        ));
    }

    public function show(int $id): JsonResponse
    {
        $session = $this->rpgSessionService->getSessionById($id);

        if (!$session) {
            return ResponseHelper::errorResponse('Sessão não encontrada.', 404);
        }

        return response()->json(ResponseHelper::successResponse(
            'Detalhes da sessão de RPG obtidos com sucesso!',
            [RpgSessionResource::$sessionLabel => new RpgSessionResource($session)]
        ));
    }

    public function store(StoreRpgSessionRequest $request): JsonResponse
    {
        $session = $this->rpgSessionService->createSession($request->validated());

        return response()->json(ResponseHelper::successResponse(
            'Sessão de RPG criada com sucesso!',
            [RpgSessionResource::$sessionLabel => new RpgSessionResource($session)]
        ), 201);
    }

    public function update(UpdateRpgSessionRequest $request, int $id): JsonResponse
    {
        $session = $this->rpgSessionService->updateSession($id, $request->validated());

        if (!$session) {
            return ResponseHelper::errorResponse('Sessão de RPG não encontrada.', 404);
        }

        return response()->json(ResponseHelper::successResponse(
            'Sessão de RPG atualizada com sucesso!',
            [RpgSessionResource::$sessionLabel => new RpgSessionResource($session)]
        ));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->rpgSessionService->deleteSession($id);

        return response()->json(ResponseHelper::successResponse(
            'Sessão de RPG excluída com sucesso!'
        ), 200);
    }
}
