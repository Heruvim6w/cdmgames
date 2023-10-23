<?php

namespace App\Http\Resources\Dialogs;

use App\Http\Resources\Users\ShortProfileCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DialogResource
 * @package App\Http\Resources
 *
 * @mixin \App\Models\Dialog
 **/
class FullDialogResource extends JsonResource
{
    /**
     * @param mixed $resource
     * @return DialogCollection
     */
    public static function collection($resource)
    {
        return new DialogCollection($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var \App\Models\User $from */
        $from = $request->user();

        $users = $this->users->diff(collect([$from]));

        if ($users->count() == 1) {
            /** @var \App\Models\User $to */
            $to = $users->first();
        }

        $message = $this->messages->first();
        return [
            "id" => $this->id,
            "users" => new ShortProfileCollection($users),
            "messages" => new MessageCollection( $this->messages()->latest()->paginate(25) ),
            "message" => new MessageResource($message),
        ];
    }
}
