<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ReturnMessagesTrait
{
    /**
     * Error response json
     * 
     * @param string $errorMessage
     * **/
    protected function responseError($errorMessages)
    {
        return response()->json([
            'status' => false,
            'message' => $errorMessages
        ]);
    }

    protected function success($data)
    {
        return response()->json([
            'status' => true,
            'data' => $data
        ], Response::HTTP_OK);
    }
}