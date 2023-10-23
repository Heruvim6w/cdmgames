<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

abstract class JsonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->jsonFail($validator->errors()->toArray(), Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            response()->jsonFail(['This action is unauthorized.'], Response::HTTP_FORBIDDEN)
        );
    }

    /**
     * @TODO https://github.com/laravel/framework/issues/27049
     *
     * Get the validated data from the request.
     *
     * @return array
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validated($k = null, $def = null)
    {
        if ($this->getValidatorInstance()->invalid()) {
            throw new ValidationException($this->getValidatorInstance());
        }

        $results = [];

        $missingValue = Str::random(10);

        foreach ($this->composeValidatedKeys() as $key) {
            $value = data_get($this->getValidatorInstance()->getData(), $key, $missingValue);

            if ($value !== $missingValue) {
                Arr::set($results, $key, $value);
            }
        }

        return $results;
    }

    /**
     * Compose an array of validated keys.
     *
     * @return array
     */
    protected function composeValidatedKeys()
    {
        $keys = array_keys($this->getValidatorInstance()->getRules());
        return array_filter($keys, function ($key) {
            return ! $this->validatedKeyHasNestedKeys($key);
        });
    }
    /**
     * Check if the specified validated key has nested keys.
     *
     * @param  string  $key
     * @return bool
     */
    protected function validatedKeyHasNestedKeys($key)
    {
        $keys = array_keys($this->getValidatorInstance()->getRules());
        foreach ($keys as $item) {
            if (Str::startsWith($item, "{$key}.")) {
                return true;
            }
        }
        return false;
    }
}
