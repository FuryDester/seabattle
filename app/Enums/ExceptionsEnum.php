<?php

namespace App\Enums;

use Symfony\Component\HttpFoundation\Response;

enum ExceptionsEnum: string
{
    case ValidationError = 'validation_error';
    case InvalidApiRoute = 'invalid_api_route';
    case UnauthorizedRequest = 'unauthorized_request';
    case AuthInvalidCredentials = 'auth_invalid_credentials';
    case RequireAuthorization = 'require_authorization';
    case WrongHttpMethod = 'wrong_http_method';

    /**
     * @return int
     */
    public function code(): int
    {
        return match($this) {
            self::ValidationError => 1001,
            self::InvalidApiRoute => 1002,
            self::UnauthorizedRequest => 1003,
            self::AuthInvalidCredentials => 1004,
            self::RequireAuthorization => 1005,
            self::WrongHttpMethod => 1006,
        };
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return match($this) {
            self::ValidationError => 'Возникла ошибка при валидации полей: %s',
            self::InvalidApiRoute => 'Введён несуществующий путь.',
            self::UnauthorizedRequest => 'У Вас недостаточно прав для выполнения запроса.',
            self::AuthInvalidCredentials => 'Введённые данные не найдены в базе данных.',
            self::RequireAuthorization => 'Для выполнения запроса необходимо авторизоваться.',
            self::WrongHttpMethod => 'Для выполнения данного запроса необходимо использовать другой метод.',
        };
    }

    /**
     * @return int
     */
    public function httpCode(): int
    {
        return match($this) {
            self::ValidationError, self::InvalidApiRoute, self::WrongHttpMethod => Response::HTTP_BAD_REQUEST,
            self::UnauthorizedRequest, self::AuthInvalidCredentials => Response::HTTP_UNAUTHORIZED,
            self::RequireAuthorization => Response::HTTP_FORBIDDEN,
        };
    }
}
