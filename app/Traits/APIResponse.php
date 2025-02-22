<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Throwable;

trait APIResponse
{
    protected array $additionalData = [];

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

    public function respondeWithError($message, $error ,  $code = self::HTTP_INTERNAL_SERVER_ERROR)
    {
        Log::error([$error->getMessage(), $error->getFile()]);
        return response()->json(['message' => $message , 'code' => $code], $code);
    }

    public function respondWithNotFound($message = 'Not Found')
    {
        return $this->respondeWithError($message, self::HTTP_NOT_FOUND);
    }

    public function respondWithCreated($data)
    {
        return $this->respondeWithSuccess($data, self::HTTP_CREATED);
    }

    public function dataResponse($data, $headers = [])
    {
        return $this->setStatusCode(self::HTTP_OK)->apiResponse(array_merge([
            'code' => self::HTTP_OK,
            'data' => $data,
        ], $this->additionalData), $headers);
    }

    public function apiResponse($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function setStatusCode($code = self::HTTP_OK)
    {
        $this->statusCode = $code;

        return $this;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

}