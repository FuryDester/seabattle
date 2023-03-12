<?php

namespace App\Exceptions;

use App\Enums\ExceptionsEnum;

class UnauthorizedException extends BaseApiException
{
    /**
     * @return ExceptionsEnum
     */
    public function getExceptionEnum(): ExceptionsEnum
    {
        return ExceptionsEnum::UnauthorizedRequest;
    }
}
