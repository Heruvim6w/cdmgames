<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\JsonRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

class Update extends FormRequest
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
        $user = $this->user();

        return [
            "email" => Rule::unique('users')->ignore($user->id),
            "avatar" => "nullable|image:jpg,jpeg,png|max:10240",
            "vk_link" => [
                "nullable",
                Rule::unique('users')->ignore($user->id),
            ],
            "balance" => "nullable|integer",
        ];
    }
}
