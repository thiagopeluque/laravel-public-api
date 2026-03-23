<?php

namespace App\Services;

class ApiResponse
{
    public static function success($message = 'Success', $code = 200, $data = [])
    {
        return response()->json([
            'status' => 'Success',
            'version' => config('app.production_version'),
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error($message = 'An Error occurred', $code = 400, $errors = [])
    {
        return response()->json([
            'status' => 'Error',
            'version' => config('app.production_version'),
            'message' => $message,
            'data' => $errors
        ], $code);
    }
}