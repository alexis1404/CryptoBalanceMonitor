<?php
declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
class JsonResponseService
{
    public function getSuccessResponse(array $data = []): JsonResponse
    {
        $data['success'] = true;
        return response()->json($data, 200);
    }

    public function getErrorResponse(string $errorMessage): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $errorMessage,
        ], 200);
    }
}
