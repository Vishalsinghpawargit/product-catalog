<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Throwable;

trait APIResponse
{

    use Paginatable;

    protected array $additionalData = [];

    CONST HTTP_OK = 200;
    CONST HTTP_CREATED = 201;
    CONST HTTP_ACCEPTED = 202;
    CONST HTTP_NOT_FOUND = 404;
    CONST HTTP_UNPROCESSABLE_ENTITY = 422;
    CONST HTTP_INTERNAL_SERVER_ERROR = 500;

    public function respondeWithSuccess($data, $code = self::HTTP_OK)
    {
        return response()->json([
            'data' => $data, 
            'code' => $code
        ], $code);
    }

    public function respondeWithError($message, $code = self::HTTP_INTERNAL_SERVER_ERROR , null|string|Throwable $error = null , array $errorData = [])
    {
        // Check if an error was provided
        if ($error !== null) {
            if ($error instanceof Throwable) {
                // Extract detailed information if it's a Throwable
                $errorData['details'] = [
                    'error_message' => $error->getMessage(),
                    'file' => $error->getFile(),
                    'line' => $error->getLine(),
                    'trace' => $error->getTraceAsString(),
                ];
            } else {
                // Treat it as a simple string message if not Throwable
                $errorData['details'] = [
                    'error_message' => $error,
                ];
            }
        }

        // Log the structured error data
        Log::error('Internal Error Occurred', $errorData);

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

    public function paginatedDataResponse($data, ?string $resource = null, $headers = [])
    {
        $pagination = $this->generatePagination($data);

        // If a resource class is provided, transform the data using the resource
        if ($resource) {
            $data = $resource::collection($data);
        }

        return $this->setStatusCode(self::HTTP_OK)->apiResponse(array_merge([
            'code' => self::HTTP_OK,
            'data' => $data,
        ], $pagination, $this->additionalData), $headers);
    }

}