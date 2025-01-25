<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Helpers\ResponseHelper;

class RpgSessionNotFoundException extends Exception
{
    protected $message;
    protected $statusCode;

    public function __construct(string $message = "Sessão não encontrada.", int $statusCode = 404)
    {
        parent::__construct($message);

        $this->statusCode = $statusCode;
    }

    public function render(): JsonResponse
    {
        return ResponseHelper::errorResponse($this->message, $this->statusCode);
    }
}
