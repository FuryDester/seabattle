<?php

namespace App\Exceptions;

use App\Enums\ExceptionsEnum;

class InvalidRouteException extends BaseApiException
{
    /**
     * @return ExceptionsEnum
     */
    public function getExceptionEnum(): ExceptionsEnum
    {
        return ExceptionsEnum::InvalidApiRoute;
    }
}
