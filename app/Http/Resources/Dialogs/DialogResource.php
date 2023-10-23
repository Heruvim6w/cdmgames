<?php

namespace App\Http\Resources\Dialogs;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Users\ShortProfileCollection;
/**
 * Class DialogResource
 * @package App\Http\Resources
 *
 * @mixin \App\Models\Dialog
 **/
class DialogResource extends JsonResource
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
dd($from, $users);
        if ($users->count() == 1) {
            /** @var User $to */
            $to = $users->first();
        }

        $message = $this->messages->first();

        return [
            "id" => $this->id,
            "users" => new ShortProfileCollection($users),
            "message" => new MessageResource($message),
            ];
    }
}
