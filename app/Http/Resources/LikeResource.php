<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
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

            'like_id' => $this->like_id,
            'imagen_id' => $this->imagen_id,
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'user_surname' => $this->user->surname,
            'user_nickname' => $this->user->nickname,
            'user_image' => $this->user->image
        ];
    }
}
