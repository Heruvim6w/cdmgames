<?php

namespace App\Http\Resources\Dialogs;

use App\Http\Resources\Users\ShortProfileCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class MessageResource
 * @package App\Http\Resources\Dialogs
 *
 * @mixin \App\Models\Message
 **/
class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user" => new ShortProfileCollection($this->user),
            "text" => $this->text,
            "created_at"=>($this->created_at) ? $this->created_at->format("Y-m-d H:i:s") : null,
            "user_id" => $this->user_id,
            "dialog_id" => $this->dialog_id,
        ];
    }
}
