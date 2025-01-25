<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Helpers\ResponseHelper;

class ValidateException extends Exception
{
    protected $message;
    protected $statusCode;

    public function __construct(string $message = "Erro de validação.", int $statusCode = 400)
    {
        parent::__construct($message);

        $this->statusCode = $statusCode;
    }

    public function render(): JsonResponse
    {
        return ResponseHelper::errorResponse($this->message, $this->statusCode);
    }
}
