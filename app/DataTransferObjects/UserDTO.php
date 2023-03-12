<?php

namespace App\DataTransferObjects;

use DateTime;

class UserDTO
{
    public ?int $id = null;

    public ?string $login = null;

    public ?string $email = null;

    public ?string $password = null;

    public ?DateTime $email_verified_at = null;

    public ?string $firstname = null;

    public ?string $surname = null;

    public ?string $patronymic = null;

    public ?string $remember_token = null;
}
