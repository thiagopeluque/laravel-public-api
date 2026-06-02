<?php

namespace App\Services;

class ApiResponse
{
    public static function success($data = [], $message = 'Success', $code = 200)
    {
        return response()->json([
            'version' => config('app.production_version'),
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error($message = 'An Error occurred', $code = 400, $errors = [])
    {
        return response()->json([
            'version' => config('app.production_version'),
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}