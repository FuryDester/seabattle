<?php

namespace App\Repositories\Contracts;

use App\DataTransferObjects\UserDTO;

interface UserRepositoryContract
{
    /**
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return int|false
     */
    public function authorizeUser(string $email, string $password, bool $remember = true): int|false;

    /**
     * @param int $userId
     * @return UserDTO|null
     */
    public function getUserById(int $userId): ?UserDTO;
}
