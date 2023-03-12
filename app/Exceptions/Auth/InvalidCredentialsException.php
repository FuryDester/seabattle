<?php

namespace App\Exceptions\Auth;

use App\Enums\ExceptionsEnum;
use App\Exceptions\BaseApiException;

class InvalidCredentialsException extends BaseApiException
{
    /**
     * @return ExceptionsEnum
     */
    public function getExceptionEnum(): ExceptionsEnum
    {
        return ExceptionsEnum::AuthInvalidCredentials;
    }
}
