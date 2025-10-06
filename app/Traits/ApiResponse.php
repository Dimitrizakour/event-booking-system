<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    protected function successResponse(array $data = [], string $message = 'Success', int $status = Response::HTTP_OK)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'timestamp' => now()->format('Y-m-d, H:i:s'),
        ], $status);
    }

    protected function errorResponse(array $errors = [], string $message = 'Error', int $status = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
            'timestamp' => now()->format('Y-m-d, H:i:s'),
        ], $status);
    }
}
