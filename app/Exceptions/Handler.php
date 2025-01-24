<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception): JsonResponse
    {
        if ($exception instanceof ModelNotFoundException) {
            return ResponseHelper::errorResponse('Recurso não encontrado.', 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            return ResponseHelper::errorResponse('Endpoint não encontrado.', 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return ResponseHelper::errorResponse('Método HTTP não permitido para esta rota.', 405);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'Erro de validação.',
                'details' => $exception->errors(),
            ], 422);
        }

        if ($exception instanceof HttpException) {
            return ResponseHelper::errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        return ResponseHelper::errorResponse('Erro interno no servidor.', 500);
    }
}
