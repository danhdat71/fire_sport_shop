<?php

namespace App\Traits;

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
            'message' => $errorMessages
        ]);
    }
}