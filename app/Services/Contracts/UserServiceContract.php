<?php

namespace App\Services\Contracts;

use App\DataTransferObjects\UserDTO;

interface UserServiceContract
{
    /**
     * @param UserDTO $userDTO
     * @param bool $remember
     * @return bool
     */
    public function authorizeUser(UserDTO &$userDTO, bool $remember = true): bool;

    /**
     * @param int $userId
     * @return UserDTO|null
     */
    public function getUserById(int $userId): ?UserDTO;
}
