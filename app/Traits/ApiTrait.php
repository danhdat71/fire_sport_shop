<?php

namespace App\Traits;

trait ApiTrait
{
    protected function respondSuccess($data)
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    protected function respondError($code, $message)
    {
        return response()->json([
            'success' => false,
            'data' => [
                'code' => $code,
                'message' => $message,
            ]
        ]);
    }
}