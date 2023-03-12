<?php

namespace App\Exceptions;

use App\Enums\ExceptionsEnum;

class ValidationException extends BaseApiException
{
    /**
     * @return ExceptionsEnum
     */
    public function getExceptionEnum(): ExceptionsEnum
    {
        return ExceptionsEnum::ValidationError;
    }
}
