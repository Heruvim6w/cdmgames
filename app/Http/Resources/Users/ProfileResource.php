<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $myProfile = $request->user();

        $profile = [
            "id" => $myProfile->id,

            "name" => $myProfile->name,

            "email" => $myProfile->email,

            "email_verified_at" => $myProfile->email_verified_at->format("Y-m-d H:i"),

            "avatar" => $myProfile->avatar,

            "vk_link" => $myProfile->vk_link,
        ];

        return $profile;
    }
}
