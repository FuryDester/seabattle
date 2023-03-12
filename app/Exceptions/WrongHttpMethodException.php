<?php

namespace App\Exceptions;

use App\Enums\ExceptionsEnum;

class WrongHttpMethodException extends BaseApiException
{
    /**
     * @return ExceptionsEnum
     */
    public function getExceptionEnum(): ExceptionsEnum
    {
        return ExceptionsEnum::WrongHttpMethod;
    }
}
