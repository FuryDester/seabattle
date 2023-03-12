<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseApiRequest;

class LoginRequest extends BaseApiRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
            'remember' => ['nullable', 'boolean'],
        ];
    }
}
