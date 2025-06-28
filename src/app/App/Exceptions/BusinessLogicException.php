<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusinessLogicException extends Exception
{
    public function __construct(string $message = "Ошибка бизнес-логики", int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function render(Request $request): JsonResponse
    {
        return response(/* ... */)->json(['message' => $this->message], 400);
    }
}
