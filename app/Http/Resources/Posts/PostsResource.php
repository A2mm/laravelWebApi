<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[

            "title"        => $this->title,
            "description"  => $this->description,
            "user_id"      => $this->user_id,
            "user_name"    => $this->user->name ?? null,
            "image"        => $this->image,
            "phone_number" => $this->phone_number,

        ];
    }
}
