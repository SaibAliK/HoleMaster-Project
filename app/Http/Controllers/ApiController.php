<?php

namespace App\Http\Controllers;

use App\Enums\ResponseCodesEnum;
use App\Enums\ResponseMessages;
use App\Enums\ResponseMessagesEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public static function successResponse($data, $message = ResponseMessagesEnum::SuccessMessage, $code, $status, $statusCode): JsonResponse
    {
        return response()->json([
            'status' => $status, 'message' => $message, 'code' => $code,  'data' => $data
        ], ResponseCodesEnum::SuccessCode);
    }

    public function errorResponse(
        $message = ResponseMessagesEnum::ErrorMessage,
        int $statusCode = ResponseCodesEnum::ServerCode,
        $data = [],
        $code,
        $status
    ): JsonResponse {
        return response()->json(
            ['status' => $status, 'message' => $message, 'code' => $code, 'data' => $data],
            ResponseCodesEnum::httpServeErrorResponseCode($statusCode)
        );
    }

    public function generalResponse(
        $data = [],
        $message = '',
        $status = ResponseCodesEnum::SuccessCode
    ): JsonResponse {
        return response()->json(['status' => false, 'message' => $message, 'data', $data], $status);
    }
}
