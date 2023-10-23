<?php

namespace App\Http\Resources\Dialogs;

use App\Models\Dialog;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DialogCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->transform(function (Dialog $model) {
            return (new DialogResource($model));
        });
    }
}
