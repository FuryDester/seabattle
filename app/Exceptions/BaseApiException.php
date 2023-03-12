<?php

namespace App\Exceptions;

use App\Enums\ExceptionsEnum;
use Exception;

abstract class BaseApiException extends Exception
{
    /**
     * @return ExceptionsEnum
     */
    abstract public function getExceptionEnum(): ExceptionsEnum;

    /**
     * @return int
     */
    public function getDefaultErrorCode(): int
    {
        return $this->getExceptionEnum()->code();
    }

    /**
     * @return string
     */
    public function getErrorSlug(): string
    {
        return $this->getExceptionEnum()->value;
    }

    /**
     * @return string
     */
    public function getDefaultErrorDescription(): string
    {
        return $this->getExceptionEnum()->description();
    }

    /**
     * @return int
     */
    public function getErrorHttpCode(): int
    {
        return $this->getExceptionEnum()->httpCode();
    }
}
