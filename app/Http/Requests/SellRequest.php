<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'telegram' => ['required', 'regex:/^@[a-zA-Z0-9_]{5,32}$/'],
            'game' => ['required', 'exists:games,id'],
            'description' => ['required', 'string', 'max:2000'],
            'media' => ['nullable', 'array'],
            'media.*' => [
                'file',
                'max:20480', // 20MB
                'mimes:jpg,jpeg,png,webp,pdf,mp4'
            ],
        ];
    }

    public function messages()
    {
        return [
            'telegram.regex' => 'Telegram username должен начинаться с @ и содержать 5-32 символа: буквы, цифры, _',
            'game.exists' => 'Выберите игру из списка',
            'media.*.max' => 'Каждый файл должен быть не больше 20Мб',
            'media.*.mimes' => 'Допустимые форматы: jpg, jpeg, png, webp, pdf, mp4',
        ];
    }
}

