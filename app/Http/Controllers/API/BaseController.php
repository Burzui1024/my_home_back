<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

class BaseController extends Controller
{
    /**
     * Send success response
     * @param mixed $result
     * @param string $message
     * @return JsonResponse
     */
    public function sendResponse(mixed $result, string $message): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * Send error response
     * @param string $error
     * @param array|MessageBag $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error, array|MessageBag $errorMessages = [], int $code = 404):JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
