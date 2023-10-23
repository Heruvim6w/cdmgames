<?php

namespace App\Http\Resources\Users;

use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
/**
 * Class ShortProfileResource
 * @package App\Http\Resources\Users
 *
 * @mixin \App\Models\User
 **/
class ShortProfileCollection extends ResourceCollection
{
//    /**
//     * Transform the resource collection into an array.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @return array|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Support\Collection|\JsonSerializable
//     */
//    public function toArray($request)
//    {
//        dd($request);
//        return $this->collection->transform(function (User $model) {
//            return (new ShortProfileCollection($model));
//        });
//    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        dd($request->user());
        return [
//            "id" => $this->id,
//            "name" => $this->name,
            "id" => $request->user()->id,
            "name" => $request->user()->name,

//            $this->mergeWhen(
//                $this->show_fields & User::SHOW_FIRST_NAME,
//                [
//                    "first_name" => $this->first_name,
//                ]
//            ),
//
//            $this->mergeWhen(
//                $this->show_fields & User::SHOW_LAST_NAME,
//                [
//                    "last_name" => $this->last_name,
//                ]
//            ),
//
//            $this->mergeWhen(
//                $this->show_fields & User::SHOW_MIDDLE_NAME,
//                [
//                    "middle_name" => $this->middle_name,
//                ]
//            ),
//
//            $this->mergeWhen(
//                $this->show_fields & User::SHOW_ABOUT,
//                [
//                    "about" => $this->about,
//                ]
//            ),
//
//            "position" => $this->position,
//
//            "photos" => new FileCollection($this->images),
//            "rating" => $this->rating,
//            "last_action_at" => $this->last_action_at ? $this->last_action_at->format("Y-m-d H:i:s") : null,
        ];
    }
}
