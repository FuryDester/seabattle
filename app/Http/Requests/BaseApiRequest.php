<?php

namespace App\Http\Requests;

use App\Enums\ExceptionsEnum;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseApiRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    abstract public function rules(): array;

    /**
     * @param string $dtoClass
     * @return object
     */
    public function makeDTO(string $dtoClass): object
    {
        $dto = new $dtoClass();
        foreach ($this->input() as $key => $item) {
            if (property_exists($dto, $key)) {
                $dto->{$key} = $item;
            }
        }

        return $dto;
    }

    /**
     * @param Validator $validator
     * @return void
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        $message = str_replace(
            '%s',
            implode(', ', $validator->errors()->all()),
            ExceptionsEnum::ValidationError->description()
        );

        throw new ValidationException($message);
    }

    /**
     * @return void
     * @throws UnauthorizedException
     */
    protected function failedAuthorization(): void
    {
        throw new UnauthorizedException();
    }
}
