<?php

namespace App\Http\Requests\Dialogs;

use App\Http\Requests\JsonRequest;

class Store extends JsonRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "from" => "required",
            "to" => "required",
        ];
    }
}
