<?php

namespace App\Http\Requests\RandomEmail;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RandomEmailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "emails_count" => "required|integer|min:1|max:1000",
        ];
    }

    public function authorize(): bool
    {
        return !(!auth()->user() || auth()->user()->role !== User::SUPER_ADMIN);
    }
}
