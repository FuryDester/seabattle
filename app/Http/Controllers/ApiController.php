<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @param $data
     * @param int $responseCode
     * @return JsonResponse
     */
    protected function formSuccessResponse($data = null, int $responseCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ], $responseCode);
    }
}
