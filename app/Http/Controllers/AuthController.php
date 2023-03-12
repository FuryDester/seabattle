<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\UserDTO;
use App\Exceptions\Auth\InvalidCredentialsException;
use App\Exceptions\RequireAuthorizationException;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    private const USER_OUTPUT_FIELDS = [
        'login',
        'email',
        'firstname',
        'surname',
        'patronymic',
    ];

    /**
     * @param UserServiceContract $userService
     */
    public function __construct(
        protected UserServiceContract $userService,
    ) {}

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws InvalidCredentialsException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $dto = new UserDTO();
        $dto->email = $data['email'];
        $dto->password = $data['password'];

        $result = $this->userService->authorizeUser($dto);
        if (!$result) {
            throw new InvalidCredentialsException();
        }

        return $this->formSuccessResponse($this->getUserInfoByDto($dto));
    }

    /**
     * @return JsonResponse
     * @throws RequireAuthorizationException
     */
    public function getUserInfo(): JsonResponse
    {
        $id = Auth::id();
        if (!$id) {
            return $this->formSuccessResponse($this->getUserInfoByDto(new UserDTO()));
        }

        $dto = $this->userService->getUserById($id);
        if (!$dto) {
            throw new RequireAuthorizationException();
        }

        return $this->formSuccessResponse($this->getUserInfoByDto($dto));
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();

        return $this->formSuccessResponse();
    }

    /**
     * @param UserDTO $dto
     * @return array
     */
    protected function getUserInfoByDto(UserDTO $dto): array
    {
        $finalData = [];
        foreach (self::USER_OUTPUT_FIELDS as $field) {
            $finalData[$field] = $dto->{$field} ?? null;
        }

        return $finalData;
    }
}
