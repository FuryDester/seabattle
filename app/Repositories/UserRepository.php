<?php

namespace App\Repositories;

use App\DataTransferObjects\UserDTO;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryContract
{
    /**
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return int|false
     */
    public function authorizeUser(string $email, string $password, bool $remember = true): int|false
    {
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            session()->regenerate();

            return Auth::id();
        }

        return false;
    }

    /**
     * @param int $userId
     * @return UserDTO|null
     */
    public function getUserById(int $userId): ?UserDTO
    {
        /* @var User $user */
        $user = User::find($userId);
        if (!$user) {
            return null;
        }

        $dto = new UserDTO();
        foreach (array_keys(get_object_vars($dto)) as $property) {
            $dto->{$property} = $user->{$property} ?? null;
        }

        return $dto;
    }
}
