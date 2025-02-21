<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Throwable;

trait APIResponse
{

    CONST HTTP_OK = 200;
    CONST HTTP_CREATED = 201;
    CONST HTTP_ACCEPTED = 202;
    CONST HTTP_NOT_FOUND = 404;
    CONST HTTP_UNPROCESSABLE_ENTITY = 422;
    CONST HTTP_INTERNAL_SERVER_ERROR = 500;

    public function respondeWithSuccess($data, $code = self::HTTP_OK)
    {
        return response()->json($data, $code);
    }

    public function respondeWithError($message, $code = self::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json(['message' => $message], $code);
    }

    public function respondWithNotFound($message = 'Not Found')
    {
        return $this->repondeWithError($message, self::HTTP_NOT_FOUND);
    }

    public function respondWithCreated($data)
    {
        return $this->respondeWithSuccess($data, self::HTTP_CREATED);
    }

}