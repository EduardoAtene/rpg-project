<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRpgSessionRequest;
use App\Http\Requests\UpdateRpgSessionRequest;
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

        return response()->json($sessions);
    }

    public function show(int $id): JsonResponse
    {
        $session = $this->rpgSessionService->getSessionById($id);

        return response()->json($session);
    }

    public function store(StoreRpgSessionRequest $request): JsonResponse
    {
        $session = $this->rpgSessionService->createSession($request->validated());

        return response()->json([
            'message' => 'Sessão criada com sucesso!',
            'session' => $session
        ], 201);
    }

    public function update(UpdateRpgSessionRequest $request, int $id): JsonResponse
    {
        $session = $this->rpgSessionService->updateSession($id, $request->validated());

        return response()->json([
            'message' => 'Sessão atualizada com sucesso!',
            'session' => $session
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->rpgSessionService->deleteSession($id);

        return response()->json(['message' => 'Sessão excluída com sucesso!'], 204);
    }
}
