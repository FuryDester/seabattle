<?php

namespace App\Services;

use App\DataTransferObjects\UserDTO;
use App\Repositories\Contracts\UserRepositoryContract;

class UserService implements Contracts\UserServiceContract
{
    public function __construct(protected UserRepositoryContract $repository) {}

    /**
     * @param UserDTO $userDTO
     * @param bool $remember
     * @return bool
     */
    public function authorizeUser(UserDTO &$userDTO, bool $remember = true): bool
    {
        if (!$userDTO->email || !$userDTO->password) {
            return false;
        }

        $result = $this->repository->authorizeUser($userDTO->email, $userDTO->password, $remember);
        if ($result === false) {
            return false;
        }

        return boolval($userDTO = $this->getUserById($result));
    }

    /**
     * @param int $userId
     * @return UserDTO|null
     */
    public function getUserById(int $userId): ?UserDTO
    {
        return $this->repository->getUserById($userId);
    }
}
