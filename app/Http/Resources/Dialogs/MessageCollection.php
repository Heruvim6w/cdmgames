<?php

namespace App\Http\Resources\Dialogs;

use App\Models\Message;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class MessageCollection
 * @package App\Http\Resources\Dialogs
 *
 * @mixin \Illuminate\Pagination\LengthAwarePaginator
 */
class MessageCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "data" => $this->collection->transform(function (MessageResource $model) {
                return (new MessageResource($model));
            }),
            "current_page" => $this->currentPage(),
            "first_page_url" => $this->url(1),
            "from" => $this->firstItem(),
            "last_page" => $this->lastPage(),
            "last_page_url" => $this->url($this->lastPage()),
            "next_page_url" => $this->nextPageUrl(),
            "per_page" => $this->perPage(),
            "prev_page_url" => $this->previousPageUrl(),
            "to" => $this->lastItem(),
            "total" => $this->total(),
        ];
    }
}
