<?php

namespace App\Http\Requests\Messages;

use App\Http\Requests\JsonRequest;
use App\Rules\NotAuthUser;
use Illuminate\Validation\Rule;

class Store extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!auth()->user()) {
            return false;
        }
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "to" => [
                Rule::requiredIf(! $this->route("dialog")),
                new NotAuthUser($this->user()),
            ],
            "from" => "required|integer",
            "text" => "required_without_all:images|nullable|string",
            "images" => "required_without_all:text|nullable|array",
            "images.*" => "image|mimes:jpeg,jpg,png|max:2048"
        ];
    }
}
