<?php

namespace App\Exceptions;

use App\Enums\ExceptionsEnum;

class RequireAuthorizationException extends BaseApiException
{
    /**
     * @return ExceptionsEnum
     */
    public function getExceptionEnum(): ExceptionsEnum
    {
        return ExceptionsEnum::RequireAuthorization;
    }
}
