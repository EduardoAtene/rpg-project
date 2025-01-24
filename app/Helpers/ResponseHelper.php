<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function successResponse(string $message, $data = null): array
    {
        $response = [
            'message' => $message,
        ];

        if ($data) {
            $response = array_merge($response, $data);
        }

        return $response;
    }

    public static function errorResponse(string $message, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], $statusCode);
    }
}
