<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        // Verifica se o erro é de validação
        if ($exception instanceof ValidationException) {
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $exception->errors(),
            ], 422);
        }

        // Para outros erros, retorna uma resposta JSON genérica
        return parent::render($request, $exception);
    }
}
