<?php

namespace App\Http\Requests\Order;

use App\Models\GameItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if (!auth()->user()) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'game_item' => [
                "required",
                "integer",
                Rule::exists(GameItem::class, "id"),
            ],
            'price' => 'required|numeric',
        ];
    }
}
